<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function __construct()
    {
        // Tidak memerlukan authentication untuk halaman jurusan
        // Ini adalah halaman publik
    }

    /**
     * Halaman Utama Jurusan dengan data dari database
     */
    public function index(Request $request)
    {
        // Get jurusan data from database
        $jurusans = Jurusan::active()->ordered()->get();
        
        // Transform database data to match view format
        $jurusanList = [];
        foreach ($jurusans as $jurusan) {
            // Resolve image path from storage to web path + provide sensible defaults
            $imagePathWeb = null;
            if (!empty($jurusan->image)) {
                $storageRealPath = storage_path('app/public/' . ltrim($jurusan->image, '/'));
                if (file_exists($storageRealPath)) {
                    $imagePathWeb = '/storage/' . ltrim($jurusan->image, '/');
                } elseif (file_exists(public_path($jurusan->image))) {
                    // already under public
                    $imagePathWeb = '/' . ltrim($jurusan->image, '/');
                }
            }

            // If still no image, try a conventional public path by id
            if ($imagePathWeb === null) {
                $id = strtolower(str_replace(' ', '', $jurusan->name));
                $conventional = 'images/jurusan/' . $id . '.png';
                if (file_exists(public_path($conventional))) {
                    $imagePathWeb = '/' . ltrim($conventional, '/');
                } elseif (file_exists(public_path('images/logok4.png'))) {
                    // final default logo
                    $imagePathWeb = '/images/logok4.png';
                }
            }

            $jurusanList[] = [
                'id' => strtolower(str_replace(' ', '', $jurusan->name)),
                'nama' => $jurusan->name,
                'fullName' => $jurusan->full_name,
                'description' => $jurusan->description,
                'image' => $imagePathWeb,
                'icon' => $jurusan->icon,
                'color' => $this->getColorClass($jurusan->color),
                'bgColor' => $this->getBgColorClass($jurusan->color),
                'textColor' => $this->getTextColorClass($jurusan->color),
                'skills' => $jurusan->competencies ?? [],
                'careers' => $jurusan->careers ?? [],
                'is_featured' => $jurusan->is_featured
            ];
        }

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

        return view('jurusan.index', compact('jurusanList', 'selectedJurusan'));
    }

    /**
     * Get color class based on color name
     */
    private function getColorClass($color)
    {
        $colorMap = [
            'blue' => 'from-blue-600 to-purple-600',
            'red' => 'from-red-600 to-orange-600',
            'green' => 'from-green-600 to-teal-600',
            'yellow' => 'from-yellow-600 to-orange-600',
            'gray' => 'from-gray-600 to-gray-800',
            'purple' => 'from-purple-600 to-indigo-600',
        ];
        
        return $colorMap[$color] ?? 'from-blue-600 to-purple-600';
    }

    /**
     * Get background color class based on color name
     */
    private function getBgColorClass($color)
    {
        $colorMap = [
            'blue' => 'bg-blue-100',
            'red' => 'bg-red-100',
            'green' => 'bg-green-100',
            'yellow' => 'bg-yellow-100',
            'gray' => 'bg-gray-100',
            'purple' => 'bg-purple-100',
        ];
        
        return $colorMap[$color] ?? 'bg-blue-100';
    }

    /**
     * Get text color class based on color name
     */
    private function getTextColorClass($color)
    {
        $colorMap = [
            'blue' => 'text-blue-600',
            'red' => 'text-red-600',
            'green' => 'text-green-600',
            'yellow' => 'text-yellow-600',
            'gray' => 'text-gray-600',
            'purple' => 'text-purple-600',
        ];
        
        return $colorMap[$color] ?? 'text-blue-600';
    }
}
