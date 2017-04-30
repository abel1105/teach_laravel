<?php

namespace App\Teach\Article\Repository;


use App\Teach\Article\Cache\ArticleCache;
use App\Teach\Article\Entity\Article;
use App\Teach\Core\Repository\CoreRepository;

class ArticleRepository extends CoreRepository
{
    protected $Article; // 文章 Model
    protected $cache;

    public function __construct(
        Article $Article      // 依賴注入
    ) {
        parent::__construct();
        $this->Article = $Article;
        $this->cache = new ArticleCache($this);
    }

    public function find($article_id)
    {
        $cache_key = $this->cache->getArticleCacheKey($article_id);
        if($this->cache->hasCache($cache_key)) {
            return $this->cache->getCache($cache_key);
        }

        $Article = $this->Article
            ->find($article_id);

        if(!is_null($Article)){
            $this->cache->putCache($Article, $cache_key);
        }
        return $Article;
    }

    public function fetchLatestCreatedAtArticlePagination()
    {

        $ArticlePagination = $this->Article
            ->latest('created_at')
            ->paginate('3');

        return $ArticlePagination;
    }

}