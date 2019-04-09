<?php

class Auth extends Controller
{
    public function login(string $username, string $password)
    {
        if (!isset($username) || !isset($password) ) {
            return new http\Exception\BadConversionException('Upps...');
        }
        $sql = <<<SQL
select * from user where username='{$username}' and password='{$password}'
SQL;

        $stmt = $this->connect->execute($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?? [];
    }
}