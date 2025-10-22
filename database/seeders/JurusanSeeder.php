<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'name' => 'PPLG',
                'full_name' => 'Pengembangan Perangkat Lunak & Gim',
                'description' => 'Mempelajari pengembangan aplikasi web, mobile, dan game dengan teknologi terkini.',
                'color' => 'blue',
                'competencies' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'Python', 'UI/UX Design'],
                'careers' => ['Web Developer', 'Game Developer', 'Mobile App Developer'],
                'icon' => 'fas fa-code',
                'is_featured' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'TKJ',
                'full_name' => 'Teknik Komputer dan Jaringan',
                'description' => 'Fokus pada instalasi, konfigurasi, dan pemeliharaan perangkat keras serta jaringan komputer.',
                'color' => 'blue',
                'competencies' => ['Networking', 'Cisco', 'Mikrotik', 'Server', 'Linux'],
                'careers' => ['Network Administrator', 'IT Support', 'System Administrator'],
                'icon' => 'fas fa-network-wired',
                'is_featured' => false,
                'sort_order' => 2
            ],
            [
                'name' => 'Teknik Otomotif',
                'full_name' => 'Teknik Kendaraan Ringan',
                'description' => 'Mempelajari sistem mesin, kelistrikan, dan transmisi pada kendaraan bermotor.',
                'color' => 'red',
                'competencies' => ['Engine Repair', 'Electrical System', 'Transmission', 'Brake System'],
                'careers' => ['Automotive Technician', 'Service Advisor', 'Mechanic'],
                'icon' => 'fas fa-car',
                'is_featured' => false,
                'sort_order' => 3
            ],
            [
                'name' => 'Teknik Pemesinan',
                'full_name' => 'Teknik Pemesinan',
                'description' => 'Fokus pada proses produksi komponen menggunakan mesin bubut, frais, dan CNC.',
                'color' => 'gray',
                'competencies' => ['Bubut', 'Frais', 'CNC', 'CAD/CAM'],
                'careers' => ['Operator Mesin', 'CNC Programmer', 'Quality Control'],
                'icon' => 'fas fa-cogs',
                'is_featured' => false,
                'sort_order' => 4
            ]
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
