<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Group::create([
            'name' => "SE-231-M",
        ]);
        \App\Models\Group::create([
            'name' => "SE-232-M",
        ]);
    }
}
