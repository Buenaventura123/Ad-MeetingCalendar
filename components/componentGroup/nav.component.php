<?php
function navHeader(array $navItems, ?array $user = null): void
{
    echo '<header class="site-header">';
    echo '<nav class="navbar">';
    echo '<ul class="nav-list">';
    foreach ($navItems as $item) {
        echo '<li><a href="' . htmlspecialchars($item['href']) . '">' . htmlspecialchars($item['label']) . '</a></li>';
    }
    if ($user) {
        echo '<li class="user-info">👤 ' . htmlspecialchars($user['first_name']) . '</li>';
        echo '<li><a href="/handlers/auth.handler.php?action=logout">Logout</a></li>';
    } else {
        echo '<li><a href="/pages/login/index.php">Login</a></li>';
    }
    echo '</ul>';
    echo '</nav>';
    echo '</header>';
}
