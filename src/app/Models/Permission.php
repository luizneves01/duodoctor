<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $table = 'permission';
    protected $fillable = [
        'group',
        'code',
        'name',
        'route'
    ];
}
