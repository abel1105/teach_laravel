<?php

namespace App\Teach\Article\Service;


use App\Teach\Article\Repository\ArticleRepository;
use App\Teach\Core\Service\CoreService;
use Exception;

class ArticleService extends CoreService
{
    protected $ArticleRepository; // 文章函式庫

    public function __construct(
        ArticleRepository $ArticleRepository    // 依賴注入
    ){
        parent::__construct();
        $this->ArticleRepository = $ArticleRepository;
    }

    public function getLatestArticlePagination()
    {
        return $this->ArticleRepository->fetchLatestCreatedAtArticlePagination();
    }

    public function find($article_id)
    {
        try {
            return $this->ArticleRepository->find($article_id);
        } catch (Exception $exception) {
            throw $exception;
        }
    }


}