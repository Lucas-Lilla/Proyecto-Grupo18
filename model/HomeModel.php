<?php

namespace model;

class HomeModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

}
