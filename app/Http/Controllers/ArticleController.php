<?php

namespace App\Http\Controllers;


use App\Teach\Article\Service\ArticleService;
use App\Teach\Article\Support\ArticleStatusSupport;
use Illuminate\Http\Request;

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
        $articles = $this->ArticleService->getLatestArticlePagination();

        $binding = [
            'articles' => $articles,
        ];

        return view('articles.index', $binding);
    }

    public function create()
    {
        $status_list = ArticleStatusSupport::getArticleStatusMapping();

        $binding = [
            'mode' => 'create',
            'statuses' => $status_list,
        ];
        return view('articles.edit', $binding);
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit(Request $request, $article_id)
    {
        $Article = $this->ArticleService->find($article_id);
        $status_list = ArticleStatusSupport::getArticleStatusMapping();

        $binding = [
            'mode' => 'edit',
            'article' => $Article,
            'statuses' => $status_list,
        ];
        return view('articles.edit', $binding);

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}