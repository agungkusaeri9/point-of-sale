<?php

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'Kilogram',
            'slug' => 'kilogram'
        ]);
        Unit::create([
            'name' => 'Bungkus',
            'slug' => 'bungkus'
        ]);
        Unit::create([
            'name' => 'Botol',
            'slug' => 'botol'
        ]);
        Unit::create([
            'name' => 'Buah',
            'slug' => 'buah'
        ]);
        Unit::create([
            'name' => 'Kardus',
            'slug' => 'kardus'
        ]);
    }
}
