<?php

namespace App\Teach\Core\Entrust;


use Auth;

class CoreEntrust
{
    public function User()
    {
        return Auth::user();
    }

}