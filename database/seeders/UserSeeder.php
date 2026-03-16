<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Artem Tyan',
            'email' => 'artem.tyan01@mail.ru',
            'password' => Hash::make('06052012Zx'),
            'role' => 'moderator',
        ]);
    }
}