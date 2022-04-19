<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
    }
}
