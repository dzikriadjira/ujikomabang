<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        
        $gallery->comments()->save($comment);
        $comment->load('user');

        return response()->json([
            'status' => 'success',
            'message' => 'Komentar berhasil ditambahkan',
            'comment' => $comment,
            'comments_count' => $gallery->comments()->count()
        ]);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Gallery $gallery, Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (Auth::id() !== $comment->user_id && !Auth::user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Komentar berhasil dihapus',
            'comments_count' => $gallery->comments()->count()
        ]);
    }

    /**
     * Get paginated comments for a gallery
     */
    public function index(Gallery $gallery)
    {
        $comments = $gallery->comments()
            ->with('user')
            ->latest()
            ->paginate(10);

        return response()->json($comments);
    }
}
