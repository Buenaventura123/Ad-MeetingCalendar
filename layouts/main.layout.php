<?php
declare(strict_types=1);

// Bootstrap, Autoload, Auth
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once COMPONENTS_PATH . '/template/head.component.php';
require_once COMPONENTS_PATH . '/template/nav.component.php';
require_once COMPONENTS_PATH . '/template/footer.component.php';

// Dummy nav data (if needed)
$headNavList = $headNavList ?? [];
$user = Auth::user();

// Main layout rendering function
function renderMainLayout(callable $content, string $title, array $customJsCss = []): void
{
    global $headNavList, $user;

    head($title, $customJsCss['css'] ?? []);
    navHeader($headNavList, $user);
    $content(); // the actual page content
    footer($customJsCss['js'] ?? []);
}
