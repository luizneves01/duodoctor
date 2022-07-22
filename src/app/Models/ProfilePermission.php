<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePermission extends Model
{

    protected $table = 'profile_permission';
    protected $fillable = [
        'profile_id',
        'permission_id'
    ];
}
