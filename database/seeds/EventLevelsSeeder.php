<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->delete();
        DB::table('levels')->insert([
            ['id' => 1, 'name' => 'Radiologist'],
            ['id' => 2, 'name' => 'Radiology Resident'],
            ['id' => 3, 'name' => 'Pulmonologis'],
            ['id' => 4, 'name' => 'Pathologis'],
            ['id' => 5, 'name' => 'GP'],
            ['id' => 6, 'name' => 'Resident'],
            ['id' => 7, 'name' => 'Senior Medical Student'],
        ]);

        $eventLevels = [
            [1,2,3,4,5,6,7],
            [1,2],
            [1,2],
            [1,3,4,6],
            [1,3,4,6],
            [5,6,7]
        ];

        $events = Event::orderBy('id', 'asc')->get();
        foreach ($events as $key => $event) {
            $event->levels()->attach($eventLevels[$key]);
        }
    }
}
