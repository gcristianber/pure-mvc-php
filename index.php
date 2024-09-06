<?php

require 'vendor/autoload.php';
require 'app/utils/string.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', [App\Controllers\IndexController::class, 'index']);
    $r->addRoute('GET', '/self-invoke', function () {
        // echo "Sample Self Invoking Route";
        return view("index");
    });
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Handle 404 Not Found
        echo "404 Not Found";
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // Handle 405 Method Not Allowed
        echo "405 Method Not Allowed";
        break;
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // Check if handler is callable
        if (is_callable($handler)) {
            // Invokes the function itself.
            call_user_func_array($handler, $vars);
        } else {
            // Default action when the handler is a class method or similar
            if (is_array($handler) && isset($handler[0]) && isset($handler[1])) {
                $controller = new $handler[0]();
                $method = $handler[1];
                
                // Ensure the method exists and is callable
                if (method_exists($controller, $method) && is_callable([$controller, $method])) {
                    call_user_func_array([$controller, $method], $vars);
                } else {
                    echo "Method not found";
                }
            } else {
                echo "Handler is not callable";
            }
        }

        break;
}
