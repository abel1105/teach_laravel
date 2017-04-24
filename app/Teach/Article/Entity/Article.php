<?php

namespace App\Teach\Article\Entity;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title', 'content', 'status', 'published_at'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'published_at',
    ];
}