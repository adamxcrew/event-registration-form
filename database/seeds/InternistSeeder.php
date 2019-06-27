<?php

use Illuminate\Database\Seeder;

class InternistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert(['id' => 8, 'name' => 'Internist']);
        DB::table('event_level')->insert([
            ['event_id' => 1, 'level_id' => 8],
            ['event_id' => 4, 'level_id' => 8],
            ['event_id' => 5, 'level_id' => 8],
        ]);
    }
}
