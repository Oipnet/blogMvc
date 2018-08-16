<?php
namespace Core;

use Twig\Environment;

class Container {
    private $connection = null;
    private $session = null;

    /**
     * Get the database connection
     *
     * @return Connection
     */
    public function getConnection(): Connection
    {
        if ($this->connection) {
            return $this->connection;
        }

        return new Connection(Config::DB_HOST, Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD);
    }

    /**
     * Get the template engine (Twig)
     * @return Environment
     */
    public function getTemplate(): Environment
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../resources/views/');
        $twig = new Environment($loader, [
            'cache' => (Config::ENV === 'dev')?false:__DIR__.'/../var/cache'
        ]);

        return $twig;
    }

    /**
     * Get Session object
     *
     * @return Session
     */
    public function getSession(): Session
    {
        if (! $this->session) {
            $this->session = new Session();
        }

        return $this->session;
    }
}