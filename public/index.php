<?php
ini_set('display_errors', 1);
session_start();
$config = require '../config/config.php';
require_once '../app/Database.php';
require_once '../app/controllers/PostController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/CommentController.php';
require_once '../app/models/Post.php';
require_once '../app/models/User.php';
require_once '../app/models/Comment.php';


// Routing Logic
$url = $_SERVER['REQUEST_URI'];
$url = trim($url, '/'); // Remove leading/trailing slashes

$parts = explode('/', $url);
$page = $parts[0];

if (!$page) {
    $page = 'home';
}

$method = $_SERVER['REQUEST_METHOD'];


// Database instance
$db = Database::getInstance($config['db']);
$userModel = new User($db);

$_SESSION['user'] = null;

if ($_SESSION['user_id'] ?? false) {
    $_SESSION['user'] = $userModel->getUser($_SESSION['user_id']);
}

// Define routes
switch ($page) {
    case 'home':
        $postModel = new Post($db);
        $postController = new PostController($postModel, $db);
        $postController->listPosts();
        break;
    case 'post':
        $postModel = new Post($db);
        $commentModel = new Comment($db);
        $postController = new PostController($postModel, $db, $commentModel);

        if ($method === 'GET') {
            if (isset($parts[1])) {
                $postId = (int)$parts[1];
                $postController->showPost($postId);
            }
        } else {
           $postController->create();
        }
        break;
    case 'register':
        $authController = new AuthController($userModel, $db);
        if ($method === 'GET') {
            $authController->showRegisterForm();
        } else {
            $authController->register();
        }
        break;
    case 'login':
        $authController = new AuthController($userModel, $db);

        if ($method === 'GET') {
            $authController->showLoginForm();
        } else {
            $authController->login();
        }

        break;
    case 'add_comment':
        $commentModel = new Comment($db);
        $commentController = new CommentController($commentModel);
        $commentController->addComment();
        break;
    case 'delete_comment':
        $commentModel = new Comment($db);
        $commentController = new CommentController($commentModel);
        $commentController->deleteComment($_POST['comment_id'], $_POST['post_id']);
        break;
    case 'logout':
        session_destroy();
        header('Location: /home');
        break;
    case 'about':
        include '../views/about.php';
        break;
    default:
        include('../views/404.php');
        break;
}