<?php

class Messages extends Controller
{
    public function all($limit=10)
    {
        $sql = "select * from `message` limit $limit";
        $stmt = $this->connect->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id)
    {
        $sql = "select * from `message` where id= {$id}";
        $stmt = $this->connect->execute($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}