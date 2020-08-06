<?php

use App\AcademicYearList;
use App\CategoryLists;
use App\DesignationLists;
use App\ExamTypeList;
use App\ReligionLists;
use App\SchoolInfos;
use App\User;
use Illuminate\Database\Seeder;

class CompleteDatabaseSeeder extends Seeder
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
        SchoolInfos::create([
            'schoolname' => config('app.name'),
            'website' => config('app.url'),
        ]);
        for($i=1980;$i<=2021;$i++)
        {
            AcademicYearList::create([
                'academicyear' => $i.'-'.($i+1),
            ]);
        }
        CategoryLists::insert([
            ['category' => 'OPEN'],
            ['category' => 'OBC'],
            ['category' => 'SBC'],
            ['category' => 'SC'],
            ['category' => 'ST'],
            ['category' => 'VJNT'],
            ['category' => 'NT B'],
            ['category' => 'NT C'],
            ['category' => 'NT D'],
            ['category' => 'NA'],
        ]);
        ReligionLists::insert([
            ['religion' => 'HINDU'],
            ['religion' => 'MUSALMAN'],
            ['religion' => 'MUSLIM'],
            ['religion' => 'ISLAM'],
            ['religion' => 'NA'],
        ]);
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
        ExamTypeList::insert([
            ['examtype' => 'Semester 1'],
            ['examtype' => 'Semester 2'],
        ]);
    }
}
