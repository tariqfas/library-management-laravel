<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
        // return $this->belongsToMany(Student::class, 'role_user');
    }
}
