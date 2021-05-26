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
        $users = User::all();
        Post::all()->each(function ($post) use ($users) {
            $comments = [];
            for ($i = 0; $i < 5; $i++) {
                $comment = Comment::factory()->for($post)->for($users->random())->make();
                array_push($comments, $comment);
            }
            $post->comments()->saveMany($comments);
        });
    }
}
