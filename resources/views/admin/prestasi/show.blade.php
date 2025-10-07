@extends('layouts.app')

@section('title', 'Detail Prestasi - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logok4.png') }}" alt="SMKN 4 Bogor" class="h-10 w-10">
                        <span class="text-xl font-bold text-gray-900">SMKN 4 Bogor</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-gray-500 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.prestasi.index') }}" class="text-blue-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-trophy mr-2"></i>Prestasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Prestasi</h1>
                        <p class="text-gray-600 mt-2">Informasi lengkap tentang prestasi sekolah</p>
                    </div>
                    <a href="{{ route('admin.prestasi.index') }}" class="text-gray-600 hover:text-gray-800 transition-colors duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Prestasi Detail Card -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                <!-- Image Section -->
                <div class="relative h-64" style="background: var(--gradient-secondary);">
                    @if($prestasi->image)
                        <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="{{ $prestasi->icon }} text-white text-6xl"></i>
                        </div>
                    @endif
                    
                    <!-- Status Badges -->
                    <div class="absolute top-4 left-4 flex flex-col space-y-2">
                        @if($prestasi->is_active)
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                <i class="fas fa-check mr-1"></i>Aktif
                            </span>
                        @else
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                <i class="fas fa-times mr-1"></i>Nonaktif
                            </span>
                        @endif
                        @if($prestasi->is_featured)
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        @endif
                    </div>

                    <!-- Level Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-sm font-bold">
                            {{ ucfirst($prestasi->level) }}
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    <!-- Title and Description -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $prestasi->title }}</h2>
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $prestasi->description }}</p>
                    </div>

                    <!-- Achievement Details -->
                    @if($prestasi->achievement_details)
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-2"></i>Detail Pencapaian
                        </h3>
                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-gray-800">{{ $prestasi->achievement_details }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="text-lg font-semibold text-blue-900 mb-3">
                                <i class="fas fa-info-circle mr-2"></i>Informasi Prestasi
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Kategori:</span>
                                    <span class="text-blue-900 font-medium">{{ ucfirst($prestasi->category) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Level:</span>
                                    <span class="text-blue-900 font-medium">{{ ucfirst($prestasi->level) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Tahun:</span>
                                    <span class="text-blue-900 font-medium">{{ $prestasi->year }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Status:</span>
                                    <span class="text-blue-900 font-medium">
                                        {{ $prestasi->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="text-lg font-semibold text-green-900 mb-3">
                                <i class="fas fa-users mr-2"></i>Informasi Peserta
                            </h4>
                            <div class="space-y-2 text-sm">
                                @if($prestasi->student_name)
                                <div class="flex justify-between">
                                    <span class="text-green-700">Siswa:</span>
                                    <span class="text-green-900 font-medium">{{ $prestasi->student_name }}</span>
                                </div>
                                @endif
                                @if($prestasi->teacher_name)
                                <div class="flex justify-between">
                                    <span class="text-green-700">Guru:</span>
                                    <span class="text-green-900 font-medium">{{ $prestasi->teacher_name }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-green-700">Urutan:</span>
                                    <span class="text-green-900 font-medium">{{ $prestasi->sort_order }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-3">
                            <i class="fas fa-calendar mr-2"></i>Informasi Sistem
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibuat:</span>
                                <span class="text-gray-900 font-medium">{{ $prestasi->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diupdate:</span>
                                <span class="text-gray-900 font-medium">{{ $prestasi->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID:</span>
                                <span class="text-gray-900 font-medium">{{ $prestasi->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Warna:</span>
                                <span class="text-gray-900 font-medium">{{ ucfirst($prestasi->color) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.prestasi.edit', $prestasi) }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Prestasi
                            </a>
                            <form method="POST" action="{{ route('admin.prestasi.destroy', $prestasi) }}" class="inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Prestasi
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('admin.prestasi.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Lihat Semua Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
