<?php require_once __DIR__ . '/layouts/header.php'; ?>
    <div class="login-box">
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
            <div class="form-group">
                <label for="email">Email or Username</label>
                <input type="text" id="email" name="email" required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required/>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="register-link">Don't have an account? <a href="register.html">Register here</a></p>
    </div>
<?php require_once __DIR__ . '/layouts/footer.php'; ?>