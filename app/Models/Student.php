<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'email',
        'gender',
        'phone',
        'address',
        'classes'
    ];
    public function issueBooks()
    {
        return $this->hasMany(IssueBook::class);
    }
}
