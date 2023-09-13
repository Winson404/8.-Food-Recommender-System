<?php

session_start();
include '../config.php';

require '../vendor/autoload.php';

use GuzzleHttp\Psr7\Request;



if (isset($_POST['predict_diet'])) {
    print("<pre>" . print_r($_POST, true) . "</pre>");

    $client = new GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:8000/']);

    $response = $client->post('http://127.0.0.1:8000/classify_grade', [
        GuzzleHttp\RequestOptions::JSON => ['sem1_grade' => $sem1_grade, 'sem2_grade' => $sem2_grade] // or 'json' => [...]
    ]);

    $remark_response = json_decode($response->getBody(), true);

    print("<pre>" . print_r($remark_response, true) . "</pre>");
    // $fname           = $_POST['fname'];
    // $lname           = $_POST['lname'];
    // $email           = $_POST['email'];
    // $password        = $_POST['password'];
    // $cpassword       = $_POST['cpassword'];
    // $date_registered = date('Y-m-d');



    // $select = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email'"); 
    // if(mysqli_num_rows($select) > 0) {
    //     echo '<script>alert ("E-mail is already taken. Please try again.");
    //                 window.history.go(-1);
    //           </script>';
    // } else {
    //     if($password != $cpassword) {
    //         echo '<script>alert ("Password does not matched. Please try again.");
    //                 window.history.go(-1);
    //           </script>';
    //     } else {

    //         $register = mysqli_query($conn, "INSERT INTO users_account (fname, lname, email, password, date_created) VALUES('$fname', '$lname', '$email', '$password', '$date_registered')");
    //         if($register) {
    //             $_SESSION['success']  = "Registration successful. Please login.";
    //             header("Location: SignIn.php");
    //         } else {
    //             echo '<script>alert ("Something went wrong while saving the data.");
    //                         window.history.go(-1);
    //                   </script>';
    //         }

    //     }
    // }
}
