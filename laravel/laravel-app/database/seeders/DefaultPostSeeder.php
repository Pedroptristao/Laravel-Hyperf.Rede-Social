<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
