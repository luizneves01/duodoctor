<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class RoleGroup extends Model {

    protected $table = 'role_group';
    protected $fillable = [
        'name',
    ];
}
