<?php

class PostController {
    private $post;
    private $comment;

    public function __construct($post, $comment = null) {
        $this->post = $post;
        $this->comment = $comment;
    }

    // Display the list of posts on the homepage
    public function listPosts(): void
    {
        $posts = $this->post->getPosts();
        include '../views/home.php';
    }

    public function showPost($postId): void
    {
        $post = $this->post->getPostById($postId);
        $comments = $this->comment->getCommentsByPostId($postId);
        include '../app/views/post.php'; // Renders the post page
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
            $this->post->createPost($_SESSION['user_id'], $title, $content, $image);
            header('Location: dashboard.php');
        }
    }
}
