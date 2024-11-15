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
        User::factory()->create([
                'username' => 'username',
                'email' => 'email@example.com',
                'password' => 'password',
            ]);
        User::factory()->count(15)->create();
    }
}
