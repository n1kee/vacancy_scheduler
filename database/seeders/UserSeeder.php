<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Regular Employee 1',
            'email' => 'employee1@email.com',
            'password' => '$2y$10$qnsMEPOqCVAUt0ECJRkSh.irL5RwWO0UQRgfL9IG4GdoShmLDbKyC',
        ]);

        User::factory()->create([
            'name' => 'Regular Employee 2',
            'email' => 'employee2@email.com',
            'password' => '$2y$10$qnsMEPOqCVAUt0ECJRkSh.irL5RwWO0UQRgfL9IG4GdoShmLDbKyC',
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@email.com',
            'password' => '$2y$10$qnsMEPOqCVAUt0ECJRkSh.irL5RwWO0UQRgfL9IG4GdoShmLDbKyC',
            'is_manager' => true,
        ]);
    }
}
