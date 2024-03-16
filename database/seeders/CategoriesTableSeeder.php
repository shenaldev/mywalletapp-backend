<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => 'Dining',
            'slug' => Str::slug('Dining'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Fuel',
            'slug' => Str::slug('Fuel'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Transport',
            'slug' => Str::slug('Transport'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Utilities',
            'slug' => Str::slug('Utilities'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Groceries',
            'slug' => Str::slug('Groceries'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Health',
            'slug' => Str::slug('Health'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'General',
            'slug' => Str::slug('General'),
            'primary' => true
        ]);
    }
}
