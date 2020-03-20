<?php

namespace App\services;

class DB
{
    protected static $item;
    protected $connection;
    protected $settings = [
        'driver' => 'mysql',
        'dbname' => 'db',
        'host' => 'localhost:3308',
        'charset' => 'UTF8',
        'user' => 'root',
        'passwd' => ''
    ];

    protected function __construct()
    {
    }
    protected function __clone()
    {
    }
    protected function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (empty(self::$item)) {
            self::$item = new static();
        }

        return self::$item;
    }

    protected function getConnection()
    {
        if (empty($this->connection)) {
            $connection = new \PDO($this->getDsn(), $this->settings['user'], $this->settings['passwd']);
            $connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_CLASS);
            $this->connection = $connection;
        }

        return $this->connection;
    }
    public function find(string $sql, $className = NULL, array $params = [])
    {
        return $this->query($sql, $className, $params)->fetch();
    }

    public function findAll($sql, $className = NULL, array $params = [])
    {
        return $this->query($sql, $className, $params)->fetchAll();
    }

    public function findSelected($sql, $className = NULL, array $params = [])
    {
        $res = $this->query($sql, $className, $params)->fetchAll();
        return $res;
    }

    public function execute(string $sql, $className = NULL, array $params = [])
    {
        return $this->query($sql, $className, $params);
    }

    protected function getDsn()
    {
        return sprintf(
            '%s:dbname=%s;host=%s;charset=%s',
            $this->settings['driver'],
            $this->settings['dbname'],
            $this->settings['host'],
            $this->settings['charset']
        );
    }

    protected function query(string $sql, $className = NULL, array $params = [])
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        if (!$PDOStatement->execute($params)) {
            echo $sql . PHP_EOL;
            var_dump($PDOStatement->errorInfo());
        }

        return $PDOStatement;
    }

    public function getLastId()
    {
        return $this->getConnection()->lastInsertId('id');
    }
}
