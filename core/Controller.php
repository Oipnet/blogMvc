<?php
namespace Core;

abstract class Controller {
    public function getView($name, $args = []) {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../resources/views/');
        $twig = new \Twig_Environment($loader, [
            'cache' => (Config::ENV === 'dev')?false:__DIR__.'/../var/cache'
        ]);

        //var_dump($args);die();

        return $twig->render($name.'.twig', $args);
    }
}