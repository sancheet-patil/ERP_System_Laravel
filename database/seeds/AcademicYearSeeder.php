<?php

use App\AcademicYearList;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1980;$i<=2021;$i++)
        {
            AcademicYearList::create([
                'academicyear' => $i.'-'.($i+1),
            ]);
        }
    }
}
