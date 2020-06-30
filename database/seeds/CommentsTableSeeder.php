<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        Comment::truncate();

        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '3',
            'post_id' => '1',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '3',
            'post_id' => '3',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '3',
            'post_id' => '5',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '4',
            'post_id' => '2',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '5',
            'post_id' => '1',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '5',
            'post_id' => '5',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '6',
            'post_id' => '4',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '6',
            'post_id' => '2',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '2',
            'post_id' => '5',
        ]);
        Comment::create([
            'body' => 'Lorem ipsum dolor sit amet',
            'is_approved' => true,
            'user_id' => '2',
            'post_id' => '2',
        ]);
    }
}
