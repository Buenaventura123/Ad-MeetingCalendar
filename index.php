<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Checker</title>
</head>

<body>
    <h1>Database Connection Status:</h1>
    <?php
    // Adjust paths if your checker files are in a 'handlers' subdirectory, etc.
    include_once 'mongodbChecker.handler.php';
    include_once 'postgreChecker.handler.php';
    ?>
</body>

</html>