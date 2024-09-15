<?php

namespace Database\Seeders;

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
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'agent',
                'email' => 'agent@agent.com',
                'password' => bcrypt('password'),
                'role' => 'agent',
            ],
            [
                'name' => 'regular',
                'email' => 'regular@regular.com',
                'password' => bcrypt('password'),
                'role' => 'regular',
            ]
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
