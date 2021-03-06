<?php
namespace Core;

use Core\Exception\RouteNotFoundException;

class Router {
    private $routes;

    public function __construct()
    {
    }

    public function dispatch(Request $request)
    {
        $url = $request->getUri();
        $url = explode('/', $url);
        $method = $request->getMethod();

        $page = $url[0];
        if (! strlen($page)) {
            $page = 'homepage';
        }

        $route = $this->routes[$method][$page] ?? null;

        if (! $route) {
            throw new RouteNotFoundException('Aucune route trouvée pour cette page');
        }

        $controllerClass = '\\App\\Controller\\'.$route['controller'];
        if (! class_exists('\\App\\Controller\\'.$route['controller'])) {
            throw new RouteNotFoundException('Le controller demandé n\'existe pas');
        }

        $controllerClass = new $controllerClass();
        if (! method_exists($controllerClass, $route['action'])) {
            throw new RouteNotFoundException('La methode demandée n\'existe pas');
        }

        array_shift($url);
        array_unshift($url, $request);

        return call_user_func_array([$controllerClass, $route['action']], $url);
    }

    public function get($controller, $name): self
    {
        $controller = explode('@', $controller);
        if (count($controller) !== 2) {
            throw new InvalidArgumentException('Bad controller format');
        }

        $this->routes['GET'][$name] = [
            'controller' => $controller[0],
            'action' => $controller[1]
        ];

        return $this;
    }

    public function getRoutes() {
        return $this->routes;
    }
}