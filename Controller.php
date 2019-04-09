<?php

abstract class Controller
{
    public $connect;

    public function __construct(Connect $connect)
    {
        $this->connect = $connect;
    }
}