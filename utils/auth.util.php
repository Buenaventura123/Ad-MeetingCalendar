<?php
class Auth
{
    // ✅ 1. Initialize session
    public static function init()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ✅ 2. Perform login
    public static function login(PDO $pdo, string $username, string $password): bool
    {
        self::init();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    // ✅ 3. Get current user
    public static function user(): ?array
    {
        self::init();
        return $_SESSION['user'] ?? null;
    }

    // ✅ 4. Check if user is logged in
    public static function check(): bool
    {
        self::init();
        return isset($_SESSION['user']);
    }

    // ✅ 5. Logout
    public static function logout(): void
    {
        self::init();
        session_unset();
        session_destroy();
    }
}
