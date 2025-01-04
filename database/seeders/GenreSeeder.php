<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Action'],
            ['name' => 'Adventure'],
            ['name' => 'Animation'],
            ['name' => 'Biography'],
            ['name' => 'Comedy'],
            ['name' => 'Crime'],
            ['name' => 'Documentary'],
            ['name' => 'Drama'],
            ['name' => 'Family'],
            ['name' => 'Fantasy'],
            ['name' => 'Film Noir'],
            ['name' => 'History'],
            ['name' => 'Horror'],
            ['name' => 'Music'],
            ['name' => 'Musical'],
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Short Film'],
            ['name' => 'Sport'],
            ['name' => 'Superhero'],
            ['name' => 'Thriller'],
            ['name' => 'War'],
            ['name' => 'Western'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
