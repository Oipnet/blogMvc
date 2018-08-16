<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 16/08/18
 * Time: 09:30
 */

namespace App\Middleware;


use Core\Container;
use Core\Exception\NotAllowedException;

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

    /**
     * @throws NotAllowedException
     */
    public function __invoke()
    {
        if (!$this->container->getSession()->getAuth()) {
            throw new NotAllowedException('You can\'t acces here');
        }
    }
}