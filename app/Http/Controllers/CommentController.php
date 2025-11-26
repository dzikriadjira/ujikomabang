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
     * Store a newly created comment in storage (for guests without login)
     */
    public function store(Request $request, Gallery $gallery)
    {
        // Check if this is an AJAX request (from the gallery show page)
        if ($request->expectsJson()) {
            $validator = Validator::make($request->all(), [
                'content' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Comment content is required',
                    'errors' => $validator->errors()
                ], 422);
            }

            $comment = new Comment();
            $comment->content = $request->content;
            $comment->gallery_id = $gallery->id;
            $comment->user_id = Auth::id(); // Use authenticated user ID
            $comment->save();

            // Load user relationship for response
            $comment->load('user');

            return response()->json([
                'status' => 'success',
                'message' => 'Komentar berhasil ditambahkan!',
                'comment' => $comment,
                'comments_count' => $gallery->comments()->count()
            ]);
        }

        // Handle regular form submission (for guests)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store comment with guest name
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->guest_name = $request->name;
        $comment->gallery_id = $gallery->id;
        $comment->user_id = null; // No user ID for guests
        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Store comment via API (for authenticated users)
     */
    public function storeApi(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment content is required',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->gallery_id = $gallery->id;
        $comment->user_id = Auth::id(); // Use authenticated user ID
        $comment->save();

        // Load user relationship for response
        $comment->load('user');

        return response()->json([
            'status' => 'success',
            'message' => 'Komentar berhasil ditambahkan!',
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
