<?php
function navHeader(array $navItems, ?array $user): void
{
    ?>
    <nav class="navbar">
        <div class="nav-left">
            <a href="/">🏠 Home</a>
        </div>
        <div class="nav-right">
            <?php if ($user): ?>
                <span>Welcome, <?= htmlspecialchars($user['first_name']) ?></span>
                <a href="/handlers/auth.handler.php?action=logout">Logout</a>
            <?php else: ?>
                <a href="/pages/login/index.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <?php
}
