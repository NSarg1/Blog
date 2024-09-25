<?php

class Validation {
    private $errors = [];
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Validate required fields
    public function required($field, $value) {
        if (empty($value)) {
            $this->errors[$field] = ucfirst($field) . ' is required.';
        }
    }

    // Validate unique fields (e.g., email, username)
    public function unique($field, $value, $table) {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE $field = ?");
        $stmt->execute([$value]);
        if ($stmt->fetch()) {
            $this->errors[$field] = ucfirst($field) . ' must be unique.';
        }
    }

    // Validate minimum length for fields (e.g., password)
    public function min($field, $value, $minLength) {
        if (strlen($value) < $minLength) {
            $this->errors[$field] = ucfirst($field) . " must be at least $minLength characters.";
        }
    }

    // Validate password confirmation
    public function confirmPassword($password, $confirmPassword) {
        if ($password !== $confirmPassword) {
            $this->errors['confirm_password'] = 'Passwords do not match.';
        }
    }

    public function email($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = ucfirst($field) . ' must be a valid email address.';
        }
    }

    // Check if there are validation errors
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    // Return all errors
    public function getErrors(): array
    {
        return $this->errors;
    }
}
