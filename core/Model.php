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
    public function __construct(Container $container)
    {
        $this->db = $container->getConnection()->getDb();

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