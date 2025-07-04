<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>

<body>
    <h2>Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">⚠️ <?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="/handlers/auth.handler.php?action=login" method="POST">
        <label for="username">Username:</label><br>
        <input id="username" name="username" type="text" required /><br>

        <label for="password">Password:</label><br>
        <input id="password" name="password" type="password" required /><br><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>