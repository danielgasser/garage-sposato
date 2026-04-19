<?php

$hours = require $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/data/opening_hours_data.php';
?>

<table class="opening-hours-table">
    <?php foreach ($hours as $row): ?>
        <tr<?= $row['closed'] ? ' class="closed"' : '' ?>>
            <td><?= $row['day'] ?></td>
            <?php if ($row['closed']): ?>
                <td colspan="2">Geschlossen</td>
            <?php else: ?>
                <td><?= $row['am'] ?></td>
                <td><?= $row['pm'] ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>