<?php

class Cases extends Controller
{
    public function all($limit=10)
    {
        $sql = "select * from `case` limit $limit";
        $stmt = $this->connect->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id)
    {
        $sql = "select * from `case` where id= {$id}";
        $stmt = $this->connect->execute($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $description)
    {
        $sql = "insert into `case` (`title`, `description`) value ('$title', '$description')";
        $result = $this->connect->execute($sql);
        return $result ? 'ok' : false;
    }
}