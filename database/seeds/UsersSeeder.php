<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $su = User::updateOrCreate(
            ['username' => 'caesarali', 'email' => 'caesaralilamondo@gmail.com'],
            [
                'name' => 'Caesar Ali L.',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('caesarali'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        $su->assignRole('superadmin');

        $su = User::updateOrCreate(
            ['username' => 'admin', 'email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator.',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('admin'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        $su->assignRole('superadmin');
    }
}
