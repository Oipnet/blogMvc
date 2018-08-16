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

    /**
     * Fetch all table's record
     *
     * @param array $opt
     * @return array
     */
    public function all($opt = []): array
    {
        $sql = 'SELECT * FROM '.$this->table.' ORDER BY created_at DESC';
        if (isset($opt['limit'])) {
            $sql .= ' LIMIT '.$opt['limit'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Fecth first result
     *
     * @param array $opt
     * @return \stdClass
     */
    public function findOneBy($opt = []): \stdClass
    {
        $sql = 'SELECT * FROM '.$this->table;
        $sql .= ' WHERE '.array_keys($opt)[0].' = :'.array_keys($opt)[0];

        $stmt = $this->db->prepare($sql);
        $stmt->execute($opt);

        return $stmt->fetch();
    }
}