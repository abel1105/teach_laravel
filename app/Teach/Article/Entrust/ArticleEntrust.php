<?php

namespace App\Teach\Article\Entrust;


use App\Teach\Article\Constant\ArticleConstant;
use App\Teach\Core\Entrust\CoreEntrust;
use App\Teach\User\Constant\PermissionConstant;
use App\Teach\User\Constant\RoleConstant;
use Exception;

class ArticleEntrust extends CoreEntrust
{
    public function canUpdateArticle($input)
    {
        $permission_check_result = false;
        try {

            $status = array_get($input, 'status');

            $need_publish = in_array($status, [
                ArticleConstant::ARTICLE_STATUS_PUBLISH_CODE,
                ArticleConstant::ARTICLE_STATUS_SCHEDULE_CODE,
            ]);
            // 檢查是否可以發布文章
            if($need_publish &&
                !$this->User()->can(PermissionConstant::PUBLISH_ARTICLE_PERMISSION)
            ){
                throw new Exception(
                    "您沒有權限發布文章"
                );
            }
            $permission_check_result = true;

        } catch (Exception $exception) {
            throw $exception;
        }

        return $permission_check_result;
    }

}