<?php

use App\Models\Package;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registration_date')->truncate();
        DB::table('registration_date')->insert([
            'early_bird' => now()->format("Y-m-d"),
            'normal' => now()->addDays(14)->format("Y-m-d")
        ]);

        DB::table('prices')->truncate();
        DB::table('prices')->insert([
            ['priceable_type' => Package::class, 'priceable_id' => 1, 'category_id' => 1, 'early' => 2000000, 'normal' => 2500000],
            ['priceable_type' => Package::class, 'priceable_id' => 1, 'category_id' => 2, 'early' => 1500000, 'normal' => 2000000],
            ['priceable_type' => Package::class, 'priceable_id' => 2, 'category_id' => 1, 'early' => 1000000, 'normal' => 1500000],
            ['priceable_type' => Package::class, 'priceable_id' => 2, 'category_id' => 2, 'early' => 1000000, 'normal' => 1500000],
            ['priceable_type' => Package::class, 'priceable_id' => 3, 'category_id' => 1, 'early' => 2500000, 'normal' => 3250000],
            ['priceable_type' => Package::class, 'priceable_id' => 3, 'category_id' => 2, 'early' => 2000000, 'normal' => 2750000],
            ['priceable_type' => Package::class, 'priceable_id' => 4, 'category_id' => 1, 'early' => 3500000, 'normal' => 4250000],
            ['priceable_type' => Package::class, 'priceable_id' => 4, 'category_id' => 2, 'early' => 3000000, 'normal' => 3750000],
        ]);
    }
}
