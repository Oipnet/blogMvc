<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 16/08/18
 * Time: 09:30
 */

namespace App\Middleware;


use Core\Container;

class AuthMiddleware
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke()
    {
        if (!$this->container->getSession()->isAuth()) {
            throw new \Exception('Failled auth');
        }
    }
}