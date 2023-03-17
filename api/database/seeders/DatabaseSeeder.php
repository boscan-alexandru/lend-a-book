<?php

namespace Database\Seeders;

use Database\Seeders\UsersSeeder;
use Database\Seeders\BooksSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(BooksSeeder::class);
    }
}
