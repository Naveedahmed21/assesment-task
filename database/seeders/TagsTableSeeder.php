<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Technology', 'Food', 'Travel', 'Fashion', 'Sports', 'Music', 'Art', 'Books'];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
            ]);
        }
    }
}
