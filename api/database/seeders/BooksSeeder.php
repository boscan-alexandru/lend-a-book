<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        DB::table('books')->truncate();

        $units = [
            [
                'id' => 0,
                'cover' => '/src/assets/images/book_covers/harry.jpg',
                'name' => 'Harry Potter and the Goblet of fire by J.K. Rowling',
                'quantity' => 4,
            ],
            [
                'id' => 1,
                'cover' => '/src/assets/images/book_covers/killer.jpg',
                'name' => 'The killer poison by Jule Martinez',
                'quantity' => 8,
            ],
            [
                'id' => 2,
                'cover' => '/src/assets/images/book_covers/lifeofpi.jpg',
                'name' => 'Life of Pi by Yann Martel',
                'quantity' => 2,
            ],
            [
                'id' => 3,
                'cover' => '/src/assets/images/book_covers/martian.jpg',
                'name' => 'The Martian by Andy Weir',
                'quantity' => 3,
            ],
            [
                'id' => 4,
                'cover' => '/src/assets/images/book_covers/martin.jpg',
                'name' => 'A storm of swords by George R.R. Martin',
                'quantity' => 7,
            ],
            [
                'id' => 5,
                'cover' => '/src/assets/images/book_covers/potter.jpg',
                'name' => 'Harry Potter and the Prisoner of Azkaban by J.K. Rowling',
                'quantity' => 1,
            ],
            [
                'id' => 6,
                'cover' => '/src/assets/images/book_covers/roald.jpg',
                'name' => 'Roald Dahl Matilda by Quentin Blake',
                'quantity' => 5,
            ],
        ];

        foreach ($units as $unit) {
            Book::create($unit);
        }

        Schema::enableForeignKeyConstraints();
        Model::reguard();
    }
}
