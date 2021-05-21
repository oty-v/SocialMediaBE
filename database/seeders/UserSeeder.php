<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->hasPosts(1)
            ->hasComments(1)
            ->create([
                'username' => 'username',
                'email' => 'email@example.com',
                'password' => bcrypt('password'),
            ]);
    }
}
