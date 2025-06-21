<?php
declare(strict_types=1);

// 1) Composer autoload
require 'vendor/autoload.php';

// 2) Composer bootstrap
require 'bootstrap.php';

// 3) envSetter
require_once UTILS_PATH . '/envSetter.util.php';

// ——— Connect to PostgreSQL ———
$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// ——— Reset Tables ———
echo "Truncating tables…\n";
foreach (['meeting_users', 'task', 'meeting', 'users'] as $table) {
    $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
}

// ——— Recreate Tables from SQL files ———
$schemaFiles = [
    'sql/models/user.model.sql',
    'sql/models/meeting.model.sql',
    'sql/models/meeting_users.model.sql',
    'sql/models/task.model.sql',
];

foreach ($schemaFiles as $file) {
    echo "Applying schema from {$file}…\n";
    $sql = file_get_contents($file);

    if ($sql === false) {
        throw new RuntimeException("❌ Could not read {$file}");
    }

    try {
        $pdo->exec($sql);
        echo "✅ Created tables from {$file}\n";
    } catch (PDOException $e) {
        echo "❌ Error in {$file}: {$e->getMessage()}\n";
    }
}
