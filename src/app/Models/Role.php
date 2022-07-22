<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $table = 'role';
    protected $fillable = [
        'name',
        'code',
        'role_group_id'
    ];
}
