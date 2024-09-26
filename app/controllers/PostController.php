<?php

class PostController {
    private $post;
    private $comment;
    private $validation;

    public function __construct($post, $db, $comment = null) {
        $this->post = $post;
        $this->comment = $comment;
        $this->validation = new Validation($db);
    }

    // Display the list of posts on the homepage
    public function listPosts(): void
    {
        $posts = $this->post->getPosts();
        include '../views/home.php';
    }

    public function showPost($postId): void
    {
        $post= $this->post->getPostById($postId);
        $comments = $this->comment->getCommentsByPostId($postId);

        include '../views/post.php'; // Renders the post page
    }

    public function create(): void
    {
        $this->validation->required('title', $_POST['title']);
        $this->validation->required('content', $_POST['content']);

        if ($this->validation->hasErrors()) {
            $_SESSION['errors'] = $this->validation->getErrors();
            $_SESSION['old_values'] = $_POST;
            header('Location: /');
            return;
        }

        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $uploadResult = $this->uploadImage($_FILES['image']);

        // Check if the upload was successful
        if (empty($uploadResult['error'])) {
            $this->post->createPost($_SESSION['user_id'], $title, $content, $uploadResult['file']);
            header('Location: /');
        } else {
            $_SESSION['errors']['image'] = $uploadResult['error'];
            $_SESSION['old_values'] = $_POST;
            header('Location: /');
        }
    }

    private function uploadImage($file): array
    {
        if (!$file['name']) {
            return [
                'error' => "File is required"
            ];
        }

        // Allowed file extensions and MIME types for images
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Maximum file size (e.g., 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes

        // Get file info
        $fileName = basename($file['name']);
        $fileSize = $file['size'];
        $fileTmpPath = $file['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($fileExtension, $allowedExtensions) || !in_array($fileType, $allowedMimeTypes)) {
            return [
                'error' => "Invalid file type. Only JPG, PNG, and GIF files are allowed."
            ];
        }

        // Validate file size
        if ($fileSize > $maxFileSize) {
            return [
                'error' => "File size exceeds the limit of 5MB."
            ];
        }

        // Ensure the file was uploaded via HTTP POST
        if (!is_uploaded_file($fileTmpPath)) {
            return [
                'error' =>  "File was not uploaded properly."
            ];
        }


        // Generate a unique name for the file to avoid overwriting
        $newFileName = uniqid() . '.' . $fileExtension;

        // Define the upload directory (ensure this is writable)
        $uploadDir = __DIR__ . '/../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
        }

        // Move the file to the uploads directory
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Return the new file name if the upload is successful
            return [
                'error' => null,
                'file' => $newFileName,
            ];
        } else {
            return [
                'error' => "Failed to upload the file."
            ];
        }
    }
}
