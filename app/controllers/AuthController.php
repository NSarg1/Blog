<?php

class AuthController {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showLoginForm()
    {
        include '../views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $this->user->register($username, $email, $password);
            header('Location: login.php');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $user = $this->user->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: dashboard.php');
            } else {
                echo 'Login failed!';
            }
        }
    }
}