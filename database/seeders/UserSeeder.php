<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'kyle',
            'email' => 'kyle@test.com',
            'password' => Hash::make(12345678),
        ]);

        User::create([
            'name' => 'fdc',
            'email' => 'fdc@test.com',
            'password' => Hash::make(12345678),
        ]);
    }
}
