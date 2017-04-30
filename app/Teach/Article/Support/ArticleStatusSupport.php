<?php

namespace App\Teach\Article\Support;


use App\Teach\Article\Constant\ArticleConstant;
use Exception;

class ArticleStatusSupport
{

    public static function getArticleStatusMapping() {
        return [
            ArticleConstant::ARTICLE_STATUS_DRAFT_CODE => ArticleConstant::ARTICLE_STATUS_DRAFT_NAME,
            ArticleConstant::ARTICLE_STATUS_NEED_CHECK_CODE => ArticleConstant::ARTICLE_STATUS_NEED_CHECK_NAME,
            ArticleConstant::ARTICLE_STATUS_SCHEDULE_CODE => ArticleConstant::ARTICLE_STATUS_SCHEDULE_NAME,
            ArticleConstant::ARTICLE_STATUS_PUBLISH_CODE => ArticleConstant::ARTICLE_STATUS_PUBLISH_NAME,
            ArticleConstant::ARTICLE_STATUS_CLOSE_CODE => ArticleConstant::ARTICLE_STATUS_CLOSE_NAME ,
        ];
    }

    /**
     * @param       string          $status_code
     *
     * @return      mixed
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public static function findArticleStatusNameByCode($status_code)
    {
        try {
            $article_status_mapping_list = static::getArticleStatusMapping();
            return array_get($article_status_mapping_list, $status_code, null);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param       $status_name
     *
     * @return      mixed
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public static function findArticleStatusCodeByName($status_name)
    {
        try {
            $article_status_mapping_list = static::getArticleStatusMapping();
            if(in_array($status_name, $article_status_mapping_list)){
                return array_search($status_name, $article_status_mapping_list);
            }
            return null;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}