<?php
require '../vendor/autoload.php';

use Core\Request;
use Core\Router;
use Core\Config;

$request = new Request();

$router = new Router();

require Config::ROUTER_PATH.'/web.php';

try {
    echo $router->dispatch($request);
} catch (\Exception $e) {
    if (Config::ENV == 'dev') {
        echo $e->getMessage().'<br>';
    }
    echo 'Erreur';
}
