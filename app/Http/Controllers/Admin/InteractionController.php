<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Comment;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    /**
     * Display all interactions (likes, dislikes, comments)
     */
    public function index(Request $request)
    {
        $galleries = Gallery::with(['comments'])
            ->withCount(['comments', 'likes', 'dislikes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.interactions.index', compact('galleries'));
    }

    /**
     * Show interactions for a specific gallery
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['comments' => function($query) {
            $query->with('user')->latest();
        }]);
        
        // Load likes with user data
        $gallery->load(['likes' => function($query) {
            $query->with('user')->latest();
        }]);
        
        // Load dislikes with user data
        $gallery->load(['dislikes' => function($query) {
            $query->with('user')->latest();
        }]);
        
        // Get likes and dislikes counts from database
        $likesCount = $gallery->likes()->count();
        $dislikesCount = $gallery->dislikes()->count();
        
        return view('admin.interactions.show', compact('gallery', 'likesCount', 'dislikesCount'));
    }
}
