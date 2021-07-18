<?php

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'barcode' => 'MK001',
            'name' => 'Mi sedap Ayam Bawang',
            'slug' => 'mi-sedap-ayam-bawang',
            'category_id' => 1,
            'unit_id' => 5,
            'price' => 25000
        ]);

        Item::create([
            'barcode' => 'MK002',
            'name' => 'Sukro',
            'slug' => 'sukro',
            'category_id' => 1,
            'unit_id' => 2,
            'price' => 5000
        ]);

        Item::create([
            'barcode' => 'MN001',
            'name' => 'Teh Pucuk',
            'slug' => 'teh-pucuk',
            'category_id' => 2,
            'unit_id' => 4,
            'price' => 4000
        ]);

        Item::create([
            'barcode' => 'MN002',
            'name' => 'Fanta',
            'slug' => 'fanta',
            'category_id' => 2,
            'unit_id' => 4,
            'price' => 5000
        ]);

        Item::create([
            'barcode' => 'MN003',
            'name' => 'Sprite',
            'slug' => 'sprite',
            'category_id' => 2,
            'unit_id' => 4,
            'price' => 5000
        ]);
    }
}
