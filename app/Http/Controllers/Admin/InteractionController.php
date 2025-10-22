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
            ->withCount(['comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.interactions.index', compact('galleries'));
    }

    /**
     * Show interactions for a specific gallery
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['comments']);
        
        // Get session-based likes and dislikes counts
        $likesCount = session()->get('gallery_' . $gallery->id . '_likes_count', 0);
        $dislikesCount = session()->get('gallery_' . $gallery->id . '_dislikes_count', 0);
        
        return view('admin.interactions.show', compact('gallery', 'likesCount', 'dislikesCount'));
    }
}
