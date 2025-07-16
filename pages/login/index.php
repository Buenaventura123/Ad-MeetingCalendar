<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';
Auth::init();

require_once BASE_PATH . '/layouts/main.layout.php';

renderMainLayout(function () {
    ?>
    <div class="login-container">
        <h1 class="title">Meeting Calendar</h1>
        <h2 class="subtitle">Login to Your Account</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-msg">⚠️ <?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <form class="login-form" action="/handlers/auth.handler.php?action=login" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" required placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
    <?php
}, "Login Page", [
    'css' => [
        '/pages/login/assets/css/login.css',
        '/assets/css/navbar.css',
        '/assets/css/footer.css',
        '/assets/css/layout.css',
    ],
]);
