<?php

namespace App\Http\Controllers;


use App\Teach\Article\Service\ArticleService;

class ArticleController extends Controller
{
    protected $ArticleService;  // 文章服務器
    public function __construct(
        ArticleService $ArticleService  // 依賴注入
    ){
        $this->ArticleService = $ArticleService;
    }

    public function index()
    {
        return view('articles.index');
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}