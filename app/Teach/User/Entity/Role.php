<?php

namespace App\Teach\User\Entity;

use Zizaco\Entrust\EntrustRole;


/**
 * App\Teach\User\Entity\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teach\User\Entity\Permission[] $perms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teach\User\Entity\User[] $users
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'display_name', 'description'
    ];
}