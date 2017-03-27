<?php

class Model
{
    /**
     * @var Database
     */
    public $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }
}