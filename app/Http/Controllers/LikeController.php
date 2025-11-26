<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    private const SESSION_PREFIX_LIKED = 'liked_gallery_';
    private const SESSION_PREFIX_DISLIKED = 'disliked_gallery_';
    private const SESSION_COUNT_PREFIX = 'gallery_';
    private const SESSION_COUNT_SUFFIX = '_count';
    
    /**
     * Toggle like for a gallery (database for authenticated users, session for guests)
     */
    public function toggleLike(Request $request, Gallery $gallery): JsonResponse
    {
        // If user is authenticated, use database
        if (Auth::check()) {
            return $this->toggleLikeDatabase($gallery);
        }
        
        // Otherwise use session (guest)
        $sessionKey = self::SESSION_PREFIX_LIKED . $gallery->id;
        $isLiked = Session::has($sessionKey);
        
        if ($isLiked) {
            $this->removeReaction($gallery->id, $sessionKey, 'likes');
            $message = 'Like dihapus';
        } else {
            $this->addReaction($gallery->id, $sessionKey, 'likes');
            $message = 'Disukai';
        }
        
        return $this->buildResponse($gallery->id, $message);
    }
    
    /**
     * Store a like via API (for authenticated users)
     */
    public function store(Request $request, Gallery $gallery): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required'
            ], 401);
        }

        return $this->toggleLikeDatabase($gallery);
    }

    /**
     * Destroy a like via API (for authenticated users)
     */
    public function destroy(Request $request, Gallery $gallery): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required'
            ], 401);
        }

        $user = Auth::user();
        
        // Check if user has liked this gallery
        $existingLike = Like::where('user_id', $user->id)
                           ->where('gallery_id', $gallery->id)
                           ->first();
        
        if ($existingLike) {
            $existingLike->delete();
        }
        
        // Get updated counts
        $likesCount = Like::where('gallery_id', $gallery->id)->count();
        $dislikesCount = \App\Models\Dislike::where('gallery_id', $gallery->id)->count();
        
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Like removed',
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => false,
        ]);
    }
    
    /**
     * Toggle like using database (for authenticated users)
     */
    private function toggleLikeDatabase(Gallery $gallery): JsonResponse
    {
        $user = Auth::user();
        
        // Check if user already liked this gallery
        $existingLike = Like::where('user_id', $user->id)
                           ->where('gallery_id', $gallery->id)
                           ->first();
        
        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $isLiked = false;
            $message = 'Like removed';
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'gallery_id' => $gallery->id,
            ]);
            $isLiked = true;
            $message = 'Liked!';
        }
        
        // Get updated counts
        $likesCount = Like::where('gallery_id', $gallery->id)->count();
        $dislikesCount = \App\Models\Dislike::where('gallery_id', $gallery->id)->count();
        
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => $message,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => $isLiked,
        ]);
    }
    
    /**
     * Toggle dislike for a gallery (using session for guests)
     */
    public function toggleDislike(Request $request, Gallery $gallery): JsonResponse
    {
        $sessionKey = self::SESSION_PREFIX_DISLIKED . $gallery->id;
        $isDisliked = Session::has($sessionKey);
        
        if ($isDisliked) {
            $this->removeReaction($gallery->id, $sessionKey, 'dislikes');
            $message = 'Tidak jadi tidak suka';
        } else {
            $this->addReaction($gallery->id, $sessionKey, 'dislikes');
            $message = 'Tidak disukai';
        }
        
        return $this->buildResponse($gallery->id, $message);
    }
    
    /**
     * Add a reaction (like/dislike) to the session
     */
    private function addReaction(int $galleryId, string $sessionKey, string $reactionType): void
    {
        // Remove opposite reaction if exists
        $oppositeKey = $reactionType === 'likes' 
            ? self::SESSION_PREFIX_DISLIKED . $galleryId
            : self::SESSION_PREFIX_LIKED . $galleryId;
            
        Session::forget($oppositeKey);
        
        // Add reaction
        Session::put($sessionKey, true);
        
        // Increment counter
        $counterKey = self::SESSION_COUNT_PREFIX . $galleryId . '_' . $reactionType . self::SESSION_COUNT_SUFFIX;
        Session::put($counterKey, (int) Session::get($counterKey, 0) + 1);
    }
    
    /**
     * Remove a reaction (like/dislike) from the session
     */
    private function removeReaction(int $galleryId, string $sessionKey, string $reactionType): void
    {
        Session::forget($sessionKey);
        
        // Decrement counter if needed
        $counterKey = self::SESSION_COUNT_PREFIX . $galleryId . '_' . $reactionType . self::SESSION_COUNT_SUFFIX;
        $count = (int) Session::get($counterKey, 1);
        
        if ($count > 0) {
            Session::put($counterKey, $count - 1);
        }
    }
    
    /**
     * Build the JSON response with reaction data
     */
    private function buildResponse(int $galleryId, string $message): JsonResponse
    {
        $likesCount = $this->getReactionCount($galleryId, 'likes');
        $dislikesCount = $this->getReactionCount($galleryId, 'dislikes');
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => Session::has(self::SESSION_PREFIX_LIKED . $galleryId),
            'is_disliked' => Session::has(self::SESSION_PREFIX_DISLIKED . $galleryId)
        ]);
    }
    
    /**
     * Get the count of a specific reaction type
     * 
     * @param int $galleryId The ID of the gallery
     * @param string $reactionType Either 'likes' or 'dislikes'
     * @return int The count of reactions
     */
    private function getReactionCount(int $galleryId, string $reactionType): int
    {
        // Pastikan reactionType valid
        if (!in_array($reactionType, ['likes', 'dislikes'])) {
            return 0;
        }

        // Tentukan prefix yang benar berdasarkan tipe reaksi
        $prefix = $reactionType === 'likes' 
            ? self::SESSION_PREFIX_LIKED 
            : self::SESSION_PREFIX_DISLIKED;
            
        // Buat kunci untuk counter
        $countKey = self::SESSION_COUNT_PREFIX . $galleryId . '_' . $reactionType . self::SESSION_COUNT_SUFFIX;
        
        // Dapatkan jumlah dasar dari session
        $baseCount = (int) Session::get($countKey, 0);
        
        // Periksa apakah reaksi ini aktif untuk gallery ini
        $isActive = Session::has($prefix . $galleryId);
        
        // Jika aktif, tambahkan 1 ke hitungan dasar
        return $isActive ? $baseCount + 1 : $baseCount;
    }
}
