<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Dislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
{
    /**
     * Toggle dislike for a gallery
     */
    public function toggle(Gallery $gallery)
    {
        // Check if user already disliked this gallery
        $existingDislike = Dislike::where('user_id', Auth::id())
            ->where('gallery_id', $gallery->id)
            ->first();

        if ($existingDislike) {
            // Remove dislike if already disliked
            $existingDislike->delete();
            return response()->json([
                'status' => 'undisliked',
                'dislikes_count' => $gallery->dislikes()->count()
            ]);
        }

        // Remove any existing like
        $gallery->likes()->where('user_id', Auth::id())->delete();

        // Create new dislike
        $dislike = new Dislike();
        $dislike->user_id = Auth::id();
        $gallery->dislikes()->save($dislike);

        return response()->json([
            'status' => 'disliked',
            'likes_count' => $gallery->likes()->count(),
            'dislikes_count' => $gallery->dislikes()->count()
        ]);
    }

    /**
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
    }
}
