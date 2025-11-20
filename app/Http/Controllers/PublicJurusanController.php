<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class PublicJurusanController extends Controller
{
    public function __construct()
    {
        // Controller ini tidak memerlukan authentication
        // Halaman publik untuk menampilkan informasi jurusan
    }

    /**
     * Halaman Publik Jurusan - Tanpa Authentication
     */
    public function index(Request $request)
    {
        // Ambil data jurusan dari database
        $jurusans = Jurusan::active()->ordered()->get();
        
        // Transform data untuk view
        $jurusanList = $jurusans->map(function ($jurusan) {
            $colorMap = [
                'blue' => ['color' => 'from-blue-600 to-purple-600', 'bgColor' => 'bg-blue-100', 'textColor' => 'text-blue-600'],
                'red' => ['color' => 'from-red-600 to-orange-600', 'bgColor' => 'bg-red-100', 'textColor' => 'text-red-600'],
                'gray' => ['color' => 'from-gray-600 to-gray-800', 'bgColor' => 'bg-gray-100', 'textColor' => 'text-gray-600'],
                'green' => ['color' => 'from-green-600 to-teal-600', 'bgColor' => 'bg-green-100', 'textColor' => 'text-green-600'],
                'purple' => ['color' => 'from-purple-600 to-indigo-600', 'bgColor' => 'bg-purple-100', 'textColor' => 'text-purple-600'],
                'yellow' => ['color' => 'from-yellow-600 to-orange-600', 'bgColor' => 'bg-yellow-100', 'textColor' => 'text-yellow-600'],
            ];
            
            $colors = $colorMap[$jurusan->color] ?? $colorMap['blue'];
            
            // Gunakan accessor model untuk mendapatkan URL gambar
            $imagePathWeb = $jurusan->image_url;
            if ($imagePathWeb === null && file_exists(public_path('images/lg_pplg-removebg-preview.png')))
            {
                $imagePathWeb = '/images/lg_pplg-removebg-preview.png';
            }

            return [
                'id' => strtolower($jurusan->name),
                'nama' => $jurusan->name,
                'fullName' => $jurusan->full_name,
                'description' => $jurusan->description,
                'image' => $imagePathWeb,
                'icon' => $jurusan->icon,
                'color' => $colors['color'],
                'bgColor' => $colors['bgColor'],
                'textColor' => $colors['textColor'],
                'skills' => $jurusan->competencies ?? [],
                'careers' => $jurusan->careers ?? [],
                'is_featured' => $jurusan->is_featured
            ];
        })->toArray();

        // Jika ada parameter jurusan, pindahkan ke atas
        $selectedJurusan = $request->query('jurusan');
        if ($selectedJurusan) {
            // Cari jurusan yang dipilih
            $selectedIndex = null;
            foreach ($jurusanList as $index => $jurusan) {
                if ($jurusan['id'] === $selectedJurusan) {
                    $selectedIndex = $index;
                    break;
                }
            }
            
            // Jika jurusan ditemukan, pindahkan ke atas
            if ($selectedIndex !== null) {
                $selectedJurusanData = $jurusanList[$selectedIndex];
                unset($jurusanList[$selectedIndex]);
                array_unshift($jurusanList, $selectedJurusanData);
            }
        }

        return view('public.jurusan', compact('jurusanList', 'selectedJurusan'));
    }
}
