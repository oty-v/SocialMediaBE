<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user){
            Post::all()->each(function ($post) use ($user){
                Comment::factory()->count(1)->for($post)->for($user)->create();
            });
        });
    }
}
