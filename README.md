# PHP CMS with User Registration, Login, and Content Management

This project is a PHP-based Content Management System (CMS) with a MySQL database, designed to allow users to register, log in, and manage content. It follows best security practices, including password hashing, input validation, and protection against XSS, CSRF, and SQL injection.

## Features

- **User Registration**: Allows users to sign up with a unique username, valid email, and password.
- **User Login**: Users can log in using their email and password.
- **CRUD Operations**: Users can create, read, update, and delete content (e.g., blog posts or other entries).
- **File Upload**: Users can upload files (such as images) which are publicly accessible via URLs.
- **Security**:
    - Passwords are hashed using `password_hash()`.
    - Validation of inputs to prevent SQL injection, XSS, and CSRF attacks.
    - Email validation using PHP's `filter_var()` function.
- **404 Error Page**: A custom 404 error page for invalid URLs.
- **Responsive Design**: The UI is fully responsive using a CSS framework (optional).

## Technologies Used

- **PHP 8+** (Object-Oriented, using PDO for database interaction)
- **MySQL** for data storage
- **HTML5 & CSS3** for the frontend
- **JavaScript** (Optional for better UX)
- **Composer** for dependency management (Optional)

## Installation

Follow these steps to set up the project on your local environment:

### Prerequisites

- PHP 8+
- MySQL or MariaDB
- Composer (optional)
- A local web server such as Apache or Nginx (or XAMPP/LAMP/WAMP stacks)

### Steps

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd cms-project
2. Import DB frm ```database.sql``` file.
3. Set DB configs in the ```config/config.php``` file
4. Run server ```php -S localhost:8080 -t public```
5. Enjoy :)
