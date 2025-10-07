@extends('layouts.app')

@section('title', 'Kelola Prestasi - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Prestasi</h1>
                        <p class="text-gray-600 mt-2">Kelola prestasi dan pencapaian sekolah</p>
                    </div>
                    <a href="{{ route('admin.prestasi.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-plus mr-2"></i>Tambah Prestasi
                    </a>
                </div>
            </div>

            <!-- Prestasi Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($prestasis as $prestasi)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Image -->
                    <div class="relative h-48" style="background: var(--gradient-secondary);">
                        @if($prestasi->image)
                            <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="{{ $prestasi->icon }} text-white text-6xl"></i>
                            </div>
                        @endif

                        <!-- Level Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-bold">
                                {{ ucfirst($prestasi->level) }}
                            </span>
                        </div>

                        <!-- Featured Badge -->
                        @if($prestasi->is_featured)
                        <div class="absolute top-3 left-3">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        </div>
                        @endif

                        <!-- Active/Inactive Badge -->
                        <div class="absolute bottom-3 left-3">
                            @if($prestasi->is_active)
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    <i class="fas fa-check mr-1"></i>Aktif
                                </span>
                            @else
                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    <i class="fas fa-times mr-1"></i>Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $prestasi->title }}</h3>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $prestasi->description }}</p>
                        
                        <!-- Details -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar mr-2"></i>
                                <span>Tahun: {{ $prestasi->year }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-tag mr-2"></i>
                                <span>Kategori: {{ ucfirst($prestasi->category) }}</span>
                            </div>
                            @if($prestasi->student_name)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-user mr-2"></i>
                                <span>Siswa: {{ $prestasi->student_name }}</span>
                            </div>
                            @endif
                            @if($prestasi->teacher_name)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>
                                <span>Guru: {{ $prestasi->teacher_name }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.prestasi.show', $prestasi) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.prestasi.edit', $prestasi) }}" class="text-green-600 hover:text-green-800 text-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.prestasi.destroy', $prestasi) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <span class="text-xs text-gray-500">{{ $prestasi->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-trophy text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Belum Ada Prestasi</h3>
                    <p class="text-gray-400 mb-6">Mulai tambahkan prestasi sekolah pertama</p>
                    <a href="{{ route('admin.prestasi.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-plus mr-2"></i>Tambah Prestasi Pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection
