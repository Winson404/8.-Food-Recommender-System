<?php

class LoginController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function userLogin($email,$password)
    {
        $checkLogin = "SELECT * FROM users_account WHERE email='$email' AND password='$password' LIMIT 1";
        $result =$this->conn->query($checkLogin);
        if($result->num_rows > 0)
        {
            $data =$result->fetch_assoc();
            $this->userAuthentication($data);
            return true;
        }else{
            return false;
        }
    }

    private function userAuthentication($data)
    {
        $_SESSION['authenticated'] = true;
        $_SESSION['auth_role'] = $data['role_as'];
        $_SESSION['user'] =[
            'user_id' => $data['id'],
            'user_fname' => $data['fname'],
            'user_lname' => $data['lname'],
            'user_email' => $data['email'],
            'user_password' => $data['password']

        ];

    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['authenticated']) === TRUE)
        {
            redirect('You Are Logged In','homepage.php');
        }
        else{
            return false;
        }
    }

    public function Logout()
    {
        if(isset($_SESSION) === TRUE)
        {
            unset($_SESSION['authenticated']);
            unset($_SESSION['user']);
            return true;
        }
        else{
            return false;
        }
    }
}
?>