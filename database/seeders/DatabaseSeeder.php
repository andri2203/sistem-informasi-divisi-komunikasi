<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([[
            'role' => 'Administrator',
        ], [
            'role' => 'Devisi',
        ], [
            'role' => 'User',
        ]]);

        DB::table('users')->insert([[
            'name' => 'Administrator',
            'username' => 'admin1234',
            'email' => 'admin1234@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'name' => 'Devisi Bataliyon 1',
            'username' => 'bataliyon1234',
            'email' => 'bataliyon1234@gmail.com',
            'password' => Hash::make('bataliyon1234'),
            'role' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'name' => 'User Dishub Kodam',
            'username' => 'user1234',
            'email' => 'user1234@gmail.com',
            'password' => Hash::make('user1234'),
            'role' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]]);

        DB::table('divitions')->insert([[
            'name' => 'Dishub Kodam IM',
            'role' => 3
        ], [
            'name' => 'Dev Bataliyon 1',
            'role' => 2
        ], [
            'name' => 'Dev Bataliyon 2-N',
            'role' => 2
        ]]);
    }
}
