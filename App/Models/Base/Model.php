<?php


namespace App\Models\Base;


class Model
{
    protected $db;

    public function __construct(\PDO $db){
        $this->db = $db;
    }
}