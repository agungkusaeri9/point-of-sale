<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class KasirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kasir = User::create([
            'name' => 'kasir',
            'username' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('kasir'),
            'email_verified_at' => now(),
            'address' => 'Karawang'
        ]);

        $kasir->assignRole('kasir');
    }
}
