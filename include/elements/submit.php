<?php
$config  = require $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';
$configForm = $config['form'];
$configDB = $config['db'];

try {
    require_once '../classes/FormHandler.php';
    require_once '../classes/FormStorage.php';

    $handler = new FormHandler($configForm);
    $storage = new FormStorage($configDB);

    $storage = new FormStorage($configDB);
    $handler->setStorage($storage);

    $handler->process();

} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'FormHandler: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
       // 'message' => 'Serverfehler. Bitte versuchen Sie es später.',
    ]);
    error_log('FormHandler: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());

}
