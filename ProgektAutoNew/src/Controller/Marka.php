<?php

namespace App\Controller;


class Marka extends Table
{
    protected string $tableName = "marka_auto";

    public function __construct()
    {
        parent::__construct();
        $this->pageSize = 10;
    }
}