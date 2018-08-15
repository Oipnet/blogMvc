<?php
namespace Core;

abstract class Controller {

    /**
     * @var Container
     */
    private $container;

    /**
     * Controller constructor.
     *
     * @param Container $container Dependency injection container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Render the view
     *
     * @param $name View name
     * @param array $args Parameter send to the view
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getView($name, $args = []) {
        $twig = $this->container->getTemplate();

        return $twig->render($name.'.twig', $args);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}