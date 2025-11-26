<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::latest();

        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->status === 'active') {
            $query->where('is_active', true);
        } elseif ($request->status === 'inactive') {
            $query->where('is_active', false);
        }

        $beritas = $query->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['published_at'] = $request->published_at ? Carbon::parse($request->published_at) : now();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        if (empty($data['excerpt'])) {
            $data['excerpt'] = substr(strip_tags($data['content']), 0, 200) . '...';
        }

        if (empty($data['author'])) {
            $data['author'] = auth()->user()->name;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['published_at'] = $request->published_at ? Carbon::parse($request->published_at) : $berita->published_at;
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($berita->image && file_exists(public_path('images/' . $berita->image))) {
                unlink(public_path('images/' . $berita->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        if (empty($data['excerpt'])) {
            $data['excerpt'] = substr(strip_tags($data['content']), 0, 200) . '...';
        }

        if (empty($data['author'])) {
            $data['author'] = auth()->user()->name;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Delete image
        if ($berita->image && file_exists(public_path('images/' . $berita->image))) {
            unlink(public_path('images/' . $berita->image));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function toggleActive($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->is_active = !$berita->is_active;
        $berita->save();

        $status = $berita->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.berita.index')
            ->with('success', "Berita berhasil {$status}!");
    }
}
