<?php
require_once __DIR__ . '/../../utils/Validation.php';

class AuthController {
    private $user;
    private $validation;

    public function __construct($user, $db) {
        $this->user = $user;
        $this->validation = new Validation($db);
    }

    public function showLoginForm()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            return;
        }

        include '../views/login.php';
    }

    public function showRegisterForm()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            return;
        }

        include '../views/register.php';
    }

    public function register() {
        $this->validation->required('username', $_POST['username']);
        $this->validation->required('email', $_POST['email']);
        $this->validation->required('password', $_POST['password']);
        $this->validation->required('confirm_password', $_POST['confirm_password']);

        $this->validation->unique('username', $_POST['username'], 'users');
        $this->validation->email('email', $_POST['email']);
        $this->validation->unique('email', $_POST['email'], 'users');

        $this->validation->min('password', $_POST['password'], 6);
        $this->validation->confirmPassword($_POST['password'], $_POST['confirm_password']);

        if ($this->validation->hasErrors()) {
            $_SESSION['errors'] = $this->validation->getErrors();
            $_SESSION['old_values'] = $_POST;
            header('Location: /register');
            return;
        }

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $this->user->register($username, $email, $password);
        $user = $this->user->login($email, $password);

        $_SESSION['user_id'] = $user['id'];
        header('Location: /');
    }

    public function login() {
        $this->validation->email('email', $_POST['email']);
        $this->validation->min('password', $_POST['password'], 6);

        if ($this->validation->hasErrors()) {
            $_SESSION['errors'] = $this->validation->getErrors();
            $_SESSION['old_values'] = $_POST;
            header('Location: /login');
            return;
        }

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $user = $this->user->login($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /');
        } else {
            $_SESSION['errors']['email'] = 'Incorrect credentials';
            $_SESSION['old_values'] = $_POST;
            header('Location: /login');
        }
    }
}