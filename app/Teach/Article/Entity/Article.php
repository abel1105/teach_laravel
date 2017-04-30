<?php

namespace App\Teach\Article\Entity;


use App\Teach\Article\Presenter\ArticlePresenter;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Article extends Model
{
    use PresentableTrait;

    protected $presenter = ArticlePresenter::class;

    protected $table = 'articles';

    protected $fillable = [
        'title', 'content', 'status', 'published_at'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'published_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Teach\User\Entity\User', 'user_id', 'id');
    }
}