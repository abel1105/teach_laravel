<?php

namespace App\Teach\Article\Service;


use App\Teach\Article\Repository\ArticleRepository;
use App\Teach\Article\Validator\ArticleValidator;
use App\Teach\Core\Service\CoreService;
use Auth;
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

    /**
     * 取得文章
     * @param       $article_id
     *
     * @return      \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function find($article_id)
    {
        try {
            return $this->ArticleRepository->find($article_id);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * 取得最新文章
     * @return      \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function getLatestArticlePagination()
    {
        return $this->ArticleRepository->fetchLatestCreatedAtArticlePagination();
    }

    /**
     * 儲存文章
     * @param       $input
     *
     * @return      \Illuminate\Database\Eloquent\Model
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function store($input)
    {
        try {
            // 轉換資料 (避免過多不必要資料)
            $article_data = $this->transformInputToArticleData($input);
            // 除村文章
            return $this->ArticleRepository->store($article_data);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * 更新文章
     * @param       $article_id
     * @param       $input
     *
     * @return      \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function update($article_id, $input)
    {
        try {
            // 轉換資料 (避免過多不必要資料)
            $article_data = $this->transformInputToArticleData($input);
            // 更新文章
            $Article = $this->ArticleRepository->update($article_id, $article_data);
            return $Article;

        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * 轉換輸入資料成文章資料
     * @param       $input
     *
     * @return      array
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    private function transformInputToArticleData($input)
    {
        try {
            $content = array_get($input, 'content');
            $title = array_get($input, 'title');
            $status = array_get($input, 'status');
            $published_at = array_get($input, 'published_at');
            $user_id = Auth::user()->id;

            $article_data = [
                'content' => $content,
                'title' => $title,
                'status' => $status,
                'published_at' => $published_at,
                'user_id' => $user_id,
            ];

            return $article_data;
        } catch (Exception $exception) {
            throw $exception;
        }
    }


}