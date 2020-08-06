<?php

use App\SchoolInfos;
use Illuminate\Database\Seeder;

class SchoolInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolInfos::create([
            'schoolname' => config('app.name'),
            'website' => config('app.url'),
        ]);
    }
}
