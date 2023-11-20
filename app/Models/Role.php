<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        // A role can have many users
        return $this->belongsToMany('User', 'user_role');
    }
}
