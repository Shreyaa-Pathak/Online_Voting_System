<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 1,
            'voterid' => 'admin', // default
            'voteridnumber'=>'1111',
            'dob' => now(),       // default
            'address' => 'admin_address',
            'phonenumber' => '0000000000',
            'status' => 1,
            // 'remember_token' => Str::random(10),

        ]);
    }
}
