<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 2
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Duman',
            'email' => 'duman@gmail.com',
            'password' => bcrypt('123456'),
            'student_id' => 38546,
            'group_id' => 1,
            'role' => 3
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Talgat',
            'email' => 'talgat@gmail.com',
            'password' => bcrypt('123456'),
            'student_id' => 38547,
            'group_id' => 1,
            'role' => 3
        ]);
    }
}
