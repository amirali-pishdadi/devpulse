<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
               
        Category::factory(5)->create();
        User::factory(5)->create();

        $articles = Article::factory(10)->create(); 
        $tags = Tag::factory(5)->create();         

        $articles->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray() 
            );
        });

        Comment::factory(5)->create();


    }
}
