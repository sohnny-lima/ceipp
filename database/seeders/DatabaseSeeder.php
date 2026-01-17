<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Instructor',
                'password' => Hash::make('123456'),
                'address' => '',
                'number' => '',
                'phone' => '',
                'type' => 'admin',
            ]
        );

        $this->call([
            CourseSeeder::class,
        ]);
    }
}
