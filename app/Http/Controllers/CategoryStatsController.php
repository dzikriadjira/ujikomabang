<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;

class CategoryStatsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get all categories with their gallery counts
        $categories = Category::withCount('galleries')
            ->orderBy('name')
            ->get();

        // Calculate total galleries
        $totalGalleries = Gallery::count();

        return view('admin.categories.stats', compact('categories', 'totalGalleries'));
    }
}
