<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articles>
 */
class ArticlesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //protected $article = Articles::class;
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'title' => fake()-> sentences(3, true),
            'types_id' => fake()->numberBetween(2, 5), 
            'users_id' => fake()->numberBetween(2, 2),
            'keywords' => fake()->sentence(5, true),
            'description' => fake()->sentence(5, true),
            'content' => fake()->text(200),
            'author' => fake()->userName(),
            'source' => fake()->url(),
            'cover' =>fake()->imageUrl(),
            'status' => fake()->numberBetween(0, 1),
            'views' => fake()->randomNumber(5), //一个在0到99999之间的随机数
            'likes' => fake()->numberBetween(0, 1),
            'created_at' => fake()->dateTimeBetween('-1 month', '+3 days'),
            'updated_at' => fake()->dateTimeBetween('-1 month', '+3 days'),
        ];
    }
}