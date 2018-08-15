<?php
namespace Core;

use Core\Exception\RouteNotFoundException;

class Router {
    private $routes;
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch() 
    {
        $url = ltrim($_SERVER['REQUEST_URI'], '/');
        $url = explode('/', $url);
        $method = $_SERVER['REQUEST_METHOD'];

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

        $controllerClass = new $controllerClass($this->container);
        if (! method_exists($controllerClass, $route['action'])) {
            throw new RouteNotFoundException('La methode demandée n\'existe pas');
        }

        array_shift($url);
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