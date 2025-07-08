<?php
declare(strict_types=1);

// 1. Bootstrap, Autoload, Auth
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
require_once UTILS_PATH . '/envSetter.util.php';
Auth::init();

// 2. Load template components
require_once COMPONENTS_PATH . '/template/head.component.php';
require_once COMPONENTS_PATH . '/template/nav.component.php';
require_once COMPONENTS_PATH . '/template/footer.component.php';

// 3. Load static data for nav if available
$headNavList = []; // default to empty
$navDataPath = STATICDATAS_PATH . '/navPages.staticData.php';
if (file_exists($navDataPath)) {
    $headNavList = require_once $navDataPath;
}

// 4. Determine current user
$user = Auth::user();

function renderMainLayout(callable $content, string $title, array $customJsCss = []): void
{
    global $headNavList, $user;

    // HEAD
    head($title, $customJsCss['css'] ?? []);

    // NAVIGATION
    navHeader($headNavList, $user);

    // MAIN CONTENT
    echo '<main>';
    $content();
    echo '</main>';

    // FOOTER
    footer($customJsCss['js'] ?? []);
}
