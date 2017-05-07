<?php

namespace App\Teach\Article\Presenter;


use App\Teach\Article\Constant\ArticleConstant;
use App\Teach\Article\Support\ArticleStatusSupport;
use App\Teach\Core\Presenter\CorePresenter;

class ArticlePresenter extends CorePresenter
{
    public function statusName()
    {
        return ArticleStatusSupport::findArticleStatusNameByCode($this->status);
    }

    public function statusColorClass()
    {
        $status_name = ArticleStatusSupport::findArticleStatusNameByCode($this->status);
        switch ($status_name){
            default:
            case ArticleConstant::ARTICLE_STATUS_DRAFT_NAME:
                return 'bg-gray';
                break;
            case ArticleConstant::ARTICLE_STATUS_NEED_CHECK_NAME:
                return 'bg-yellow';
                break;
            case ArticleConstant::ARTICLE_STATUS_SCHEDULE_NAME:
                return 'bg-light-blue';
                break;
            case ArticleConstant::ARTICLE_STATUS_PUBLISH_NAME:
                return 'bg-green';
                break;
            case ArticleConstant::ARTICLE_STATUS_CLOSE_NAME:
                return 'bg-black';
                break;
        }
    }
}