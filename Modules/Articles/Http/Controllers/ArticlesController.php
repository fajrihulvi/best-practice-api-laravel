<?php

namespace Modules\Articles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Articles\Entities\Article;
use Modules\Articles\Transformers\ArticleResource;
use Modules\Articles\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $data = new ArticleResource(true, 'Articles Successfully', Article::getArticle());
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);

        }
    }

    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ArticleRequest $request)
    {
        try {
            $image = $request->validated('file');
            $filename = $image->hashName();
            $image->storeAs('public/articles', $filename);
            
            $data  = [
                'file'     => asset('/public/storage/articles/'.$filename),
                'title'    => $request->validated('title'),
                'body'     => $request->validated('body'),
            ];

            $created = Article::createArticle($data);

            if($created){
                $data = new ArticleResource(true,'Created Successfully', $data);
            } else{
                $data = new ArticleResource(true,'Was not created Successfully', $data);
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
        $data = Article::find($id);
        try {
            if ($request->hasFile('file')) {
                $image = $request->validated('file');
                $filename = $image->hashName();
                $image->storeAs('public/articles', $filename);

                Storage::delete('public/articles/'.$filename);

                $data  = [
                    'file'     => asset('/public/storage/articles/'.$filename),
                    'title'    => $request->validated('title'),
                    'body'     => $request->validated('body'),
                ];
            } else {
                $data  = [
                    'title'    => $request->validated('title'),
                    'body'     => $request->validated('body'),
                ];
            }

            $updated = Article::updateArticle($data);

            if($updated){
                $data = new ArticleResource(true,'Updated Successfully', $data);
            } else{
                $data = new ArticleResource(true,'Was not updated Successfully', $data);
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
            $delete = Article::getArticleByID($id);
            if($delete){
                $data = new ArticleResource(true,'Deleted Successfully', []);
            } else {
                $data = new ArticleResource(true,'Was not deleted Successfully', []);
            }
            return $data;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
