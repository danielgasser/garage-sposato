<?php
/**
 * Form submission endpoint.
 * POST /php/submit.php
 */
$configData = require $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';
$configInfo = $configData['company'];
$configForm = $configData['form'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/classes/FormHandler.php';
$handler = new FormHandler([
    'to' => $configForm['to'],
    'from' => $configForm['from'],
    'csv_dir' => $_SERVER['DOCUMENT_ROOT'] . '/include/data',
]);

$csrfToken = $handler->generateCsrfToken();

?>
<!DOCTYPE html>
<html lang="de">
<!-- ======== Head ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/header.php';
?>
<body>

<!-- ======== Nav ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/nav.php';
?>
<!-- ======== Hero ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/hero.php';
?>

<!-- ======== Stats ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/stats.php';
?>

<!-- ======== Reparaturen ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/reparaturen.php';
?>
<!-- ======== Services ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/services.php';
?>

<!-- ======== Bei uns wird Ihr Auto geliebt ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/love.php';
?>

<!-- ======== Bilder ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/bilder.php';
?>

<!-- ======== Angebote & Öffnungszeiten ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/location_opening_hours.php';
?>

<!-- ======== Über uns ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/uber_uns.php';
?>

<!-- ======== Footer ======== -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/footer.php';
?>

</body>
</html>