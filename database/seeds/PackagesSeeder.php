<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesReset = DB::table('package_categories')->delete();
        $categories = DB::table('package_categories')->insert([
            ['name' => 'Specialist'],
            ['name' => 'GP & Resident']
        ]);

        $packagesReset = DB::table('packages')->delete();
        $packages = DB::table('packages')->insert([
            ['name' => 'Package 1', 'description' => 'Symposium', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Package 2', 'description' => '1 Workshop', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Package 3', 'description' => 'Symposium + 1 Workshop', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Package 4', 'description' => 'Symposium + 2 Workshop', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
