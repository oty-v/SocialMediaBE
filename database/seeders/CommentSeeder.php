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
        $user = User::all();
        Post::all()->each(function ($post) use ($user) {
            $post->comments()->saveMany(
                Comment::factory()->count(3)->for($post)->for($user->random())->create()
            );
        });
    }
}
