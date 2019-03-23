<?php

use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventReset = DB::table('events')->delete();
        $event = DB::table('events')->insert([
            ['name' => 'Symposium', 'category' => 'symposium'],
            ['name' => 'Cardiac CT Scan', 'category' => 'workshop'],
            ['name' => 'Thoracic USG (Lung & Heart)', 'category' => 'workshop'],
            ['name' => 'Lung Cancer Imaging', 'category' => 'workshop'],
            ['name' => 'Interstitial Lung Disease Imaging', 'category' => 'workshop'],
            ['name' => 'Basic TB Imaging', 'category' => 'workshop'],
        ]);


    }
}
