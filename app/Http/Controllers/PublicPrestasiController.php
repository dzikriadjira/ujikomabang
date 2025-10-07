<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PublicPrestasiController extends Controller
{
    public function __construct()
    {
        // No middleware needed for public access
    }

    public function index(Request $request)
    {
        $prestasis = Prestasi::active()->ordered()->get();
        
        // Calculate stats
        $stats = [
            'total_prestasi' => $prestasis->count(),
            'nasional' => $prestasis->where('level', 'nasional')->count(),
            'provinsi' => $prestasis->where('level', 'provinsi')->count(),
            'kabupaten' => $prestasis->where('level', 'kabupaten')->count(),
            'sekolah' => $prestasis->where('level', 'sekolah')->count(),
            'featured' => $prestasis->where('is_featured', true)->count(),
            'this_year' => $prestasis->where('year', date('Y'))->count(),
        ];
        
        $prestasiList = $prestasis->map(function ($prestasi) {
            $colorMap = [
                'blue' => ['bgColor' => 'bg-blue-500', 'textColor' => 'text-blue-600'],
                'red' => ['bgColor' => 'bg-red-500', 'textColor' => 'text-red-600'],
                'gray' => ['bgColor' => 'bg-gray-600', 'textColor' => 'text-gray-600'],
                'green' => ['bgColor' => 'bg-green-500', 'textColor' => 'text-green-600'],
                'purple' => ['bgColor' => 'bg-purple-500', 'textColor' => 'text-purple-600'],
                'yellow' => ['bgColor' => 'bg-yellow-500', 'textColor' => 'text-yellow-600'],
                'orange' => ['bgColor' => 'bg-orange-500', 'textColor' => 'text-orange-600'],
            ];
            
            $colors = $colorMap[$prestasi->color] ?? $colorMap['blue'];
            
            return [
                'id' => $prestasi->id,
                'title' => $prestasi->title,
                'description' => $prestasi->description,
                'image' => $prestasi->image,
                'category' => $prestasi->category,
                'level' => $prestasi->level,
                'year' => $prestasi->year,
                'student_name' => $prestasi->student_name,
                'teacher_name' => $prestasi->teacher_name,
                'achievement_details' => $prestasi->achievement_details,
                'icon' => $prestasi->icon,
                'is_featured' => $prestasi->is_featured,
                'bgColor' => $colors['bgColor'],
                'textColor' => $colors['textColor'],
            ];
        })->toArray();

        // Group by level for better display
        $groupedPrestasis = collect($prestasiList)->groupBy('level');

        return view('profil.prestasi', compact('prestasiList', 'groupedPrestasis', 'stats'));
    }
}
