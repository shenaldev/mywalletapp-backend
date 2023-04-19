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
            'name' => 'Food',
            'slug' => Str::slug('Food'),
        ]);

        Category::create([
            'name' => 'Reload',
            'slug' => Str::slug('Reload'),
        ]);

        Category::create([
            'name' => 'Fuel',
            'slug' => Str::slug('Fuel'),
        ]);

        Category::create([
            'name' => 'Parking',
            'slug' => Str::slug('Parking'),
        ]);

        Category::create([
            'name' => 'Transaction Fees',
            'slug' => Str::slug('Transaction Fees'),
        ]);

        Category::create([
            'name' => 'General',
            'slug' => Str::slug('General'),
        ]);

    }
}
