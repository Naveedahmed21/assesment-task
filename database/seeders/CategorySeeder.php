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
        Category::create([
            'name' => 'Category 1',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Category 2',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Category 3',
            'status' => 'active',
        ]);
    }
}
