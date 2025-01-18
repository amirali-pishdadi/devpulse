<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
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
        $title = $this->faker->sentence;
        return [
            'title'              => $title,
            'slug'               => Str::slug($title),
            'content'            => $this->faker->paragraphs(5, true), // 5 paragraphs
            'excerpt'            => $this->faker->text(150),
            'status'             => $this->faker->randomElement(['draft', 'published']),
            'category_id'        => Category::inRandomOrder()->first()->id ?? null,
            'author_id'          => User::factory(), // Link to a random user
            'featured_image_url' => $this->faker->imageUrl(800, 600, 'tech'), // Example placeholder image
            'reading_time'       => $this->faker->numberBetween(5, 15), // Random reading time
            'views_count'        => $this->faker->numberBetween(0, 500),
            'likes_count'        => $this->faker->numberBetween(0, 200),
            'created_at'         => now(),
            'updated_at'         => now(),
        ];
    }
}
