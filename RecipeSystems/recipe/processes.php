<?php

include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if (isset($_POST['login'])) {
	$email    = $_POST['email'];
	$password = $_POST['password'];

	$check = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' AND password='$password' AND role_as='0' AND select_meal_plan_history !='' ");

	if (mysqli_num_rows($check) === 1) {

		$row = mysqli_fetch_array($check);
		$meal_plan = $row['select_meal_plan_history'];
		$deactivate = $row['deactivate'];
		if($deactivate == 0) {
			if ($row['email'] === $email && $row['password'] === $password && $row['select_meal_plan_history'] != '') {
				$_SESSION['role_as'] = $row['id'];		
				header("Location: Customer/recipe.php?meal_plan=".$meal_plan);
			} else {
				$_SESSION['message'] = "Incorrect password.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: SignIn.php");
			}
		} else {
			$_SESSION['message'] = "Only activated accounts are allowed to login";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: SignIn.php");
		}
		
	} else {
		$check = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' AND password='$password' AND role_as='0' AND select_meal_plan_history ='' ");
		if (mysqli_num_rows($check) === 1) {
			$row = mysqli_fetch_array($check);
			$recipe = "";
			$deactivate = $row['deactivate'];
			if($deactivate == 0) {
				if ($row['email'] === $email && $row['password'] === $password && $row['select_meal_plan_history'] === $recipe) {
					$_SESSION['role_as'] = $row['id'];
					header("Location: Customer/index.php");
				} else {
					$_SESSION['message'] = "Incorrect password.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: SignIn.php");
				}
			} else {
				$_SESSION['message'] = "Only activated accounts are allowed to login";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: SignIn.php");
			}
			
		} else {
			$check = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' AND password='$password' AND role_as='1'");
			if (mysqli_num_rows($check) === 1) {
				$row = mysqli_fetch_array($check);
				if ($row['email'] === $email && $row['password'] === $password) {
					$_SESSION['role_as_admin'] = $row['id'];
					header("Location: Admin/dashboard.php");
				} else {
					$_SESSION['message'] = "Incorrect password.";
					$_SESSION['text'] = "Please try again.";
					$_SESSION['status'] = "error";
					header("Location: SignIn.php");
				}
			} else {
				$_SESSION['message'] = "Incorrect password.";
				$_SESSION['text'] = "Please try again.";
				$_SESSION['status'] = "error";
				header("Location: SignIn.php");
			}
		}
	}
}


// REGISTER - SIGNUP.PHP
if (isset($_POST['register'])) {
	$fname           = $_POST['fname'];
	$lname           = $_POST['lname'];
	$email           = $_POST['email'];
	$cpassword       = $_POST['cpassword'];
	$date_registered = date('Y-m-d');

	$select = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email'");
	if (mysqli_num_rows($select) > 0) {
		$_SESSION['message'] = "Email is already taken.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: SignUp.php");
	} else {
		$register = mysqli_query($conn, "INSERT INTO users_account (fname, lname, email, password, date_created) VALUES('$fname', '$lname', '$email', '$cpassword', '$date_registered')");
		if ($register) {
			$_SESSION['message'] = "Registration successful.";
			$_SESSION['text'] = "Please login.";
			$_SESSION['status'] = "success";
			header("Location: SignUp.php");
		} else {
			$_SESSION['message'] = "Something went wrong while saving your information.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: SignUp.php");
		}
	}
}



// SEARCH EMAIL - FORGOT-PASSWORD.PHP
if (isset($_POST['search'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$fetch = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email'");
	if (mysqli_num_rows($fetch) > 0) {
		$row = mysqli_fetch_array($fetch);
		$id = $row['id'];
		header("Location: sendcode.php?id=" . $id);
	} else {
		$_SESSION['message'] = "Email does not exists in the database.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: forgot-password.php");
	}
}




// SEND CODE - SENDCODE.PHP
if (isset($_POST['sendcode'])) {

	$email = $_POST['email'];
	$id    = $_POST['id'];
	$key   = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

	$insert_code = mysqli_query($conn, "UPDATE users_account SET verification_code='$key' WHERE email='$email' AND id='$id'");
	if ($insert_code) {

		$subject = 'Verification code';
		$message = '<p>Good day sir/maam ' . $email . ', your verification code is <b>' . $key . '</b>. Please do not share this code to other people. Thank you!</p>
	      <p>You can change your password by just clicking it <a href="http://localhost/RecipeSystems/recipe/changepassword.php?id=' . $id . '">here!</a></p> 
	      <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'tatakmedellin@gmail.com';
			$mail->Password = 'nzctaagwhqlcgbqq';
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;

			//Send Email
			$mail->setFrom('tatakmedellin@gmail.com');

			//Recipients
			$mail->addAddress($email);
			$mail->addReplyTo('tatakmedellin@gmail.com');

			//Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $message;

			$mail->send();

			$_SESSION['message'] = "Verification code has been sent to your email.";
			$_SESSION['text'] = "Code has been sent";
			$_SESSION['status'] = "success";
			header("Location: verifycode.php?id=" . $id . "&&email=" . $email);
		} catch (Exception $e) {
			$_SESSION['message'] = "Email not sent.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: sendcode.php?id=" . $id);
		}
	} else {
		$_SESSION['message'] = "Something went wrong while generating verification code through email.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: sendcode.php?id=" . $id);
	}
}



// VERIFY CODE - VERIFYCODE.PHP
if (isset($_POST['verify_code'])) {
	$id    = $_POST['id'];
	$email = $_POST['email'];
	$code  = mysqli_real_escape_string($conn, $_POST['code']);
	$fetch = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' AND verification_code='$code' AND id='$id'");
	if (mysqli_num_rows($fetch) > 0) {
		header("Location: changepassword.php?id=" . $id);
	} else {
		$_SESSION['message'] = "Verification code is incorrect.";
		$_SESSION['text'] = "Please try again.";
		$_SESSION['status'] = "error";
		header("Location: verifycode.php?id=" . $id . "&&email=" . $email);
	}
}



// CHANGE PASSWORD - CHANGEPASSWORD.PHP
if (isset($_POST['changepassword'])) {
	$id   = $_POST['id'];
	$cpassword = $_POST['cpassword'];

	$update = mysqli_query($conn, "UPDATE users_account SET password='$cpassword' WHERE id='$id' ");
	if ($update) {
		$_SESSION['message'] = "Password has been changed.";
		$_SESSION['text'] = "Please login to your account";
		$_SESSION['status'] = "success";
		header("Location: SignIn.php");
	} else {
		$_SESSION['message'] = "Something went wrong while updating your password.";
		$_SESSION['text'] = "Please try again";
		$_SESSION['status'] = "error";
		header("Location: changepassword.php?id=" . $id);
	}
}
