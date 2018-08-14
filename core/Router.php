<?php
namespace Core;

class Router {
    private $routes;

    public function __construct() {
        $this->routes = [
            'homepage' => [
                'controller' => 'HomeController',
                'action' => 'index'
            ],
            'contact' => [
                'controller' => 'ContactController',
                'action' => 'index'
            ]
        ];
    }

    public function dispatch($url) {
        $page = $_GET['page'] ?? 'homepage';
        $result = $this->routes[$page] ?? null;

        if (! $result) {
            throw new \Exception('Controller non trouvé');
        }

        return $result;
    }

    public function getRoutes() {
        return $this->routes;
    }
}