<?php

class authCon
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
        $this->checkLogin();
    }
//checking role that can access the admin page.
    public function admin()
    {
        $user_id = $_SESSION['user']['user_id'];
        $checkadmin = "SELECT id,role_as FROM users_account WHERE id='$user_id' AND role_as='1' LIMIT 1";
        $res = $this->conn->query($checkadmin);
        if ($res->num_rows == 1) {
            return true;
        } else {
            redirect("Not Admin", "homepage.php");
        }
    }

    private function checkLogin()
    {
        if (!isset($_SESSION['authenticated'])) {
            redirect("login to access the page", "SignIn.php");
            return false;
        } else {
            return true;
        }
    }

    public function authDetail()
    {
        $checkAuth = $this->checkLogin();
        if ($checkAuth) {
            $user_id = $_SESSION['user']['user_id'];
            $getUserdata = "SELECT * FROM users_account WHERE id='$user_id' LIMIT 1";
            $res = $this->conn->query($getUserdata);
            if ($res->num_rows > 0) {
                $data = $res->fetch_assoc();
                return $data;
            } else {
                redirect("Something Went Wrong", "SignIn.php");
            }
        } else {
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
