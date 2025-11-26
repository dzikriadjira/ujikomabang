<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FasilitasController extends Controller
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
        $fasilitas = Fasilitas::ordered()->get();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Mulai proses upload fasilitas', $request->except(['image']));
        
        try {
            // Validasi input dasar
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'color' => 'required|string',
                'icon' => 'required|string',
                'category' => 'required|string',
            ]);
            
            // Handle features secara manual
            $features = [];
            if ($request->has('features')) {
                if (is_string($request->features)) {
                    $features = array_filter([$request->features]);
                } else if (is_array($request->features)) {
                    $features = array_filter($request->features, function($value) {
                        return !empty(trim($value));
                    });
                }
            }
            
            if (empty($features)) {
                return back()->withInput()->with('error', 'Minimal satu fitur harus diisi');
            }
            
            // Siapkan data
            $data = $request->only(['name', 'description', 'color', 'icon', 'category', 'sort_order']);
            $data['features'] = json_encode(array_values($features));

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                
                \Log::info('Mencoba menyimpan file', [
                    'name' => $imageName,
                    'size' => $image->getSize(),
                    'mime' => $image->getMimeType()
                ]);
                
                // Simpan ke public/images folder
                $image->move(public_path('images'), $imageName);
                
                $data['image'] = $imageName;
                \Log::info('File berhasil disimpan', ['path' => $imageName]);
            }

            $data['is_active'] = $request->has('is_active');
            $data['sort_order'] = $request->sort_order ?? 0;

            $fasilitas = Fasilitas::create($data);
            \Log::info('Data fasilitas berhasil disimpan', ['id' => $fasilitas->id]);

            return redirect()->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan fasilitas: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan fasilitas: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($fasilita)
    {
        $fasilita = Fasilitas::findOrFail($fasilita);
        return view('admin.fasilitas.show', compact('fasilita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($fasilita)
    {
        $fasilita = Fasilitas::findOrFail($fasilita);
        return view('admin.fasilitas.edit', ['fasilitas' => $fasilita]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fasilita)
    {
        $fasilita = Fasilitas::findOrFail($fasilita);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'required|string|max:50',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($fasilita->image && file_exists(public_path('images/' . $fasilita->image))) {
                unlink(public_path('images/' . $fasilita->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        $fasilita->update($data);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function image($filename)
    {
        $path = public_path('images/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }
        
        $mimeType = mime_content_type($path);
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Length' => filesize($path),
        ];
        
        return response()->file($path, $headers);
    }

    public function destroy($fasilita)
    {
        $fasilita = Fasilitas::findOrFail($fasilita);
        
        try {
            // Debug: Log the fasilitas ID being deleted
            \Log::info('Deleting fasilitas ID: ' . $fasilita->id);
            
            // Delete image if exists
            if ($fasilita->image && file_exists(public_path('images/' . $fasilita->image))) {
                unlink(public_path('images/' . $fasilita->image));
            }

            // Hapus data dari database
            $deleted = $fasilita->delete();
            
            if (!$deleted) {
                throw new \Exception('Gagal menghapus data dari database');
            }
            
            // Debug: Log the result of delete operation
            \Log::info('Delete operation result: Success - Fasilitas ID ' . $fasilita->id . ' deleted');

            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Fasilitas berhasil dihapus!',
                    'data' => ['id' => $fasilita->id]
                ]);
            }

            return redirect()->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil dihapus!');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting fasilitas: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus fasilitas: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal menghapus fasilitas: ' . $e->getMessage());
        }
    }
}
