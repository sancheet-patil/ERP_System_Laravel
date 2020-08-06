<?php

use App\ExamTypeList;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExamTypeList::insert([
            ['examtype' => 'Semester 1'],
            ['examtype' => 'Semester 2'],
        ]);
    }
}
