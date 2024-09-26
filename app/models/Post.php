<?php

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createPost($userId, $title, $content, $image) {
        $stmt = $this->db->prepare('INSERT INTO posts (user_id, title, content, image) VALUES (:user_id, :title, :content, :image)');
        return $stmt->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':content' => $content,
            ':image' => $image
        ]);
    }

    public function getPosts() {
        $stmt = $this->db->query('SELECT * FROM posts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare('select posts.*, users.username as author from posts inner join users on posts.user_id = users.id WHERE posts.id = :id ');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $content) {
        $stmt = $this->db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':id' => $id
        ]);
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare('DELETE FROM posts WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}