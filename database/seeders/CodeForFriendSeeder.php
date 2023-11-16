<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeForFriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CodeForFriend::create([
            'code' => 'ggg',
            'student_id' => 38546,
            'friend_id' => 38547,
        ]);
    }
}
