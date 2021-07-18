<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Makanan',
            'slug' => 'makanan'
        ]);
        Category::create([
            'name' => 'Minuman',
            'slug' => 'minuman'
        ]);
    }
}
