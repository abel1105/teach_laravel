<?php

namespace App\Teach\Article\Validator;


use App\Teach\Article\ExceptionCode\ArticleExceptionCode;
use App\Teach\Article\Support\ArticleStatusSupport;
use App\Teach\Core\Validator\CoreValidator;
use Exception;

class ArticleValidator extends CoreValidator
{
    protected $validationRules = [
        'title' => [
            'required',
            'max:30',
        ],
        'content' => [
            'required',
        ],
        'status' => [
            'required',
            'in:'.ArticleStatusSupport::ARTICLE_STATUS_CODE_LIST_STRING,
        ],
        'published_at' => [
            'required',
            'date'
        ],
    ];

    public function validateArticle($input)
    {
        $validateResult = false;
        try {
            $rules = [
                'title','content','status','published_at'
                // 'title'=>[],'content'=>[],'status'=>[],'published_at'=>[]
            ];
            if($this->isInvalid($input, $rules)){
                // 驗證失敗
                throw new Exception(
                    $this->getMessages(),
                    ArticleExceptionCode::ARTICLE_FORMAT_ERROR
                );
            }
            $validateResult = true;
        } catch (Exception $exception) {
            throw $exception;
        }
        return $validateResult;
    }



}