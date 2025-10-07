<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function __construct()
    {
        // Public can view gallery listing, detail, and search
        // Auth required for create/update/delete/toggle
        $this->middleware('auth')->except(['index', 'show', 'search', 'apiIndex', 'apiShow', 'apiSearch']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with(['category', 'user'])
            ->where(function($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->latest()
            ->paginate(12);
            
        $categories = Category::active()->get();
        
        return view('gallery.index', compact('galleries', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('gallery.create', compact('categories'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = Gallery::with(['category', 'user', 'comments.user', 'likes', 'dislikes'])
            ->where('id', $id)
            ->where(function($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->firstOrFail();
            
        // Increment view count
        $gallery->increment('views');
        
        // For API responses, return JSON
        if (request()->wantsJson()) {
            return response()->json([
                'gallery' => $gallery,
                'likes_count' => $gallery->likes->count(),
                'dislikes_count' => $gallery->dislikes->count(),
                'comments_count' => $gallery->comments->count(),
                'has_liked' => auth()->check() ? $gallery->likes->contains('user_id', auth()->id()) : false,
                'has_disliked' => auth()->check() ? $gallery->dislikes->contains('user_id', auth()->id()) : false,
            ]);
        }
            
        return view('gallery.show', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Memulai proses upload gallery', $request->except(['image']));
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'category_id' => 'nullable|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            \Log::warning('Validasi gagal', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $image = $request->file('image');
            
            // Log info file
            \Log::info('Mengupload file gallery', [
                'name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
                'mime' => $image->getMimeType()
            ]);
            
            // Store with unique hashed filename on the public disk
            $imagePath = $image->store('gallery', 'public');
            
            if (!$imagePath) {
                throw new \Exception('Gagal menyimpan file gambar');
            }
            
            // TODO: implement real thumbnail generation if needed
            $thumbnailPath = $imagePath; // For now, same as original

            $gallery = Gallery::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
                'thumbnail' => $thumbnailPath,
                'category_id' => $request->category_id ?: null,
                'user_id' => Auth::id(),
                'location' => $request->location,
                'event_date' => $request->event_date,
                'is_featured' => $request->has('is_featured'),
            ]);
            
            \Log::info('Gallery berhasil dibuat', ['id' => $gallery->id]);

            return response()->json([
                'success' => true,
                'message' => 'Galeri berhasil ditambahkan',
                'redirect' => '/gallery'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error saat membuat gallery: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan galeri: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        
        $categories = Category::active()->get();
        return view('gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        \Log::info('Memperbarui gallery', ['id' => $gallery->id, 'data' => $request->except(['image'])]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'category_id' => 'nullable|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            \Log::warning('Validasi update gallery gagal', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['title', 'description', 'category_id', 'location', 'event_date']);
            
            // Handle image upload if new image is provided
            if ($request->hasFile('image')) {
                // Log new image info
                $image = $request->file('image');
                \Log::info('Mengupdate gambar gallery', [
                    'old_image' => $gallery->image,
                    'new_image' => $image->getClientOriginalName(),
                    'size' => $image->getSize(),
                    'mime' => $image->getMimeType()
                ]);
                
                // Delete old images if they exist
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                    \Log::info('Gambar lama dihapus', ['path' => $gallery->image]);
                }
                
                if ($gallery->thumbnail && $gallery->thumbnail !== $gallery->image && Storage::disk('public')->exists($gallery->thumbnail)) {
                    Storage::disk('public')->delete($gallery->thumbnail);
                    \Log::info('Thumbnail lama dihapus', ['path' => $gallery->thumbnail]);
                }
                
                // Store new image
                $imagePath = $image->store('gallery', 'public');
                
                if (!$imagePath) {
                    throw new \Exception('Gagal menyimpan file gambar');
                }
                
                $data['image'] = $imagePath;
                // For now, use the same image as thumbnail
                $data['thumbnail'] = $imagePath;
                \Log::info('Gambar gallery berhasil diupdate', ['path' => $imagePath]);
            }

            $data['is_featured'] = $request->has('is_featured');
            
            $gallery->update($data);
            \Log::info('Gallery berhasil diupdate', ['id' => $gallery->id]);

            return response()->json([
                'success' => true,
                'message' => 'Galeri berhasil diperbarui',
                'redirect' => '/gallery/'.$gallery->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Error saat mengupdate gallery: ' . $e->getMessage(), [
                'id' => $gallery->id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui galeri: ' . $e->getMessage()
            ], 500);
        }
    }

    /**

    } catch (\Exception $e) {
        \Log::error('Gagal menghapus gallery: ' . $e->getMessage(), [
            'id' => $gallery->id,
            'trace' => $e->getTraceAsString()
                'success' => false,
                'message' => 'Error deleting gallery: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        
        $gallery->update(['is_featured' => !$gallery->is_featured]);
        
        return response()->json([
            'success' => true,
            'message' => 'Featured status updated',
            'is_featured' => $gallery->is_featured
        ]);
    }

    /**
     * Search galleries
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        
        $galleries = Gallery::with(['category', 'user'])
            ->where(function($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->when($query, function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                $q->where('category_id', $category);
            })
            ->latest()
            ->paginate(12);
            
        $categories = Category::active()->get();
        
        return view('gallery.index', compact('galleries', 'categories', 'query', 'category'));
    }

    /**
     * API: List galleries (public)
     */
    public function apiIndex(Request $request)
    {
        $perPage = (int)($request->get('per_page', 12));
        $galleries = Gallery::with(['category', 'user'])
            ->active()
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'data' => $galleries,
        ]);
    }

    /**
     * API: Show gallery detail (public)
     */
    public function apiShow($id)
    {
        $gallery = Gallery::with(['category', 'user'])->findOrFail($id);
        return response()->json(['data' => $gallery]);
    }

    /**
     * API: Search galleries (public)
     */
    public function apiSearch(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $perPage = (int)($request->get('per_page', 12));

        $galleries = Gallery::with(['category', 'user'])
            ->active()
            ->when($query, function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                $q->where('category_id', $category);
            })
            ->latest()
            ->paginate($perPage);

        return response()->json(['data' => $galleries]);
    }

    /**
     * API: Update gallery (admin, JSON response)
     */
    public function apiUpdate(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->authorize('update', $gallery);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'category_id' => 'sometimes|required|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->only(['title', 'description', 'category_id', 'location', 'event_date']);
            $data['is_featured'] = $request->has('is_featured');

            if ($request->hasFile('image')) {
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }
                if ($gallery->thumbnail && Storage::disk('public')->exists($gallery->thumbnail)) {
                    Storage::disk('public')->delete($gallery->thumbnail);
                }

                $image = $request->file('image');
                // Store with unique hashed filename on the public disk
                $imagePath = $image->store('gallery', 'public');
                $data['image'] = $imagePath;
                $data['thumbnail'] = $imagePath;
            }

            $gallery->update($data);
            return response()->json(['success' => true, 'data' => $gallery]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * API: Delete gallery (admin, JSON response)
     */
    public function apiDestroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->authorize('delete', $gallery);

        try {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            if ($gallery->thumbnail && Storage::disk('public')->exists($gallery->thumbnail)) {
                Storage::disk('public')->delete($gallery->thumbnail);
            }
            $gallery->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
