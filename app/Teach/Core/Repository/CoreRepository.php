<?php

namespace App\Teach\Core\Repository;


use DB;

class CoreRepository
{
    public function __construct()
    {
        // Debug SQL 指令
        DB::enableQueryLog();
    }
}