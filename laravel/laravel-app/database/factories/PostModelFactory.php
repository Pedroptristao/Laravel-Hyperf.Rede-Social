<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Infrastructure\Database\Models\PostModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'post_image_path' => $this->faker->filePath(),
            'body' => $this->faker->randomHtml,
            'published' => $this->faker->boolean(),
            'user_id' => 1,
        ];
    }
}
