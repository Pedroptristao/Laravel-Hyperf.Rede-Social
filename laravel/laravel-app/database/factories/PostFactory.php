<?php

namespace Database\Factories;

use Domain\Posts\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'body' => $this->faker->randomHtml(),
            'published' => $this->faker->boolean,
        ];
    }
}
