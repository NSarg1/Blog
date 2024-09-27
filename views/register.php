<?php require_once __DIR__ . '/layouts/header.php'; ?>
    <div class="signup-box">
        <h2>Create an Account</h2>
        <form action="/register" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       value="<?= $_SESSION['old_values']['username'] ?? '' ?>"/>
                <?php if ($_SESSION['errors']['username'] ?? false) : ?>
                    <small class="invalid-message"><?= $_SESSION['errors']['username'] ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?= $_SESSION['old_values']['email'] ?? '' ?>"/>
                <?php if ($_SESSION['errors']['email'] ?? false) : ?>
                    <small class="invalid-message"><?= $_SESSION['errors']['email'] ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       value="<?= $_SESSION['old_values']['password'] ?? '' ?>"/>
                <?php if ($_SESSION['errors']['password'] ?? false) : ?>
                    <small class="invalid-message"><?= $_SESSION['errors']['password'] ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password"
                       value="<?= $_SESSION['old_values']['confirm_password'] ?? '' ?>"/>
                <?php if ($_SESSION['errors']['confirm_password'] ?? false) : ?>
                    <small class="invalid-message"><?= $_SESSION['errors']['confirm_password'] ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p class="login-link">Already have an account? <a href="/login">Login here</a></p>
    </div>
<?php require_once __DIR__ . '/layouts/footer.php'; ?>