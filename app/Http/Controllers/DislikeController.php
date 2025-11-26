<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Dislike;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
{
    /**
     * Store a dislike via API (for authenticated users)
     */
    public function store(Request $request, Gallery $gallery)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required'
            ], 401);
        }

        $user = Auth::user();
        
        // Check if user already disliked this gallery
        $existingDislike = Dislike::where('user_id', $user->id)
            ->where('gallery_id', $gallery->id)
            ->first();

        if ($existingDislike) {
            // Remove dislike if already disliked
            $existingDislike->delete();
            $isDisliked = false;
            $message = 'Dislike removed';
        } else {
            // Remove any existing like first
            $gallery->likes()->where('user_id', $user->id)->delete();

            // Create new dislike
            Dislike::create([
                'user_id' => $user->id,
                'gallery_id' => $gallery->id,
            ]);
            $isDisliked = true;
            $message = 'Disliked!';
        }

        // Get updated counts
        $likesCount = Like::where('gallery_id', $gallery->id)->count();
        $dislikesCount = Dislike::where('gallery_id', $gallery->id)->count();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => $message,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_disliked' => $isDisliked,
            'is_liked' => false,
        ]);
    }

    /**
     * Destroy a dislike via API (for authenticated users)
     */
    public function destroy(Request $request, Gallery $gallery)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required'
            ], 401);
        }

        $user = Auth::user();
        
        // Check if user has disliked this gallery
        $existingDislike = Dislike::where('user_id', $user->id)
            ->where('gallery_id', $gallery->id)
            ->first();
        
        if ($existingDislike) {
            $existingDislike->delete();
        }
        
        // Get updated counts
        $likesCount = Like::where('gallery_id', $gallery->id)->count();
        $dislikesCount = Dislike::where('gallery_id', $gallery->id)->count();
        
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Dislike removed',
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_disliked' => false,
        ]);
    }

    /**
     * Toggle dislike for a gallery (legacy method for compatibility)
     */
    public function toggle(Request $request, Gallery $gallery)
    {
        return $this->store($request, $gallery);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
