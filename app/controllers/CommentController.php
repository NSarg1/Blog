<?php

class CommentController {
    private $comment;

    public function __construct($comment) {
        $this->comment = $comment;
    }

    // Add a new comment
    public function addComment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $comment = htmlspecialchars($_POST['comment']);
            $postId = (int) $_POST['post_id'];
            $userId = $_SESSION['user_id'];

            $this->comment->addComment($userId, $postId, $comment);
            header('Location: post/' . $postId);
        }
    }

    // Delete a comment
    public function deleteComment($commentId, $postId) {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $this->comment->deleteComment($commentId, $userId);
            header('Location: post/' . $postId);
        }
    }
}