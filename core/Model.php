<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 14/08/18
 * Time: 17:35
 */

namespace Core;

use PDO;

abstract class Model
{
    public function __construct()
    {
        $opt = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
        $dns = "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=utf8";

        $this->db = new PDO($dns,
            Config::DB_USER, Config::DB_PASSWORD, $opt);

        $this->table = explode('\\', get_class($this));
        $this->table = array_pop($this->table);
        $this->table .= 's';
    }

    public function all($opt = [])
    {
        $sql = 'SELECT * FROM '.$this->table.' ORDER BY created_at DESC';
        if (isset($opt['limit'])) {
            $sql .= ' LIMIT '.$opt['limit'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findBy($opt = [])
    {
        $sql = 'SELECT * FROM '.$this->table;
        $sql .= ' WHERE '.array_keys($opt)[0].' = :'.array_keys($opt)[0];

        $stmt = $this->db->prepare($sql);
        $stmt->execute($opt);

        return $stmt->fetch();
    }
}