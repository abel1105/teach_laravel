<?php

namespace App\Teach\Core\Validator;


use App\Teach\Core\ExceptionCode\CoreExceptionCode;
use Exception;
use Illuminate\Support\Arr;
use Validator;


class CoreValidator {

    /**
     * 所有驗證的規則
     * @var  array
     */
    protected $validationRules = [];

    /**
     * 需要驗證的規則
     * @var  array
     */
    protected $rules = [];

    /**
     * 驗證器
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * 傳入的資料
     * @var  array
     */
    protected $inputData = [];


    /**
     * 是否驗證成功
     *
     * @return      Boolean         是否驗證成功
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-30
     */
    public function isValid()
    {
        $this->validator = Validator::make($this->inputData, $this->rules);

        return $this->validator->passes();
    }

    /**
     * 是否驗證失敗
     * @param       array           $input          輸入內容
     * @param       array           $rules          驗證規則
     *
     * @return      Boolean         是否驗證失敗
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-30
     */
    public function isInvalid($input, $rules)
    {
        // 設定驗證器規則
        $this->setValidationRules($rules);
        // 設定傳入的資料
        $this->setInputData($input);

        $this->validator = Validator::make($this->inputData, $this->rules);

        return $this->validator->fails();
    }

    /**
     * 取得驗證錯誤的資料
     * @return      \Illuminate\Support\MessageBag
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-01
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }


    /**
     * 取得驗證錯誤的訊息
     * @return      mixed
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2016-08-16
     */
    public function getMessages()
    {
        $errors = $this->validator->errors();

        return $errors->first();

    }

    /**
     * 設定輸入資料
     * @param       array           $inputData          傳入的資料
     *
     * @return      $this
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-30
     */
    public function setInputData($inputData)
    {
        $this->inputData = $inputData;

        return $this;
    }

    /**
     * 設定驗證規則
     * @param       array           $set_rules          驗證規則
     *
     * @return      $this
     * @throws      \Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-30
     */
    protected function setValidationRules($set_rules = [])
    {
        // 產生的規則
        $rules = [];
        try {
            foreach ($set_rules as $index => $value) {
                // 如果有設定 array key
                $column = Arr::isAssoc($set_rules) ? $index : $value;
                if (isset($this->validationRules[$column])) {
                    // 如果有設定 array key
                    $rules[$column] = Arr::isAssoc($set_rules) ?
                        array_merge($this->validationRules[$column], $value) :
                        $this->validationRules[$column];
                } else {
                    // 沒有該規則，拋出錯誤
                    throw new Exception(
                        "Validator Rules Not Exist",
                        CoreExceptionCode::VALIDATOR_RULES_NOT_EXIST_EXCEPTION
                    );
                }
            }
        } catch (Exception $exception) {
            throw $exception;
        }

        // 設定驗證器規則
        $this->rules = $rules;

        return $this;
    }

    /**
     * 取得目前驗證規則
     * @return      array           目前驗證的規則
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-30
     */
    protected function getRules()
    {
        return $this->rules;
    }
}