<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestasi;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestasis = [
            [
                'title' => 'Juara 1 Olimpiade Matematika Nasional',
                'description' => 'Mewakili Jawa Barat dalam Olimpiade Matematika Nasional dan berhasil meraih juara pertama.',
                'image' => null,
                'category' => 'prestasi',
                'level' => 'nasional',
                'year' => '2024',
                'student_name' => 'Ahmad Rizki Pratama',
                'teacher_name' => 'Dr. Sari Indah, M.Pd',
                'achievement_details' => 'Mengalahkan 500+ peserta dari seluruh Indonesia dengan skor tertinggi 95/100.',
                'color' => 'blue',
                'icon' => 'fas fa-trophy',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Juara 2 Lomba Web Design Nasional',
                'description' => 'Berhasil meraih juara kedua dalam kompetisi web design tingkat nasional.',
                'image' => null,
                'category' => 'lomba',
                'level' => 'nasional',
                'year' => '2024',
                'student_name' => 'Sarah Putri Lestari',
                'teacher_name' => 'Budi Santoso, S.Kom',
                'achievement_details' => 'Membuat website e-commerce dengan teknologi terbaru dan UI/UX yang menarik.',
                'color' => 'green',
                'icon' => 'fas fa-laptop-code',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Juara 1 Futsal Putra Kabupaten',
                'description' => 'Tim futsal putra SMKN 4 Bogor berhasil menjadi juara pertama tingkat kabupaten.',
                'image' => null,
                'category' => 'prestasi',
                'level' => 'kabupaten',
                'year' => '2024',
                'student_name' => 'Tim Futsal SMKN 4',
                'teacher_name' => 'Agus Supriyadi, S.Pd',
                'achievement_details' => 'Mengalahkan 15 tim dari sekolah lain dengan skor 3-1 di final.',
                'color' => 'red',
                'icon' => 'fas fa-futbol',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Juara 3 Lomba Lukis Provinsi',
                'description' => 'Berhasil meraih juara ketiga dalam lomba lukis tingkat provinsi Jawa Barat.',
                'image' => null,
                'category' => 'lomba',
                'level' => 'provinsi',
                'year' => '2024',
                'student_name' => 'Dewi Sari Indah',
                'teacher_name' => 'Rina Wulandari, S.Sn',
                'achievement_details' => 'Lukisan bertema "Keindahan Alam Indonesia" dinilai sangat memukau juri.',
                'color' => 'purple',
                'icon' => 'fas fa-palette',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Juara 1 Karya Ilmiah Nasional',
                'description' => 'Berhasil meraih juara pertama dalam kompetisi karya ilmiah tingkat nasional.',
                'image' => null,
                'category' => 'kompetisi',
                'level' => 'nasional',
                'year' => '2024',
                'student_name' => 'Muhammad Fauzi',
                'teacher_name' => 'Dr. Ahmad Hidayat, M.Si',
                'achievement_details' => 'Penelitian tentang "Pemanfaatan Teknologi AI untuk Pendidikan" mendapat apresiasi tinggi.',
                'color' => 'yellow',
                'icon' => 'fas fa-microscope',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Juara 2 Robotik Nasional',
                'description' => 'Tim robotik SMKN 4 Bogor berhasil meraih juara kedua dalam kompetisi robotik nasional.',
                'image' => null,
                'category' => 'kompetisi',
                'level' => 'nasional',
                'year' => '2024',
                'student_name' => 'Tim Robotik SMKN 4',
                'teacher_name' => 'Eko Prasetyo, S.T',
                'achievement_details' => 'Robot dengan kemampuan navigasi otonom dan pemecahan masalah yang canggih.',
                'color' => 'orange',
                'icon' => 'fas fa-robot',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Penghargaan Best Student Award',
                'description' => 'Mendapat penghargaan sebagai siswa terbaik tahun 2024 dari Dinas Pendidikan.',
                'image' => null,
                'category' => 'penghargaan',
                'level' => 'kabupaten',
                'year' => '2024',
                'student_name' => 'Rizki Pratama',
                'teacher_name' => 'Dra. Siti Aminah, M.Pd',
                'achievement_details' => 'Penghargaan diberikan atas prestasi akademik dan non-akademik yang luar biasa.',
                'color' => 'gray',
                'icon' => 'fas fa-star',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Juara 1 Lomba Desain Grafis',
                'description' => 'Berhasil meraih juara pertama dalam lomba desain grafis tingkat regional.',
                'image' => null,
                'category' => 'lomba',
                'level' => 'provinsi',
                'year' => '2024',
                'student_name' => 'Indah Permata',
                'teacher_name' => 'Bambang Sutrisno, S.Sn',
                'achievement_details' => 'Desain poster kampanye lingkungan hidup yang sangat kreatif dan menarik.',
                'color' => 'blue',
                'icon' => 'fas fa-paint-brush',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($prestasis as $prestasi) {
            Prestasi::create($prestasi);
        }
    }
}