<?php

namespace Classes\Entities;

use Classes\Config\DBConfig;
use PDO;

/**
 * Class AbstractRepository
 *
 * @package Classes\Entities
 */
class AbstractRepository
{
    /**
     * @var PDO
     */
    protected $dbh = null;

    /**
     * @var string
     */
    protected $sql;

    /**
     * @var array
     */
    protected $result;

    /**
     * open the connection to the database
     */
    private function connect()
    {
        $this->dbh = new PDO(DBConfig::$DB_CONNECTIONSTRING, DBConfig::$DB_USER, DBConfig::$DB_PASSWORD);
    }

    /**
     *
     */
    private function disconnect()
    {
        $this->dbh = null;
    }

    /**
     * @param $sql
     *
     * @return array
     */
    public function fetchAll($sql)
    {
        $this->sql = $sql;
        $this->connect();
        $stmt = $this->dbh->prepare($this->sql);
        $stmt->execute();
        $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();

        return $this->result;
    }
}
