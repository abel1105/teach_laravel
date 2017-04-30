<?php

namespace App\Teach\Core\Service;


use DB;

class CoreService
{
    public function __construct()
    {
        // Debug SQL 指令
        DB::enableQueryLog();
    }
}