@extends('layouts.app')

@section('title', 'Dashboard - Galeri Sekolah SMKN 4 Bogor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-2 text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        <p class="mt-1 text-sm text-blue-600 font-medium">SMKN 4 Bogor - Galeri Sekolah</p>
    </div>

    <!-- User Stats -->
    <div class="bg-white overflow-hidden shadow rounded-lg mb-8">
        <div class="p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Statistik Galeri Anda</h3>
                    <p class="mt-1 text-sm text-gray-500">Total galeri yang telah Anda buat</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-blue-600">{{ $totalUserGalleries }}</div>
                    <div class="text-sm text-gray-500">Galeri</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Galleries -->
    @if($featuredGalleries->count() > 0)
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Galeri Unggulan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredGalleries as $gallery)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img class="w-full h-48 object-cover" 
                         src="{{ url('storage/'.$gallery->image) }}" 
                         alt="{{ $gallery->title }}">
                    <div class="absolute top-2 right-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i>Unggulan
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $gallery->title }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($gallery->description, 100) }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-user mr-1"></i>
                            {{ $gallery->user->name }}
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-eye mr-1"></i>
                            {{ $gallery->views }}
                        </span>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('gallery.show', $gallery) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- User's Galleries -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Galeri Anda
                </h3>
                <a href="{{ route('gallery.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Galeri
                </a>
            </div>
            
            @if($userGalleries->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gambar
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dibuat
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($userGalleries as $gallery)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img class="h-12 w-12 rounded-lg object-cover" 
                                     src="{{ url('storage/'.$gallery->thumbnail) }}" 
                                     alt="{{ $gallery->title }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $gallery->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($gallery->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                      style="background-color: {{ $gallery->category->color }}20; color: {{ $gallery->category->color }};">
                                    {{ $gallery->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($gallery->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i>Unggulan
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Biasa
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $gallery->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('gallery.show', $gallery) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('gallery.edit', $gallery) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4">
                {{ $userGalleries->links() }}
            </div>
            @else
            <div class="text-center py-8">
                <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-images text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-sm font-medium text-gray-900 mb-2">Belum ada galeri</h3>
                <p class="text-gray-500 mb-4">Mulai dengan membuat galeri pertama Anda</p>
                <a href="{{ route('gallery.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Galeri Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
