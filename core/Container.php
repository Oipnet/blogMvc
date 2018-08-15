<?php
namespace Core;

class Container {
    private $connection = null;
    private $session = null;
    
    public function getConnection()
    {
        if ($this->connection) {
            return $this->connection;
        }

        return new Connection(Config::DB_HOST, Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD);
    }

    public function getTemplate()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../resources/views/');
        $twig = new \Twig_Environment($loader, [
            'cache' => (Config::ENV === 'dev')?false:__DIR__.'/../var/cache'
        ]);

        return $twig;
    }

    public function getSession()
    {
        if ($this->session) {
            return $this->session;
        }

        return new Session();
    }
}