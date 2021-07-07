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
                'email_verified_at' => now(),
                'password' => '$2y$10$hxZzoTrUSgSEQMITk0AOOu9VALtWApCXM1ib27ZAs/AeXzYFzApOm',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $su->assignRole('superadmin');

        $admin = User::updateOrCreate(
            ['username' => 'admin', 'email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'email_verified_at' => now(),
                'password' => '$2y$10$cdUDR8LZ9NQ3GCvIPnGAJeezSKt1sitzH0LiRh.DUcX8bkGeGqga.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $admin->assignRole('admin');
    }
}
