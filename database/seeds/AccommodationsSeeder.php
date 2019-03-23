<?php

use Illuminate\Database\Seeder;

class AccommodationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accommodations')->delete();
        DB::table('accommodations')->insert([
            ['hotel' => 'Claro Hotal', 'rate' => 'Superior', 'price' => '875000'],
            ['hotel' => 'Claro Hotal', 'rate' => 'JUnior Suite', 'price' => '1300000'],
            ['hotel' => 'Claro Hotal', 'rate' => 'Suite', 'price' => '2350000']
        ]);
    }
}
