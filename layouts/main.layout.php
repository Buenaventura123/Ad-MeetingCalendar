<?php
declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
require_once UTILS_PATH . '/envSetter.util.php';

Auth::init();

require_once COMPONENTS_PATH . '/componentGroup/nav.component.php';
require_once COMPONENTS_PATH . '/componentGroup/header.component.php';
require_once COMPONENTS_PATH . '/componentGroup/footer.component.php';

function renderMainLayout(callable $content, string $title = "App", array $customJsCss = []): void
{
    global $headNavList, $user;

    head($title, $customJsCss['css'] ?? []);
    ?>

    <body>
        <header>
            <?php navHeader($headNavList ?? [], $user ?? null); ?>
        </header>

        <main>
            <?php $content(); ?>
        </main>

        <footer>
            <?php footer(); ?>
        </footer>

        <?php foreach ($customJsCss['js'] ?? [] as $jsPath): ?>
            <script src="<?= $jsPath ?>"></script>
        <?php endforeach; ?>
    </body>

    </html>
    <?php
}
