<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id',      // ← ここが必要
        'title',
        'content',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
