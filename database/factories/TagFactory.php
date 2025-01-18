<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        $name = $this->faker->unique()->word; 

        return [
            'name' => Str::slug($name), 
            "title" => $name, 
        ];
    }
}
