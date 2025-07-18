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

// ——— Dropping old tables ———
echo "Dropping old tables…\n";
foreach ([
    'projects',
    'users',
] as $table) {
    $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
}

echo "Applying schema from database/models/user.model.sql…\n";

$sql = file_get_contents('database/models/user.model.sql');

if ($sql === false) {
    throw new RuntimeException("❌ Could not read database/models/user.model.sql");
} else {
    echo "✅ Creation Success from the database/models/user.model.sql\n";
}

$pdo->exec($sql);
