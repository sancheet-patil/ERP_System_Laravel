<?php

use App\DesignationLists;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DesignationLists::insert([
            ['designation' => 'SUPERVISER'],
            ['designation' => 'PRINCIPAL'],
            ['designation' => 'JR. CLERK'],
            ['designation' => 'PEON'],
            ['designation' => 'NAIK'],
            ['designation' => 'SR. CLERK'],
            ['designation' => 'TEACHER'],
            ['designation' => 'LIBRARIAN'],
            ['designation' => 'NA'],
        ]);
    }
}
