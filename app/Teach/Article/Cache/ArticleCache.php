<?php

namespace App\Teach\Article\Cache;


use App\Teach\Article\Constant\ArticleConstant;
use App\Teach\Core\Manager\AbstractCacheManager;

class ArticleCache extends AbstractCacheManager
{

    public function getArticleCacheKey($article_id)
    {
        $encrypt_article_id = $this->encryptCacheParameter($article_id);
        $search = [
            '{article_id}'
        ];
        $replace = [
            $encrypt_article_id
        ];
        return str_replace($search, $replace, ArticleConstant::ARTICLE_CACHE_KEY);
    }
}