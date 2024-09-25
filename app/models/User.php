<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        return $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hashedPassword]);
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUser($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}