<?php

use PhpUtils\Types\Collection;
use PhpUtils\Types\Str;

require(__DIR__.'/../vendor/autoload.php');


// Error handling
error_reporting(E_ALL);

$environment = 'development';

$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function(Exception $e){
        error_log($e->getMessage());
    });
}
$whoops->register();

// Dependency injector
/** @var \Auryn\Injector $injector */
$injector = include('Dependencies.php');

// HTTP objects
$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

// Routing
$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});

$httpMethod = new Str($_SERVER['REQUEST_METHOD']);
$uri = Str::make($_SERVER['REQUEST_URI'])
    ->truncateOnChar('?')
    ->rawUrlDecode();

$routeInfo = $dispatcher->dispatch($httpMethod->toString(), $uri->toString());

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];

        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        $response->setHeader(
            'Allow',
            Collection::make($allowedMethods)->join()
        );
        break;

    case FastRoute\Dispatcher::FOUND:
        $class = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        $controller = $injector->make($class);
        call_user_func_array([$controller, $method], $vars);
        break;
}

// Display view
foreach ($response->getHeaders() as $header) {
    header($header, false);
}

echo $response->getContent();
