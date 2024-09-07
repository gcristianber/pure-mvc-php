<?php

require 'vendor/autoload.php';
require 'app/utils/string.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [App\Controllers\IndexController::class, 'index']);
    $r->addRoute('GET', '/self-invoke', function () {
        echo "Hello Self Invoke";
    });
});

$app = new App\Core\App($dispatcher);