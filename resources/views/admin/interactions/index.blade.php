@extends('layouts.app')

@section('title', 'Interaksi Pengguna - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Interaksi Pengguna</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
            <span class="mx-2 text-gray-500">/</span>
            <span class="text-gray-700">Interaksi</span>
        </nav>
    </div>

    <!-- Gallery Interactions Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200" style="background-color: #93C5FD;">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-table mr-2"></i>
                Daftar Galeri dan Interaksi
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Likes</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Dislikes</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Komentar</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($galleries as $gallery)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-16 h-16 object-cover rounded-lg">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $gallery->title }}</div>
                                <div class="text-sm text-gray-500">{{ $gallery->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-thumbs-up mr-1"></i> {{ session()->get('gallery_' . $gallery->id . '_likes_count', 0) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-thumbs-down mr-1"></i> {{ session()->get('gallery_' . $gallery->id . '_dislikes_count', 0) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-comment mr-1"></i> {{ $gallery->comments_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.interactions.show', $gallery->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                    <i class="fas fa-eye mr-2"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
                                <p>Tidak ada data galeri</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
