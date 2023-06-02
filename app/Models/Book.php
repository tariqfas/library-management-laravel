<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_name',
        'author_id',
        'publisher_id',
        'category_id'
    ];
    public function category()
    {
    return $this->belongsTo(Category::class,'category_id');
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function issueBooks()
    {
        return $this->hasMany(IssueBook::class);
    }
}
