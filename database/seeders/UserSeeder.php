<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 1,
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'role' => 2,
                'password' => Hash::make('user'),
            ],
        ]);

    }
}
