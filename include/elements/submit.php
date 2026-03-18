<?php
require_once  '../classes/FormHandler.php';
$handler = new FormHandler([
    'to' => 'daniel@daniel-gasser.com',
    'from' => 'noreply@sposato.ch',
    'csv_dir' => $_SERVER['DOCUMENT_ROOT'] . '/include/data',
]);

$handler->process();