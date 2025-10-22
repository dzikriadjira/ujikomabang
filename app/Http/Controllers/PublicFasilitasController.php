<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class PublicFasilitasController extends Controller
{
    public function __construct()
    {
        // Controller ini tidak memerlukan authentication
        // Halaman publik untuk menampilkan informasi fasilitas
    }

    /**
     * Halaman Publik Fasilitas - Tanpa Authentication
     */
    public function index(Request $request)
    {
        // Ambil data fasilitas dari database
        $fasilitas = Fasilitas::active()->ordered()->get();
        
        // Transform data untuk view
        $fasilitasList = $fasilitas->map(function ($fasilitasItem) {
            $colorMap = [
                'blue' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-500'],
                'red' => ['bg' => 'bg-red-500', 'text' => 'text-red-500'],
                'gray' => ['bg' => 'bg-gray-600', 'text' => 'text-gray-600'],
                'green' => ['bg' => 'bg-green-500', 'text' => 'text-green-500'],
                'purple' => ['bg' => 'bg-purple-500', 'text' => 'text-purple-500'],
                'orange' => ['bg' => 'bg-orange-500', 'text' => 'text-orange-500'],
            ];
            
            $colors = $colorMap[$fasilitasItem->color] ?? $colorMap['blue'];
            
            return [
                'id' => $fasilitasItem->id,
                'name' => $fasilitasItem->name,
                'description' => $fasilitasItem->description,
                'icon' => $fasilitasItem->icon,
                'bgColor' => $colors['bg'],
                'textColor' => $colors['text'],
                'features' => $fasilitasItem->features ?? [],
                'category' => $fasilitasItem->category,
                'image' => $fasilitasItem->image
            ];
        })->toArray();

        return view('profil.fasilitas', compact('fasilitasList'));
    }
}