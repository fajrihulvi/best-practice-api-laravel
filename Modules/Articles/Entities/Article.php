<?php

namespace Modules\Articles\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'body',
        'file'
    ];

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Articles\Database\factories\ArticleFactory::new();
    }

    public static function getArticle()
    {
        return Article::paginate(10);
    }

    public static function getArticleByID($id)
    {
        return Article::find($id);
    }

    public static function createArticle($data)
    {
        return Article::create($data);
    }

    public static function updateArticle($data, $id)
    {
        return Article::find($id)->update($data);
    }

    public static function deleteArticleByID($id)
    {
        return Article::find($id)->delete();
    }
}