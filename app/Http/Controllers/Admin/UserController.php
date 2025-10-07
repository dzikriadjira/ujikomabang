<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            // Only allow main admin (user with id 1) to access these routes
            if (auth()->id() !== 1) {
                abort(403, 'Unauthorized action. Hanya admin utama yang dapat mengakses halaman ini.');
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Staff can only see active users, admin can see all
        $query = User::latest();
        
        if (auth()->user()->role === 'staff') {
            $query->where('is_active', true);
        }
        
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', 'string', Rule::in(['admin', 'staff', 'user'])],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Staff can only create users with role 'user'
        if (auth()->user()->role === 'staff' && in_array($validated['role'], ['admin', 'staff'])) {
            return back()->with('error', 'You are not authorized to create admin or staff users.');
        }

        try {
            $validated['password'] = Hash::make($validated['password']);
            $validated['is_active'] = true;
            
            User::create($validated);
            
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Pengguna berhasil ditambahkan');
                
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan pengguna');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        
        // Staff can only edit users with role 'user'
        if (auth()->user()->role === 'staff' && in_array($user->role, ['admin', 'staff'])) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengedit pengguna ini.');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        // Staff can only update users with role 'user'
        if (auth()->user()->role === 'staff' && in_array($user->role, ['admin', 'staff'])) {
            return back()->with('error', 'Anda tidak memiliki izin untuk memperbarui pengguna ini.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => ['required', 'string', Rule::in(['admin', 'staff', 'user'])],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);
        
        // Staff cannot change user roles to admin/staff
        if (auth()->user()->role === 'staff' && 
            $user->role === 'user' && 
            in_array($validated['role'], ['admin', 'staff'])) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengubah peran pengguna ini.');
        }

        $validated = $request->validate([
            'is_active' => 'boolean',
        ]);

        try {
            // Hapus password dari array jika kosong
            if (empty($validated['password'])) {
                unset($validated['password']);
            } else {
                $validated['password'] = Hash::make($validated['password']);
            }
            
            $user->update($validated);
            
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Data pengguna berhasil diperbarui');
                
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data pengguna');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri');
        }
        
        // Staff cannot delete admin or other staff users
        if (auth()->user()->role === 'staff' && in_array($user->role, ['admin', 'staff'])) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus pengguna ini.');
        }
        
        try {
            $user->delete();
            
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Pengguna berhasil dihapus');
                
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return back()
                ->with('error', 'Terjadi kesalahan saat menghapus pengguna');
        }
    }
}
