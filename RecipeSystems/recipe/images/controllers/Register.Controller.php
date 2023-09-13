<?php
//include('config/app.php');

class RegisterController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    //getting the input data and inserting it to database
    public function registration($fname, $lname, $email, $password)
    {
        $register_query = "INSERT INTO users_account (fname,lname,email,password)VALUES('$fname','$lname','$email','$password')";
        $result = $this->conn->query($register_query);
        return $result;
    }

    // Checking if the user Exists
    public function isUserExists($email)
    {
        $checkUser = "SELECT email FROM users_account WHERE email='$email' LIMIT 1";
        $result = $this->conn->query($checkUser);
        if($result->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
    //confirming password
    public function confirmPassword($password,$cpassword)
    {
        if($password == $cpassword){
            return true;

        }else{
            return false;

        }
    }

}
