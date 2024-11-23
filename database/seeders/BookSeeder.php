<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'The Great Gatsby',
                'description' => 'A novel about the American dream.',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Scribner',
                'release_date' => '1925-04-10',
                'cover_photo' => 'great_gatsby.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => '1984',
                'description' => 'A dystopian novel about totalitarianism.',
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'release_date' => '1949-06-08',
                'cover_photo' => '1984.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'description' => 'A novel about racial injustice.',
                'author' => 'Harper Lee',
                'publisher' => 'J.B. Lippincott & Co.',
                'release_date' => '1960-07-11',
                'cover_photo' => 'to_kill_a_mockingbird.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'Pride and Prejudice',
                'description' => 'A classic romantic novel.',
                'author' => 'Jane Austen',
                'publisher' => 'T. Egerton',
                'release_date' => '1813-01-28',
                'cover_photo' => 'pride_and_prejudice.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'Moby-Dick',
                'description' => 'A story of a giant white whale and a vengeful captain.',
                'author' => 'Herman Melville',
                'publisher' => 'Harper & Brothers',
                'release_date' => '1851-11-14',
                'cover_photo' => 'moby_dick.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'War and Peace',
                'description' => 'An epic tale of war and society in Russia.',
                'author' => 'Leo Tolstoy',
                'publisher' => 'The Russian Messenger',
                'release_date' => '1869-01-01',
                'cover_photo' => 'war_and_peace.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'description' => 'A story of teenage rebellion and angst.',
                'author' => 'J.D. Salinger',
                'publisher' => 'Little, Brown and Company',
                'release_date' => '1951-07-16',
                'cover_photo' => 'catcher_in_the_rye.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'The Hobbit',
                'description' => 'A fantasy adventure of Bilbo Baggins.',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'George Allen & Unwin',
                'release_date' => '1937-09-21',
                'cover_photo' => 'the_hobbit.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'The Lord of the Rings',
                'description' => 'A trilogy about the quest to destroy the One Ring.',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'George Allen & Unwin',
                'release_date' => '1954-07-29',
                'cover_photo' => 'lotr.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
            [
                'title' => 'The Alchemist',
                'description' => 'A journey of self-discovery and following dreams.',
                'author' => 'Paulo Coelho',
                'publisher' => 'HarperCollins',
                'release_date' => '1988-01-01',
                'cover_photo' => 'the_alchemist.jpg',
                'borrow_date' => null,
                'user_id' => null,
            ],
        ];

        foreach ($data as $book) {
            Book::create($book);
        }
    }
}
