<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('penerbits')->insert([
            [
                'nama' => 'PT. Bentang Pustaka',
                'alamat' => 'Jl. Pesanggrahan No.8 RT/RW : 04/36, Sanggrahan, Wedomartani, Kec. Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584',
            ],
            [
                'nama' => 'Gramedia Pustaka Utama (GPU)',
                'alamat' => 'Jl. Palmerah Barat 29-37 10270, RT.1/RW.2, Gelora, Tanah Abang, Central Jakarta City, Jakarta 10270',
            ],
            [
                'nama' => 'Coconut Books',
                'alamat' => 'Jakarta, Indonesia',
            ],
            [
                'nama' => 'POP Publishers',
                'alamat' => 'Jakarta, Indonesia',
            ],
            [
                'nama' => 'Shueisha',
                'alamat' => 'Jepang',
            ],
        ]);
    }
}
