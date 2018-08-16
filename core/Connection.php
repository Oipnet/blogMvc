<?php

namespace Core;

use PDO;

class Connection extends PDO {

    private $db;

    /**
     * Connection constructor.
     */
    public function __construct($host, $name, $username, $password)
    {
        $opt = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
        $dns = "mysql:host=" . $host . ";dbname=" . $name . ";charset=utf8";

        $this->db = new PDO($dns,
            $username, $password, $opt);
    }

    /**
     * Get a PDO instance
     *
     * @return PDO
     */
    public function getDb(): PDO
    {
        return $this->db;
    }
}