<?php require_once __DIR__ . '/layouts/header.php'; ?>
    <div class="login-box">
        <h2>Login</h2>
        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?=$_SESSION['old_values']['email'] ?? ''?>"/>

                <?php if ($_SESSION['errors']['email'] ?? false) : ?>
                    <small class="invalid-message"><?= $_SESSION['errors']['email'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?=$_SESSION['old_values']['password'] ?? ''?>"/>

                <?php if ($_SESSION['errors']['password'] ?? false) : ?>
                    <small class="invalid-message"><?= $_SESSION['errors']['password'] ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="register-link">Don't have an account? <a href="/register">Register here</a></p>
    </div>
<?php require_once __DIR__ . '/layouts/footer.php'; ?>