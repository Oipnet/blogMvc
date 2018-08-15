<?php
require '../vendor/autoload.php';

use Core\Container;
use \Core\Router;
use \Core\Config;

$container = new Container();
$router = new Router($container);

require Config::ROUTER_PATH.'/web.php';

try {
    ob_start();
    echo $router->dispatch();
    ob_end_flush();
} catch (\Exception $e) {
    if (Config::ENV == 'dev') {
        echo $e->getMessage().'<br>';
    }
    echo 'Erreur';
}
