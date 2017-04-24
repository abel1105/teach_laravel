<?php

namespace App\Teach\Article\Repository;


use App\Teach\Article\Entity\Article;
use App\Teach\Core\Repository\CoreRepository;

class ArticleRepository extends CoreRepository
{
    protected $Article; // 文章 Model

    public function __construct(
      Article $Article      // 依賴注入
    ) {
        parent::__construct();
        $this->Article = $Article;
    }


}