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
        $typesReset = DB::table('event_types')->delete();
        $types = DB::table('event_types')->insert([
            ['name' => 'Symposium'],
            ['name' => 'Workshop']
        ]);

        $symposium = DB::table('event_types')->where('name', 'Symposium')->first();
        $workshop = DB::table('event_types')->where('name', 'Workshop')->first();

        $eventReset = DB::table('events')->delete();
        $event = DB::table('events')->insert([
            ['name' => 'Symposium','type_id' => $symposium->id],
            ['name' => 'Cardiac CT Scan','type_id' => $workshop->id],
            ['name' => 'Thoracic USG (Lung & Heart)','type_id' => $workshop->id],
            ['name' => 'Lung Cancer Imaging','type_id' => $workshop->id],
            ['name' => 'Interstitial Lung Disease Imaging','type_id' => $workshop->id],
            ['name' => 'Basic TB Imaging','type_id' => $workshop->id],
        ]);


    }
}
