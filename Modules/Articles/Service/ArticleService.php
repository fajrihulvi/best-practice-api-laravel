<?php

namespace Modules\Articles\Service;

use Modules\Articles\Entities\Article;

class ArticleService 
{
    public function add($data) 
    {
        $image = $data->validated('file');
        
        $filename = $this->uploadImage($image);
        
        $data  = [
            'file'     => asset('/public/storage/articles/'.$filename),
            'title'    => $data->validated('title'),
            'body'     => $data->validated('body'),
        ];

        Article::createArticle($data);

        return $data;
    }

    public function update($data, $id)
    {
        if ($data->hasFile('file')) {

            $image = $data->validated('file');

            $filename = $this->uploadImage($image);

            $data  = [
                'file'     => asset('/public/storage/articles/'.$filename),
                'title'    => $data->validated('title'),
                'body'     => $data->validated('body'),
            ];
        } else {
            $data  = [
                'title'    => $data->validated('title'),
                'body'     => $data->validated('body'),
            ];
        }

        Article::updateArticle($data, $id);
        
        return $data;
    }

    public function delete($id)
    {
        return Article::deleteArticleByID($id);
    }

    private function uploadImage($image)
    {
        $filename = $image->hashName();
        $image->storeAs('public/articles', $filename);
        return $filename;
    }

}