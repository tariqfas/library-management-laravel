<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'student_id',
        'issue_date',
        'return_date'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
