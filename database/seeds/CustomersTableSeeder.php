<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'Deni Muhammad Aripin',
            'gender' => 'L',
            'phone_number' => '081919923132',
            'address' => 'Jelegong'
        ]);

        Customer::create([
            'name' => 'Acep Sutisna',
            'gender' => 'L',
            'phone_number' => '081919914322',
            'address' => 'Karawang'
        ]);

        Customer::create([
            'name' => 'Irma Mega',
            'gender' => 'P',
            'phone_number' => '0819199231212',
            'address' => 'Purwakarta'
        ]);

        Customer::create([
            'name' => 'Dede Blsot',
            'gender' => 'P',
            'phone_number' => '0819199644212',
            'address' => 'Babakan Gudang'
        ]);

        Customer::create([
            'name' => 'Tedi S',
            'gender' => 'L',
            'phone_number' => '08172731231234',
            'address' => 'Cianting'
        ]);

    }
}
