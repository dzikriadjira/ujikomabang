@extends('layouts.app')

@section('title', 'Dashboard Admin - Galeri Sekolah SMKN 4 Bogor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="mt-2 text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        <p class="mt-1 text-sm font-medium" style="color: var(--primary-blue-dark);">SMKN 4 Bogor - Sistem Galeri Sekolah</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-md flex items-center justify-center" style="background: var(--gradient-primary);">
                            <i class="fas fa-images text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Galeri</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $totalGalleries }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-md flex items-center justify-center" style="background: var(--gradient-secondary);">
                            <i class="fas fa-tags text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Kategori</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $totalCategories }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-md flex items-center justify-center" style="background: var(--gradient-light);">
                            <i class="fas fa-users text-blue-700"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Admin</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $totalUsers }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Management Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Gallery Management -->
        <a href="{{ route('gallery.index') }}" class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                            <i class="fas fa-images text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Galeri</h3>
                        <p class="text-sm text-gray-600">Kelola foto sekolah</p>
                    </div>
                </div>
            </div>
        </a>

        <!-- Jurusan Management -->
        <a href="{{ route('admin.jurusan.index') }}" class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Jurusan</h3>
                        <p class="text-sm text-gray-600">Kelola program studi</p>
                    </div>
                </div>
            </div>
        </a>

        <!-- Fasilitas Management -->
        <a href="{{ route('admin.fasilitas.index') }}" class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);">
                            <i class="fas fa-building text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Fasilitas</h3>
                        <p class="text-sm text-gray-600">Kelola sarana sekolah</p>
                    </div>
                </div>
            </div>
        </a>

        <!-- Prestasi Management -->
        <a href="{{ route('admin.prestasi.index') }}" class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%); box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);">
                            <i class="fas fa-trophy text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Prestasi</h3>
                        <p class="text-sm text-gray-600">Kelola pencapaian</p>
                    </div>
                </div>
            </div>
        </a>
<<<<<<< HEAD

        <!-- Interactions Management -->
        <a href="{{ route('admin.interactions.index') }}" class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%); box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);">
                            <i class="fas fa-comments text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Interaksi</h3>
                        <p class="text-sm text-gray-600">Like, Dislike & Komentar</p>
                    </div>
                </div>
            </div>
        </a>
=======
>>>>>>> 40faa748db351c71c2c78aef2a8e8edac43a1828
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100 mb-8">
        <div class="px-6 py-5">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-bolt mr-3 text-blue-500"></i>
                Aksi Cepat
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('gallery.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg" 
                   style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Galeri
                </a>
                <a href="{{ route('categories.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg" 
                   style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-tag mr-2"></i>
                    Tambah Kategori
                </a>
                <a href="{{ route('admin.prestasi.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg" 
                   style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%); box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);">
                    <i class="fas fa-trophy mr-2"></i>
                    Tambah Prestasi
                </a>
                @if(\App\Helpers\AdminHelper::isCurrentUserSuperAdmin())
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-white font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg" 
                   style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah Admin
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Galleries -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    Galeri Terbaru
                </h3>
                <div class="space-y-4">
                    @forelse($recentGalleries as $gallery)
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-lg object-cover" 
                                 src="{{ asset('storage/' . $gallery->thumbnail) }}" 
                                 alt="{{ $gallery->title }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $gallery->title }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $gallery->user->name }} • {{ $gallery->category->name }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $gallery->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada galeri</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Lihat semua galeri →
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    Admin Terbaru
                </h3>
                <div class="space-y-4">
                    @forelse($recentUsers as $user)
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $user->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $user->email }} • {{ ucfirst($user->role) }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $user->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada admin</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
