<?php

namespace Modules\Articles\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Articles\Entities\Article;

class ArticlesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory(100)
        ->create();
    }
}
