<?php
//include('config/app.php');
include_once('controllers/Register.Controller.php');
include_once('controllers/LoginController.php');
include_once('controllers/authCon.php');

$auth = new LoginController;
if(isset($_POST['logout']))
{
    $checkLogout = $auth->Logout();
    if($checkLogout){
        
        if($_SESSION['auth_role'] == '1'){

            redirect("","SignIn.php");
        }else{
            redirect("","SignIn.php");
        }
        

    }
}
if(isset($_POST['login']))
{
    $email =validateInput($db->conn,$_POST['email']);
    $password =validateInput($db->conn,$_POST['password']);

    
    $checkLogin = $auth->userLogin($email,$password);
    if($checkLogin)
    {
        if($_SESSION['auth_role'] == '1')
        {
           redirect("Logged in Success","admin/admin.php");
        }
        else
        {
           redirect("Logged In Successfully","homepage.php"); 
        }
        
    }else{
        redirect("Invalid Email Id or Password","SignIn.php");
    }
}

if(isset($_POST['register']))
{
    $fname =validateInput($db->conn,$_POST['fname']);
    $lname =validateInput($db->conn,$_POST['lname']);
    $email =validateInput($db->conn,$_POST['email']);
    $password =validateInput($db->conn,$_POST['password']);
    $cpassword =validateInput($db->conn,$_POST['cpassword']);

    $register = new RegisterController;

    $resultpass = $register->confirmPassword($password,$cpassword);
    if($resultpass){

        $resultUser = $register->isUserExists($email);
        if($resultUser){
            redirect("Email Already  Exists","SignUp.php");
        }
        else{
            $register_query =$register->registration($fname,$lname,$email,$password);
            if($register_query){

                redirect("Registered Successfully","SignUp.php");
            }
            else
            {
                redirect("Something Went Wrong","SignUp.php");
            }
            
        }

    }else{
        redirect("Password and Confirm password does not match","SignUp.php");
    }
}
