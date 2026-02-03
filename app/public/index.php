<?php
require __DIR__ . '/../vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

// 1. Define Routes (Bootstrap Exercise uses ProductController)
$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\ProductController', 'index']);
    $r->addRoute('GET', '/product/{id}', ['App\Controllers\ProductController', 'get']);
});

// 2. Dispatch
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

// 3. Handle Route
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        
        // Instantiate the controller and call the method
        $class = $handler[0];
        $method = $handler[1];
        $controller = new $class();
        $controller->$method($vars);
        break;
}