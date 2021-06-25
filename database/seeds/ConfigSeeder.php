<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configKey = [
            'name', 'description', 'location', 'schedule', 'early', 'normal'
        ];

        DB::table('config')->truncate();
        DB::table('config')->insert(
            collect($configKey)->map(fn ($key) => ['key' => $key])->toArray()
        );
    }
}
