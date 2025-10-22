<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin dashboard
            $totalGalleries = Gallery::count();
            $totalCategories = Category::count();
            $totalUsers = User::count();
            $recentGalleries = Gallery::with(['category', 'user'])->latest()->limit(5)->get();
            $recentUsers = User::latest()->limit(5)->get();
            
            return view('dashboard.admin', compact(
                'totalGalleries', 
                'totalCategories', 
                'totalUsers', 
                'recentGalleries', 
                'recentUsers'
            ));
        } else {
            // User dashboard
            $userGalleries = Gallery::where('user_id', $user->id)
                ->with('category')
                ->latest()
                ->paginate(10);
                
            $totalUserGalleries = Gallery::where('user_id', $user->id)->count();
            $featuredGalleries = Gallery::featured()->with('category')->limit(6)->get();
            
            return view('dashboard.user', compact(
                'userGalleries', 
                'totalUserGalleries', 
                'featuredGalleries'
            ));
        }
    }
}
