<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GalleryViewController extends Controller
{
    /**
     * Display the gallery index page
     */
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->with(['galleries' => function($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return Inertia::render('Gallery/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Get gallery details for modal
     */
    /**
     * Get gallery details for modal
     */
    public function show(Gallery $gallery)
    {
        $gallery->load([
            'user',
            'category',
            'likes' => function($query) {
                $query->select('id', 'user_id', 'gallery_id');
            },
            'dislikes' => function($query) {
                $query->select('id', 'user_id', 'gallery_id');
            },
            'comments' => function($query) {
                $query->with('user')
                    ->latest()
                    ->take(5);
            }
        ]);

        // Add like and dislike counts
        $gallery->likes_count = $gallery->likes->count();
        $gallery->dislikes_count = $gallery->dislikes->count();
        $gallery->comments_count = $gallery->comments->count();

        // Check if current user has liked/disliked
        $user = auth()->user();
        if ($user) {
            $gallery->has_liked = $gallery->likes->contains('user_id', $user->id);
            $gallery->has_disliked = $gallery->dislikes->contains('user_id', $user->id);
        }

        // Unload relationships to avoid serialization issues
        unset($gallery->likes);
        unset($gallery->dislikes);

        return response()->json($gallery);
    }

    /**
     * Increment view count for a gallery
     */
    public function incrementViews(Gallery $gallery)
    {
        $gallery->increment('views');
        return response()->json(['status' => 'success']);
    }
}
