<?php

namespace App\Teach\Article\Service;


use App\Teach\Article\Repository\ArticleRepository;
use App\Teach\Core\Service\CoreService;

class ArticleService extends CoreService
{
    protected $ArticleRepository; // 文章函式庫

    public function __construct(
        ArticleRepository $ArticleRepository    // 依賴注入
    ){
        parent::__construct();
        $this->ArticleRepository = $ArticleRepository;
    }


}