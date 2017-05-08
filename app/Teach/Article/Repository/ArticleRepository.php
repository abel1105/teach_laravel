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

    /**
     * 取得文章
     * @param       $article_id
     *
     * @return      \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
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

    /**
     * 取得最新創建的文章集
     * @return      \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function fetchLatestCreatedAtArticlePagination()
    {

        $ArticlePagination = $this->Article
            ->latest('created_at')
            ->paginate('3');

        return $ArticlePagination;
    }

    /**
     * 更新文章
     * @param $article_id
     * @param $article_data
     *
     * @return      \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function update($article_id, $article_data)
    {
        $Article = $this->find($article_id);
        $Article->update($article_data);
        return $Article;
    }

    /**
     * 新增文章
     * @param $article_data
     *
     * @return      \Illuminate\Database\Eloquent\Model
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function store($article_data)
    {
        $Article = $this->Article->create($article_data);
        return $Article;
    }

}