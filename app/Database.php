<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct($config) {
        $this->conn = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance($config) {
        if (!self::$instance) {
            self::$instance = new Database($config);
        }
        return self::$instance->conn;
    }
}