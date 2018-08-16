<?php
require '../vendor/autoload.php';

/** Fix for nginx */
if (!function_exists('getallheaders'))
{
    function getallheaders()
    {
        $headers = array ();
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

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
