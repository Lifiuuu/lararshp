<?php

namespace Database\Seeders;

use App\Models\DataUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DataUser::factory(10)->create();

        DataUser::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
