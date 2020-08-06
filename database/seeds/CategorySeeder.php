<?php

use App\CategoryLists;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
