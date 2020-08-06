<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'userid' => date('ymdHis'),
            'name' => 'Admin',
            'aadhar' => '1122334455',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'hasaccess' => '1',
        ]);
    }
}
