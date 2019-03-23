<?php

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
        $dateReset = DB::table('registration_date')->delete();
        $date = DB::table('registration_date')->insert([
            'early_bird' => Carbon::createFromDate(2019, 7, 31)->format("Y-m-d"),
            'normal' => Carbon::createFromDate(2019, 8, 1)->format("Y-m-d")
        ]);

        $feeReset = DB::table('registration_fee')->delete();
        $fee = DB::table('registration_fee')->insert([
            ['package_id' => 1, 'category_id' => 1, 'early_fee' => 2000000, 'normal_fee' => 2500000],
            ['package_id' => 1, 'category_id' => 2, 'early_fee' => 1500000, 'normal_fee' => 2000000],
            ['package_id' => 2, 'category_id' => 1, 'early_fee' => 1000000, 'normal_fee' => 1500000],
            ['package_id' => 2, 'category_id' => 2, 'early_fee' => 1000000, 'normal_fee' => 1500000],
            ['package_id' => 3, 'category_id' => 1, 'early_fee' => 2500000, 'normal_fee' => 3250000],
            ['package_id' => 3, 'category_id' => 2, 'early_fee' => 2000000, 'normal_fee' => 2750000],
            ['package_id' => 4, 'category_id' => 1, 'early_fee' => 3500000, 'normal_fee' => 4250000],
            ['package_id' => 4, 'category_id' => 2, 'early_fee' => 3000000, 'normal_fee' => 3750000],
        ]);
    }
}
