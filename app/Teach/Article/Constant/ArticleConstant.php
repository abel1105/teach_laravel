<?php

namespace App\Teach\Article\Constant;


class ArticleConstant
{
    const ARTICLE_STATUS_DRAFT_CODE = 'D'; // 草稿
    const ARTICLE_STATUS_NEED_CHECK_CODE = 'N'; // 需確認
    const ARTICLE_STATUS_SCHEDULE_CODE = 'S'; // 排程
    const ARTICLE_STATUS_PUBLISH_CODE = 'P'; // 發布
    const ARTICLE_STATUS_CLOSE_CODE = 'C'; // 取消

    const ARTICLE_STATUS_DRAFT_NAME = 'draft'; // 草稿
    const ARTICLE_STATUS_NEED_CHECK_NAME = 'need_check'; // 需確認
    const ARTICLE_STATUS_SCHEDULE_NAME = 'schedule'; // 排程
    const ARTICLE_STATUS_PUBLISH_NAME = 'publish'; // 發布
    const ARTICLE_STATUS_CLOSE_NAME = 'close'; // 取消

    const ARTICLE_CACHE_KEY = "[Teach][Article][Id][{article_id}]";
}