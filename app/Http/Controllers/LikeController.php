<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Like;
<<<<<<< HEAD
use App\Models\Dislike;
=======
>>>>>>> 40faa748db351c71c2c78aef2a8e8edac43a1828
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
<<<<<<< HEAD
     * Toggle like for a gallery (using session for guests)
     */
    public function toggleLike(Request $request, Gallery $gallery)
    {
        // Get session ID as identifier for guests
        $sessionId = session()->getId();
        
        // Check if guest already liked using session
        $sessionKey = 'liked_gallery_' . $gallery->id;
        $hasLiked = session()->has($sessionKey);
        
        if ($hasLiked) {
            // Unlike - remove from session
            session()->forget($sessionKey);
            
            // Also remove dislike if exists
            session()->forget('disliked_gallery_' . $gallery->id);
            
            $message = 'Like dihapus';
        } else {
            // Remove any existing dislike from session
            session()->forget('disliked_gallery_' . $gallery->id);
            
            // Add like to session
            session()->put($sessionKey, true);
            
            $message = 'Disukai';
        }
        
        // Count likes and dislikes from session
        $likesCount = $this->countSessionLikes($gallery->id);
        $dislikesCount = $this->countSessionDislikes($gallery->id);
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => session()->has($sessionKey),
            'is_disliked' => session()->has('disliked_gallery_' . $gallery->id)
        ]);
    }
    
    /**
     * Toggle dislike for a gallery (using session for guests)
     */
    public function toggleDislike(Request $request, Gallery $gallery)
    {
        // Get session ID as identifier for guests
        $sessionId = session()->getId();
        
        // Check if guest already disliked using session
        $sessionKey = 'disliked_gallery_' . $gallery->id;
        $hasDisliked = session()->has($sessionKey);
        
        if ($hasDisliked) {
            // Remove dislike from session
            session()->forget($sessionKey);
            
            // Also remove like if exists
            session()->forget('liked_gallery_' . $gallery->id);
            
            $message = 'Tidak jadi tidak suka';
        } else {
            // Remove any existing like from session
            session()->forget('liked_gallery_' . $gallery->id);
            
            // Add dislike to session
            session()->put($sessionKey, true);
            
            $message = 'Tidak disukai';
        }
        
        // Count likes and dislikes from session
        $likesCount = $this->countSessionLikes($gallery->id);
        $dislikesCount = $this->countSessionDislikes($gallery->id);
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => session()->has('liked_gallery_' . $gallery->id),
            'is_disliked' => session()->has($sessionKey)
        ]);
    }
    
    /**
     * Count likes from session (simple counter)
     */
    private function countSessionLikes($galleryId)
    {
        // For simplicity, we'll use a counter stored in session
        $key = 'gallery_' . $galleryId . '_likes_count';
        $count = session()->get($key, 0);
        
        if (session()->has('liked_gallery_' . $galleryId)) {
            return $count + 1;
        }
        
        return $count;
    }
    
    /**
     * Count dislikes from session (simple counter)
     */
    private function countSessionDislikes($galleryId)
    {
        // For simplicity, we'll use a counter stored in session
        $key = 'gallery_' . $galleryId . '_dislikes_count';
        $count = session()->get($key, 0);
        
        if (session()->has('disliked_gallery_' . $galleryId)) {
            return $count + 1;
        }
        
        return $count;
=======
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
>>>>>>> 40faa748db351c71c2c78aef2a8e8edac43a1828
    }
}
