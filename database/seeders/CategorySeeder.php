<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kegiatan Sekolah',
                'slug' => 'kegiatan-sekolah',
                'description' => 'Berbagai kegiatan yang dilakukan di sekolah',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Ekstrakurikuler',
                'slug' => 'ekstrakurikuler',
                'description' => 'Kegiatan ekstrakurikuler siswa',
                'color' => '#10B981',
            ],
            [
                'name' => 'Acara Khusus',
                'slug' => 'acara-khusus',
                'description' => 'Acara-acara khusus dan perayaan',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Prestasi Siswa',
                'slug' => 'prestasi-siswa',
                'description' => 'Prestasi dan pencapaian siswa',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Fasilitas Sekolah',
                'slug' => 'fasilitas-sekolah',
                'description' => 'Fasilitas dan infrastruktur sekolah',
                'color' => '#8B5CF6',
            ],
            [
                'name' => 'Kunjungan',
                'slug' => 'kunjungan',
                'description' => 'Kunjungan dan kerjasama dengan pihak lain',
                'color' => '#06B6D4',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
