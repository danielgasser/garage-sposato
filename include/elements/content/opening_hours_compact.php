<?php
$hours = require $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/data/opening_hours_data.php';
?>
<ul class="footer-hours">
    <?php foreach ($hours as $row): ?>
        <li<?= $row['closed'] ? ' class="closed"' : '' ?>>
            <span><?= $row['day'] ?></span>
            <span><?= $row['closed'] ? 'Geschlossen' : $row['am'] . ' / ' . $row['pm'] ?></span>
        </li>
    <?php endforeach; ?>
</ul>