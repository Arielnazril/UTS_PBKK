<?php

namespace Database\Seeders;

use App\models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => (string) Str::ulid(),
            'name' => 'John Doe',
            'email' => 'arielnazril133@gmail.com',
            'password' => bcrypt('123123123'),
            'membership_date' => now()->toDateString(),
            'remember_token' => Str::random(10),
        ]);
    }
}
