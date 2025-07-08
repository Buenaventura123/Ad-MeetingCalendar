<?php
function footer(array $jsPaths = []): void
{
    ?>
    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Meeting Calendar</p>
    </footer>
    <?php foreach ($jsPaths as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
    </body>

    </html>
    <?php
}
