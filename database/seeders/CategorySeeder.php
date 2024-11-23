<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Fiction',
            ],
            [
                'id' => 2,
                'name' => 'Non-Fiction',
            ],
            [
                'id' => 3,
                'name' => 'Science Fiction',
            ],
            [
                'id' => 4,
                'name' => 'Fantasy',
            ],
            [
                'id' => 5,
                'name' => 'Mystery',
            ],
            [
                'id' => 6,
                'name' => 'Horror',
            ],
            [
                'id' => 7,
                'name' => 'Romance',
            ],
            [
                'id' => 8,
                'name' => 'Biography',
            ],
            [
                'id' => 9,
                'name' => 'Autobiography',
            ],
            [
                'id' => 10,
                'name' => 'Self-Help',
            ],
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }
}
