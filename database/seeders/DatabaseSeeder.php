<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'username',
            'email' => 'email@example.com',
            'password' => Hash::make('password'),
        ]);
        User::factory()->count(3)
            ->has(Post::factory()->count(3))
            ->create();
    }
}
