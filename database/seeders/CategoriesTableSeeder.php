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
            'primary' => true
        ]);

        Category::create([
            'name' => 'Reload',
            'slug' => Str::slug('Reload'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Fuel',
            'slug' => Str::slug('Fuel'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Parking',
            'slug' => Str::slug('Parking'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'Transaction Fees',
            'slug' => Str::slug('Transaction Fees'),
            'primary' => true
        ]);

        Category::create([
            'name' => 'General',
            'slug' => Str::slug('General'),
            'primary' => true
        ]);
    }
}
