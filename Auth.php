<?php

class Auth extends Controller
{
    public function login(string $username, string $password)
    {
        if (isset($username) || isset($password) ) {
            return new http\Exception\BadConversionException('Upps...');
        }
        $sql = <<<SQL
select * from user where username='{$username}' and password='{$password}'
SQL;
        return $this->connect->getConnection()->execute($sql);
    }
}