<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Infrastructure\Database\Models\UserModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserModel::factory()->create([
            'first_name' => 'Usuario',
            'last_name' => 'Teste',
            'email' => 'pedroptristao@hotmail.com',
        ]);
        
    }
}
