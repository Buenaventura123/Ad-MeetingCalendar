<?php
$mongoStatus = include 'handlers/mongodbChecker.handler.php';
$postgresStatus = include 'handlers/postgreChecker.handler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Checker</title>
    <link rel="stylesheet" href="assets/css/home.css"> <!-- Optional if you want to style -->
</head>

<body>

    <div class="status-box">
        <h2>Database Connection Status</h2>

        <p>
            MongoDB:
            <span class="<?= $mongoStatus ? 'success' : 'fail' ?>">
                <?= $mongoStatus ? '✅ Connected successfully' : '❌ Failed to connect' ?>
            </span>
        </p>

        <p>
            PostgreSQL:
            <span class="<?= $postgresStatus ? 'success' : 'fail' ?>">
                <?= $postgresStatus ? '✅ Connected successfully' : '❌ Failed to connect' ?>
            </span>
        </p>

        <div class="go-login">
            <a href="/pages/login/index.php">🔐 Go to Login</a>
        </div>
    </div>

</body>

</html>