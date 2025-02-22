<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Path ke file books.json
        $filePath = storage_path('app/books.json');

        // Baca file JSON
        $books = json_decode(file_get_contents($filePath), true);

        // Import data ke database
        foreach ($books as $book) {
            Book::create([
                'title' => $book['title'],
                'price' => $book['price'],
                'image_url' => 'http://books.toscrape.com/' . $book['image_url'],
                'book_url' => 'http://books.toscrape.com/catalogue/' . $book['book_url'],
            ]);
        }
    }
}