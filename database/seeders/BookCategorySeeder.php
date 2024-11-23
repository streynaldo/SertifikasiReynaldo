<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'book_id' => 1,
                'category_id' => 1,
            ],
            [
                'book_id' => 1,
                'category_id' => 7,
            ],
            [
                'book_id' => 2,
                'category_id' => 1,
            ],
            [
                'book_id' => 2,
                'category_id' => 3,
            ],
            [
                'book_id' => 3,
                'category_id' => 1,
            ],
            [
                'book_id' => 3,
                'category_id' => 5,
            ],
            [
                'book_id' => 4,
                'category_id' => 1,
            ],
            [
                'book_id' => 4,
                'category_id' => 7,
            ],
        ];

        foreach ($data as $item) {
            FacadesDB::table('book_category')->insert($item);
        }
    }
}
