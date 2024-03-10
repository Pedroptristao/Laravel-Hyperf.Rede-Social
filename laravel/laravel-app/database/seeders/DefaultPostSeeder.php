<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Posts\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Database\Seeder;

class DefaultPostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(3)->for(
            User::factory()->create()
        )->create();
    }
}
