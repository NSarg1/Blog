<?php

class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Fetch all comments for a specific post
    public function getCommentsByPostId($postId) {
        $stmt = $this->db->prepare('SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = :post_id ORDER BY created_at DESC');
        $stmt->execute([':post_id' => $postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a comment to a post
    public function addComment($userId, $postId, $comment) {
        $stmt = $this->db->prepare('INSERT INTO comments (user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)');
        return $stmt->execute([
            ':user_id' => $userId,
            ':post_id' => $postId,
            ':comment' => $comment
        ]);
    }

    // Delete a comment by its ID (only by the owner)
    public function deleteComment($commentId, $userId) {
        $stmt = $this->db->prepare('DELETE FROM comments WHERE id = :id AND user_id = :user_id');
        return $stmt->execute([':id' => $commentId, ':user_id' => $userId]);
    }
}