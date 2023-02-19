<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pengarangs')->insert([
            [
                'nama' => 'Andrea Hirata',
                'jenis_kelamin' => 1,
                'negara' => 'Indonesia',
            ],
            [
                'nama' => 'Tere Liye',
                'jenis_kelamin' => 1,
                'negara' => 'Indonesia',
            ],
            [
                'nama' => 'Eiichiro Oda',
                'jenis_kelamin' => 1,
                'negara' => 'Jepang',
            ],
            [
                'nama' => 'Hidayatul Fajriyah',
                'jenis_kelamin' => 2,
                'negara' => 'Indonesia',
            ],
            [
                'nama' => 'Mark Manson',
                'jenis_kelamin' => 1,
                'negara' => 'Amerika',
            ],
            [
                'nama' => 'Marchella FP',
                'jenis_kelamin' => 2,
                'negara' => 'Indonesia',
            ],
        ]);
    }
}
