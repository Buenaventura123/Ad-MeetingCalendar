<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth
{
    // Login logic
    public static function login(PDO $pdo, string $username, string $password): bool
    {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'name' => $user['first_name'] . ' ' . $user['last_name'],
            ];
            return true;
        }

        return false;
    }

    // Get current user
    public static function user(): array|null
    {
        return $_SESSION['user'] ?? null;
    }

    // Check if user is logged in
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    // Logout logic
    public static function logout(): void
    {
        session_unset();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
    }
}
