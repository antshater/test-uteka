<?php

require 'vendor/autoload.php';


use App\Exceptions\NotFoundException;
use App\Http\Request\Request;
use App\Http\Router;


$request = new Request($_SERVER['REQUEST_URI'], $_POST);
$route_config = require 'app/routes.php';
try {
    $router = new Router($route_config, $request);
    $controller = $router->controller();
    if (! $controller || ! method_exists($controller, $router->controllerMethod())) {
        throw new NotFoundException('Route ' . $request->routePath() . ' not found');
    }

    $controller->{$router->controllerMethod()}();

} catch (NotFoundException $e) {
    header("HTTP/1.0 404 Not Found");
    echo $e->getMessage();
    exit;
}

