<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JurusanController extends Controller
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
        $jurusans = Jurusan::ordered()->get();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'required|string|max:50',
            'competencies' => 'required|array|min:1',
            'competencies.*' => 'required|string|max:255',
            'careers' => 'required|array|min:1',
            'careers.*' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->store('jurusan', 'public');
            $data['image'] = $imagePath;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['sort_order'] = $request->sort_order ?? 0;

        Jurusan::create($data);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        return view('admin.jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'required|string|max:50',
            'competencies' => 'required|array|min:1',
            'competencies.*' => 'required|string|max:255',
            'careers' => 'required|array|min:1',
            'careers.*' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($jurusan->image) {
                Storage::disk('public')->delete($jurusan->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->store('jurusan', 'public');
            $data['image'] = $imagePath;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['sort_order'] = $request->sort_order ?? 0;

        $jurusan->update($data);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        // Delete image if exists
        if ($jurusan->image) {
            Storage::disk('public')->delete($jurusan->image);
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
