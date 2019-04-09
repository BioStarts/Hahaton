<?php


class User extends Controller
{
    public function all($limit=10)
    {
        $sql = "select * from user limit $limit";
        $stmt = $this->connect->getConnection()->execute($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id)
    {
        $sql = "select * from `user` where id= {$id}";
        $stmt = $this->connect->execute($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function levelUp($id, $level)
    {
        $sql = "update user set level = {$level} where id={$id};";
        $this->connect->getConnection()->execute($sql);
    }
}