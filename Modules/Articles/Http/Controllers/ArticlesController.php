<?php

namespace Modules\Articles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Articles\Entities\Article;
use Modules\Articles\Transformers\ArticleResource;
use Modules\Articles\Http\Requests\ArticleRequest;
use Modules\Articles\Service\ArticleService;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     protected $articleService;

     public function __construct(ArticleService $articleService)
     {
         $this->articleService = $articleService;
     }

    public function index()
    {
        try {
            $data = new ArticleResource(true, 'Articles Successfully', Article::getArticle());
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ArticleRequest $request)
    {
        try {

            $result = $this->articleService->add($request);

            if($result){
                $data = new ArticleResource(true,'Created Successfully', $result);
            } else{
                $data = new ArticleResource(true,'Was not created Successfully', $result);
            }
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        try {
            $data = new ArticleResource(true, $id. '-Articles Successfully', Article::getArticleByID($id));
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ArticleRequest $request, $id)
    {
        try {

            $result = $this->articleService->update($request, $id);

            if($result){
                $data = new ArticleResource(true,'Updated Successfully', $result);
            } else{
                $data = new ArticleResource(true,'Was not updated Successfully', $result);
            }
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $data = Article::getArticleByID($id);
            
            $delete = $this->articleService->delete($id);

            if($delete){
                $data = new ArticleResource(true,'Deleted Successfully', $data);
            } else {
                $data = new ArticleResource(true,'Was not deleted Successfully', $data);
            }
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
