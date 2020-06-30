<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        Post::truncate();
        DB::table('post_tag')->truncate();
        
        $html = Tag::where('name', 'html')->first();
        $css = Tag::where('name', 'css')->first();
        $js = Tag::where('name', 'js')->first();
        $vue = Tag::where('name', 'vue')->first();
        $php = Tag::where('name', 'php')->first();
        $laravel = Tag::where('name', 'laravel')->first();
        $c = Tag::where('name', 'c')->first();
        $cpp = Tag::where('name', 'c++')->first();
        $react = Tag::where('name', 'react')->first();

        $post1 = Post::create([
            'title' => 'Laravel Basics',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas justo nulla, consectetur eget lacus sed, vehicula facilisis lorem. Sed eget nisl rutrum, facilisis mi non, posuere eros.',
            'slug' => 'laravel-basics',
            'image' => 'images/laravel.jpg',
            'is_approved' => true,
            'user_id' => '2',
            'category_id' => '1',
        ]);
        $post2 = Post::create([
            'title' => 'Modern JavaScript(ES6+)',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas justo nulla, consectetur eget lacus sed, vehicula facilisis lorem. Sed eget nisl rutrum, facilisis mi non, posuere eros.',
            'slug' => 'modern-javascript(es6+)',
            'image' => 'images/js.jpg',
            'is_approved' => true,
            'user_id' => '3',
            'category_id' => '2',
        ]);
        $post3 = Post::create([
            'title' => 'OOP Principles',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas justo nulla, consectetur eget lacus sed, vehicula facilisis lorem. Sed eget nisl rutrum, facilisis mi non, posuere eros.',
            'slug' => 'oop-principles',
            'is_approved' => true,
            'user_id' => '4',
            'category_id' => '2',
        ]);
        $post4 = Post::create([
            'title' => 'Vue.js Advanced',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas justo nulla, consectetur eget lacus sed, vehicula facilisis lorem. Sed eget nisl rutrum, facilisis mi non, posuere eros.',
            'slug' => 'vue.js-advanced',
            'image' => 'images/vue.png',
            'is_approved' => true,
            'user_id' => '5',
            'category_id' => '4',
        ]);
        $post5 = Post::create([
            'title' => 'React Advanced',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas justo nulla, consectetur eget lacus sed, vehicula facilisis lorem. Sed eget nisl rutrum, facilisis mi non, posuere eros.',
            'slug' => 'react-advanced',
            'image' => 'images/react.jpg',
            'is_approved' => true,
            'user_id' => '6',
            'category_id' => '5',
        ]);

        $post1->tags()->attach($html);
        $post1->tags()->attach($css);
        $post1->tags()->attach($php);
        $post1->tags()->attach($laravel);
        
        $post2->tags()->attach($js);
        
        $post3->tags()->attach($c);
        $post3->tags()->attach($cpp);
        
        $post4->tags()->attach($html);
        $post4->tags()->attach($css);
        $post4->tags()->attach($js);
        $post4->tags()->attach($vue);
        
        $post5->tags()->attach($html);
        $post5->tags()->attach($css);
        $post5->tags()->attach($js);
        $post5->tags()->attach($react);
    }
}
