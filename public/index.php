<?php
require '../vendor/autoload.php';

use Core\Container;
use Core\Request;
use Core\Router;
use Core\Config;

$request = new Request();

$router = new Router();

require Config::ROUTER_PATH.'/web.php';

try {
    ob_start();
    echo $router->dispatch($request);
    ob_end_flush();
} catch (\Exception $e) {
    if (Config::ENV == 'dev') {
        echo $e->getMessage().'<br>';
    }
    echo 'Erreur';
}
