<?php

namespace Modules\Articles\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Articles\Entities\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'body'  => $this->faker->sentence(200),
            'file' => 'example.png',
        ];
    }
}
