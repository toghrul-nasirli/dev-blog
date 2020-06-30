<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::truncate();

        Category::create(['name' => 'General Programming']);
        Category::create(['name' => 'Web Development']);
        Category::create(['name' => 'Web Design']);
        Category::create(['name' => 'Web Frameworks']);
        Category::create(['name' => 'Data Analytics']);
        Category::create(['name' => 'Machine Learning']);
    }
}
