<?php

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'name' => 'Toko A',
            'phone_number' => '081919923123',
            'address' => 'Purwakarta',
            'description' => 'Toko Bah Jampang'
        ]);

        Supplier::create([
            'name' => 'Toko B',
            'phone_number' => '08191992523',
            'address' => 'Karawang',
            'description' => 'Toko Bu Sity'
        ]);

        Supplier::create([
            'name' => 'Toko C',
            'phone_number' => '08191992656',
            'address' => 'Padalarang',
            'description' => 'Toko Mbah Oya'
        ]);

        Supplier::create([
            'name' => 'Toko D',
            'phone_number' => '081919927673',
            'address' => 'Subang',
            'description' => 'Toko Bi Ayi'
        ]);

        Supplier::create([
            'name' => 'Toko E',
            'phone_number' => '081919923623',
            'address' => 'Purwakarta',
            'description' => 'Toko Bu Rini'
        ]);
    }
}
