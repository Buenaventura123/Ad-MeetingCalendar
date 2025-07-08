<?php
declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

$user = Auth::user();

if (!$user) {
    header('Location: /pages/login/index.php?error=Please+login+first');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="/pages/users/assets/css/profile.css">
</head>

<body>
    <div class="profile-container">
        <h1>👤 User Profile</h1>
        <div class="card">
            <p><strong>Full Name:</strong> <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
        </div>

        <form action="/handlers/auth.handler.php?action=logout" method="POST">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>

</html>