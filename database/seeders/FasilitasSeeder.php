<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            [
                'name' => 'Laboratorium Komputer',
                'description' => 'Laboratorium komputer modern dengan peralatan terbaru untuk pembelajaran PPLG dan TKJ.',
                'color' => 'blue',
                'features' => ['40 Unit Komputer Terbaru', 'Software Development Tools', 'Internet High Speed', 'AC & Proyektor'],
                'icon' => 'fas fa-desktop',
                'category' => 'pplg',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Bengkel Otomotif',
                'description' => 'Bengkel otomotif lengkap dengan peralatan modern untuk praktik siswa Teknik Otomotif.',
                'color' => 'red',
                'features' => ['Lift Hidrolik', 'Alat Ukur Presisi', 'Mesin Latihan', 'Tool Set Lengkap'],
                'icon' => 'fas fa-wrench',
                'category' => 'otomotif',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Workshop Pemesinan',
                'description' => 'Workshop pemesinan dengan mesin CNC dan peralatan manufaktur modern.',
                'color' => 'gray',
                'features' => ['Mesin Bubut CNC', 'Mesin Frais', 'Alat Ukur Presisi', 'Safety Equipment'],
                'icon' => 'fas fa-cogs',
                'category' => 'pemesinan',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Perpustakaan Digital',
                'description' => 'Perpustakaan modern dengan koleksi buku digital dan ruang baca yang nyaman.',
                'color' => 'green',
                'features' => ['10,000+ Buku Digital', 'E-Journal & E-Book', 'WiFi Gratis', 'Ruang Baca Nyaman'],
                'icon' => 'fas fa-book',
                'category' => 'general',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Laboratorium Bahasa',
                'description' => 'Laboratorium bahasa dengan peralatan audio modern untuk pembelajaran bahasa asing.',
                'color' => 'purple',
                'features' => ['Headset & Microphone', 'Software Pembelajaran', 'Native Speaker', 'TOEFL Preparation'],
                'icon' => 'fas fa-language',
                'category' => 'general',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Lapangan Olahraga',
                'description' => 'Lapangan olahraga lengkap dengan fasilitas futsal dan basket.',
                'color' => 'orange',
                'features' => ['Lapangan Futsal', 'Lapangan Basket', 'Locker Room', 'Peralatan Olahraga'],
                'icon' => 'fas fa-futbol',
                'category' => 'general',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($fasilitas as $fasilitasItem) {
            Fasilitas::create($fasilitasItem);
        }
    }
}
