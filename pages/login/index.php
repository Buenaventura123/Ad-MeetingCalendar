<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Meeting Calendar</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
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
</body>

</html>