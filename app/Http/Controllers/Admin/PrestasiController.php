<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestasis = Prestasi::ordered()->get();
        return view('admin.prestasi.index', compact('prestasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Mulai proses upload prestasi', $request->except(['image']));
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'category' => 'required|string|max:100',
            'level' => 'required|string|max:100',
            'year' => 'required|string|max:4',
            'student_name' => 'nullable|string|max:255',
            'teacher_name' => 'nullable|string|max:255',
            'achievement_details' => 'nullable|string',
            'color' => 'required|string|max:50',
            'icon' => 'required|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        try {
            $data = $request->except(['_token', 'image']);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                
                \Log::info('Mencoba menyimpan file prestasi', [
                    'name' => $imageName,
                    'size' => $image->getSize(),
                    'mime' => $image->getMimeType()
                ]);
                
                $imagePath = $image->store('prestasi', 'public');
                
                if (!$imagePath) {
                    throw new \Exception('Gagal menyimpan file gambar');
                }
                
                $data['image'] = $imagePath;
                \Log::info('File prestasi berhasil disimpan', ['path' => $imagePath]);
            }

            $data['is_featured'] = $request->has('is_featured');
            $data['is_active'] = $request->has('is_active');
            $data['sort_order'] = $request->sort_order ?? 0;

            $prestasi = Prestasi::create($data);
            \Log::info('Data prestasi berhasil disimpan', ['id' => $prestasi->id]);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan prestasi: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan prestasi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        return view('admin.prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        \Log::info('Memperbarui prestasi', ['id' => $prestasi->id, 'data' => $request->except(['image'])]);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'category' => 'required|string|max:100',
            'level' => 'required|string|max:100',
            'year' => 'required|string|max:4',
            'student_name' => 'nullable|string|max:255',
            'teacher_name' => 'nullable|string|max:255',
            'achievement_details' => 'nullable|string',
            'color' => 'required|string|max:50',
            'icon' => 'required|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        try {
            $data = $request->except(['_token', '_method', 'image']);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($prestasi->image && Storage::disk('public')->exists($prestasi->image)) {
                    Storage::disk('public')->delete($prestasi->image);
                }
                
                $image = $request->file('image');
                \Log::info('Mengupdate gambar prestasi', [
                    'old_image' => $prestasi->image,
                    'new_image' => $image->getClientOriginalName(),
                    'size' => $image->getSize(),
                    'mime' => $image->getMimeType()
                ]);
                
                $imagePath = $image->store('prestasi', 'public');
                
                if (!$imagePath) {
                    throw new \Exception('Gagal menyimpan file gambar');
                }
                
                $data['image'] = $imagePath;
                \Log::info('Gambar prestasi berhasil diupdate', ['path' => $imagePath]);
            }

            $data['is_featured'] = $request->has('is_featured');
            $data['is_active'] = $request->has('is_active');
            $data['sort_order'] = $request->sort_order ?? 0;

            $prestasi->update($data);
            \Log::info('Data prestasi berhasil diupdate', ['id' => $prestasi->id]);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil diperbarui!');
                
        } catch (\Exception $e) {
            \Log::error('Error saat mengupdate prestasi: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui prestasi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        try {
            // Delete image if exists
            if ($prestasi->image && Storage::disk('public')->exists($prestasi->image)) {
                Storage::disk('public')->delete($prestasi->image);
                \Log::info('Gambar prestasi dihapus', ['path' => $prestasi->image]);
            }

            $prestasi->delete();
            \Log::info('Prestasi dihapus', ['id' => $prestasi->id]);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil dihapus!');
                
        } catch (\Exception $e) {
            \Log::error('Gagal menghapus prestasi: ' . $e->getMessage(), [
                'id' => $prestasi->id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->with('error', 'Gagal menghapus prestasi: ' . $e->getMessage());
        }
    }
}