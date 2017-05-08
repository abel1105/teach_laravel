<?php

namespace App\Http\Controllers;


use App\Teach\Article\Entrust\ArticleEntrust;
use App\Teach\Article\Service\ArticleService;
use App\Teach\Article\Support\ArticleStatusSupport;
use App\Teach\Article\Validator\ArticleValidator;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $ArticleService;  // 文章服務器
    protected $ArticleEntrust;  // 文章權限
    protected $ArticleValidator; // 文章驗證

    public function __construct(
        ArticleService $ArticleService,  // 依賴注入
        ArticleValidator $ArticleValidator,   // 依賴注入
        ArticleEntrust $ArticleEntrust   // 依賴注入
    ){
        $this->ArticleService = $ArticleService;
        $this->ArticleValidator = $ArticleValidator;
        $this->ArticleEntrust = $ArticleEntrust;
    }

    /**
     * 列表頁
     * @return      \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function index()
    {
        $articles = $this->ArticleService->getLatestArticlePagination();

        $binding = [
            'articles' => $articles,
        ];

        return view('articles.index', $binding);
    }

    /**
     * 新增頁
     * @return      \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function create()
    {
        $status_list = ArticleStatusSupport::getArticleStatusMapping();

        $binding = [
            'mode' => 'create',
            'statuses' => $status_list,
        ];
        return view('articles.edit', $binding);
    }

    /**
     * 儲存新增文章
     * @param Request $request
     *
     * @return      \Illuminate\Http\RedirectResponse
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            // 驗證資料格式
            $this->ArticleValidator->validateArticle($input);
            // 驗證權限
            $this->ArticleEntrust->canUpdateArticle($input);
            // 儲存
            $Article = $this->ArticleService->store($input);
            return redirect()->route('articles:index')
                ->with(
                    'success',
                    '成功新增 '. $Article->title . ' 文章'
                );
        } catch (Exception $exception) {
            return redirect()->route('articles:create')->withInput()
                ->with(
                    'alert',
                    $exception->getMessage()
                );
        }
    }

    public function show()
    {

    }

    /**
     * 修改文章頁
     * @param         $article_id
     *
     * @return      \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function edit($article_id)
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

    /**
     * 修改文章
     * @param Request $request
     * @param         $article_id
     *
     * @return      \Illuminate\Http\RedirectResponse
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-08
     */
    public function update(Request $request, $article_id)
    {
        try {
            $input = $request->all();
            // 驗證資料格式
            $this->ArticleValidator->validateArticle($input);
            // 驗證權限
            $this->ArticleEntrust->canUpdateArticle($input);
            // 更新資料
            $Article = $this->ArticleService->update($article_id, $input);
            // 修改後導向到列表頁
            return redirect()->route('articles:index')->with(
                'success',
                '成功修改 '. $Article->title. ' 文章'
            );
        } catch (Exception $exception) {
            return redirect()->route('articles:edit', $article_id)->withInput()
                ->with(
                    'alert',
                    $exception->getMessage()
                );
        }
    }

    public function destroy()
    {

    }
}