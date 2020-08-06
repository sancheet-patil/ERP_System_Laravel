<?php

use App\ReligionLists;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReligionLists::insert([
            ['religion' => 'HINDU'],
            ['religion' => 'MUSALMAN'],
            ['religion' => 'MUSLIM'],
            ['religion' => 'ISLAM'],
            ['religion' => 'NA'],
        ]);
    }
}
