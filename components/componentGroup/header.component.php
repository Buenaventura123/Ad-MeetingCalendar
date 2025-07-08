<?php
function head(string $title = "Page", array $cssFiles = [])
{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($title) ?></title>
        <?php foreach ($cssFiles as $css): ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    </head>

    <body>
        <?php
}
?>