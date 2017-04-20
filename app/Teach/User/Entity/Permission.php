<?php

namespace App\Teach\User\Entity;

use Zizaco\Entrust\EntrustPermission;


/**
 * App\Teach\User\Entity\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teach\User\Entity\Role[] $roles
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
    protected $table = 'permissions';

    protected $fillable = [
        'name', 'display_name', 'description'
    ];
}