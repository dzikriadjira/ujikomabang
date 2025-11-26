<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        $beritas = [
            [
                'title' => 'SMKN 4 Bogor Raih Juara 1 Lomba IT Competition',
                'content' => 'SMKN 4 Bogor berhasil meraih juara 1 dalam Lomba IT Competition tingkat provinsi Jawa Barat. Kegiatan ini diikuti oleh lebih dari 50 sekolah se-Jawa Barat dan SMKN 4 Bogor berhasil unggul dengan project berbasis IoT yang inovatif. Para siswa menampilkan sistem monitoring keamanan sekolah berbasis sensor yang mendapat apresiasi dari juri.',
                'excerpt' => 'SMKN 4 Bogor berhasil meraih juara 1 dalam Lomba IT Competition tingkat provinsi Jawa Barat.',
                'image' => 'berita1.png',
                'author' => 'Admin SMKN 4',
                'published_at' => Carbon::now()->subDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'Kerjasama dengan Industri Teknologi untuk Magang Siswa',
                'content' => 'SMKN 4 Bogor menjalin kerjasama dengan beberapa perusahaan teknologi terkemuka untuk program magang siswa. Kerjasama ini bertujuan untuk meningkatkan kompetensi siswa dan mempersiapkan mereka untuk dunia kerja. Perusahaan yang bekerja sama antara lain PT. Teknologi Indonesia, CV. Digital Solution, dan beberapa startup lokal.',
                'excerpt' => 'SMKN 4 Bogor menjalin kerjasama dengan beberapa perusahaan teknologi terkemuka untuk program magang siswa.',
                'image' => 'berita2.png',
                'author' => 'Humas Sekolah',
                'published_at' => Carbon::now()->subDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'Pembangunan Lab Komputer Baru Selesai',
                'content' => 'Laboratorium komputer baru SMKN 4 Bogor telah selesai dibangun dan siap digunakan. Lab ini dilengkapi dengan 40 unit komputer spek tinggi, internet fiber optic, dan software pembelajaran terkini. Dengan adanya lab baru ini, diharapkan dapat meningkatkan kualitas pembelajaran praktikum siswa.',
                'excerpt' => 'Laboratorium komputer baru SMKN 4 Bogor telah selesai dibangun dan siap digunakan.',
                'image' => 'berita3.png',
                'author' => 'Admin SMKN 4',
                'published_at' => Carbon::now()->subDays(15),
                'is_active' => true,
            ],
            [
                'title' => 'Siswa SMKN 4 Bogor Lolos ke Tingkat Nasional',
                'content' => 'Dua orang siswa SMKN 4 Bogor berhasil lolos ke tingkat nasional dalam Olimpiade Sains Nasional bidang Komputer. Mereka akan mewakili provinsi Jawa Barat dalam kompetisi yang akan diadakan di Jakarta bulan depan. Selamat kepada para siswa atas prestasinya!',
                'excerpt' => 'Dua orang siswa SMKN 4 Bogor berhasil lolos ke tingkat nasional dalam Olimpiade Sains Nasional.',
                'image' => 'berita4.png',
                'author' => 'Kesiswaan',
                'published_at' => Carbon::now()->subDays(20),
                'is_active' => true,
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
