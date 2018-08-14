<?php
require '../vendor/autoload.php';
use \Core\Router;

$router = new Router();
$url = $_SERVER['REQUEST_URI'];

try {
    $dispatcher = $router->dispatch($url);

    $controller = '\\App\\'.$dispatcher['controller'];
    $controller = new $controller();
    
    $function = $dispatcher['action'];
    echo $controller->$function();
} catch (\Exception $e) {
    echo 'Erreur';
}
