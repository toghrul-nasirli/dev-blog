<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        Tag::truncate();

        Tag::create(['name' => 'html']);
        Tag::create(['name' => 'css']);
        Tag::create(['name' => 'js']);
        Tag::create(['name' => 'php']);
        Tag::create(['name' => 'laravel']);
        Tag::create(['name' => 'vue']);
        Tag::create(['name' => 'react']);
        Tag::create(['name' => 'angular']);
        Tag::create(['name' => 'gridsome']);
        Tag::create(['name' => 'c']);
        Tag::create(['name' => 'c++']);
        Tag::create(['name' => 'c#']);
        Tag::create(['name' => 'asp-net']);
        Tag::create(['name' => 'python']);
        Tag::create(['name' => 'assembly']);
        Tag::create(['name' => 'node']);
        Tag::create(['name' => 'npm']);
    }
}
