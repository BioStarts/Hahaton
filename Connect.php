<?php

class Connect
{
    private $connection;

    public function __construct($host, $db, $username, $password)
    {
        $this->connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
    }
    public function getConnection() {
        return $this;
    }

    public function execute($sql, $args = null){
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}