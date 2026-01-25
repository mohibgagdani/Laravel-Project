<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'author_id', 'category_id', 'quantity', 'available_quantity'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function issues()
    {
        return $this->hasMany(BookIssue::class);
    }

    public function isAvailable()
    {
        return $this->available_quantity > 0;
    }
}
