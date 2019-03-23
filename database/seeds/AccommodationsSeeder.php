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
        DB::table('room_types')->delete();
        DB::table('accommodations')->delete();
        DB::table('accommodations')->insert([
            ['hotel' => 'Claro Hotal', 'rate' => '4', 'address' => 'Jl. A. P. Pettarani No.03, Mannuruki, Tamalate, Kota Makassar, Sulawesi Selatan 90221'],
            ['hotel' => 'Four Points by Sheraton', 'rate' => '4', 'address' => 'Jl. Andi Djemma No.130, Banta-Bantaeng, Rappocini, Kota Makassar, Sulawesi Selatan 90222'],
            ['hotel' => 'Remcy Hotel', 'rate' => '3', 'address' => 'Jl. Boulevard Blok F5 No.9, Masale, Panakkukang, Kota Makassar, Sulawesi Selatan 90231'],
            ['hotel' => 'Grand Asia', 'rate' => '3', 'address' => 'Jl. Boulevard 10, Panakkukang, Makassar, Indonesia, 90231'],
            ['hotel' => 'Ramedo Hotel', 'rate' => '3', 'address' => 'Jl. Andi Djemma No.112, Banta-Bantaeng, Rappocini, Kota Makassar, Sulawesi Selatan 90222'],
            ['hotel' => 'Lariss Guest House', 'rate' => '2', 'address' => 'Jl. Bontolangkasa I No.42, Banta-Bantaeng, Rappocini, Kota Makassar, Sulawesi Selatan 90222'],
        ]);

        $accommodations = DB::table('accommodations')->get();
        foreach ($accommodations as $accommodation) {
            DB::table('room_types')->insert([
                ['accommodation_id' => $accommodation->id, 'type' => 'Superior', 'price' => '875000'],
                ['accommodation_id' => $accommodation->id, 'type' => 'JUnior Suite', 'price' => '1300000'],
                ['accommodation_id' => $accommodation->id, 'type' => 'Suite', 'price' => '2350000']
            ]);
        }



    }
}
