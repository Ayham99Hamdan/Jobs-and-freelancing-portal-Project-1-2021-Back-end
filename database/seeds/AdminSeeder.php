<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Admin::create([
            'first_name' => 'ayham',
            'last_name' => 'hamdan',
            'email' => 'ayham@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $super_admin->assignRole('super-admin');
    }
}
