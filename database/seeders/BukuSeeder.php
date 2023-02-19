<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bukus')->insert([
            [
                'pengarang_id' => 1,
                'penerbit_id' => 1,
                'status' => 1,
                'nama' => 'Laskar Pelangi',
                'genre' => 1,
                'tahun' => 2005,
                'sinopsis' => 'kehidupan 10 anak dari keluarga miskin yang bersekolah (SD dan SMP) di sebuah sekolah Muhammadiyah di Belitung yang penuh dengan keterbatasan.'
            ],
            [
                'pengarang_id' => 2,
                'penerbit_id' => 2,
                'status' => 1,
                'nama' => 'Hujan',
                'genre' => 1,
                'tahun' => 2016,
                'sinopsis' => 'Pada 2042, dunia telah memasuki era di mana peran manusia telah digantikan oleh ilmu pengeahuan dan teknologi canggih'
            ],
            [
                'pengarang_id' => 2,
                'penerbit_id' => 2,
                'status' => 1,
                'nama' => 'Bumi',
                'tahun' => 2014,
                'genre' => 1,
                'sinopsis' => 'petualangan 3 remaja yang berusia 15 tahun bernama Raib, Ali dan Seli. Namun mereka bukanlah remaja biasa, melainkan remaja yang memiliki kekuatan khusus seperti Raib yang bisa menghilang, Seli yang bisa mengeluarkan petir dan Ali seorang pelajar yang sangat jenius.'
            ],
            [
                'pengarang_id' => 4,
                'penerbit_id' => 3,
                'status' => 1,
                'nama' => 'Mariposa',
                'genre' => 2,
                'tahun' => 2018,
                'sinopsis' => 'Novel Mariposa mengisahkan seorang gadis cantik bernama Natasha Kay Loovi atau kerap disapa Acha yang memperjuangkan cintanya terhadap seorang laki-laki berhati beku dan super dingin–bagaikan es–dengan kehidupannya yang serba monoton, bernama Iqbal. Mereka berdua adalah siswa yang sangat pintar di sekolah.'
            ],
            [
                'pengarang_id' => 2,
                'penerbit_id' => 2,
                'status' => 1,
                'nama' => 'Bulan',
                'genre' => 1,
                'tahun' => 2015,
                'sinopsis' => 'Dalam novel Bulan petualangan antara Raib dan kedua kawannya masih berlanjut. Miss Selena akhirnya muncul di sekolah saat beberapa bulan setelah kejadian di klan Bulan. Miss Selena memberikan kabar menyenangkan bagi para murid yang mempunyai jiwa petualang, seperti Raib, Ali, dan Seli.'
            ],
            [
                'pengarang_id' => 6,
                'penerbit_id' => 4,
                'status' => 1,
                'nama' => 'Nanti Kita Cerita Tentang Hari Ini',
                'genre' => 3,
                'tahun' => 2018,
                'sinopsis' => 'Novel Nanti Kita Cerita Tentang Hari Ini, pembaca dapat menemukan banyak kutipan yang memotivasi dan menasihati, yang disertai ilustrasi gambar yang indah, yang dibuat sendiri oleh Marchella. Seluruh kutipan tersebut memberikan pesan yang bermakna, yang dapat menjadi pengingat tentang kehidupan.'
            ],
            [
                'pengarang_id' => 6,
                'penerbit_id' => 4,
                'status' => 1,
                'nama' => 'Kamu Terlalu Banyak Bercanda',
                'genre' => 3,
                'tahun' => 2019,
                'sinopsis' => 'Isi dalam surat berisikan tentang waktu yang ia alami saat dirinya tidak bisa untuk ikut tertawa, sebuah perasaan ketika Awan merasa sedang dijadikan bahan canda oleh hidup.'
            ],
            [
                'pengarang_id' => 5,
                'penerbit_id' => 2,
                'status' => 1,
                'nama' => 'Sebuah Seni Untuk Bersikap Bodoh Amat',
                'genre' => 3,
                'tahun' => 2016,
                'sinopsis' => 'Buku ini mengisahkan seorang pria bernama Charles Bukowski yang dulunya memiliki tabiat kasar, pecandu alkohol, suka bermain wanita, penjudi, dan tukang hutang. Meskipun begitu, dia mempunyai cita-cita menjadi seorang penulis.'
            ],
            [
                'pengarang_id' => 3,
                'penerbit_id' => 5,
                'status' => 1,
                'nama' => 'One Piece',
                'genre' => 2,
                'tahun' => 1997,
                'sinopsis' => 'Manga dan Anime yang menceritakan tentang petualangan sekelompok bajak laut dalam mencari harta karun legendaris, One Piece.'
            ],
        ]);
    }
}
