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
        $categoriesReset = DB::table('categories')->delete();
        $categories = DB::table('categories')->insert([
            ['name' => 'Specialist'],
            ['name' => 'GP & Resident']
        ]);

        $packagesReset = DB::table('packages')->delete();
        $packages = DB::table('packages')->insert([
            ['name' => 'Package 1', 'description' => 'Symposium', 'min' => 1, 'max' => 1],
            ['name' => 'Package 2', 'description' => '1 Workshop', 'min' => 1, 'max' => 1],
            ['name' => 'Package 3', 'description' => 'Symposium + 1 Workshop', 'min' => 1, 'max' => 2],
            ['name' => 'Package 4', 'description' => 'Symposium + 2 Workshop', 'min' => 1, 'max' => 3],
        ]);
    }
}
