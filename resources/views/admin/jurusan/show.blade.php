@extends('layouts.app')

@section('title', 'Detail Jurusan - SMKN 4 Bogor')

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
                    <a href="{{ route('admin.jurusan.index') }}" class="text-blue-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-graduation-cap mr-2"></i>Jurusan
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
                        <h1 class="text-3xl font-bold text-gray-900">Detail Jurusan</h1>
                        <p class="text-gray-600 mt-2">Informasi lengkap tentang jurusan sekolah</p>
                    </div>
                    <a href="{{ route('admin.jurusan.index') }}" class="text-gray-600 hover:text-gray-800 transition-colors duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Jurusan Detail Card -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                <!-- Image Section -->
                <div class="relative h-64 bg-gray-200">
                    @if($jurusan->image_url)
                        <img src="{{ asset($jurusan->image_url) }}" alt="{{ $jurusan->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="{{ $jurusan->icon }} text-6xl text-gray-400"></i>
                        </div>
                    @endif
                    
                    <!-- Featured Badge -->
                    @if($jurusan->is_featured)
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            <i class="fas fa-star mr-1"></i>Featured
                        </span>
                    </div>
                    @endif

                    <!-- Color Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="text-white px-3 py-1 rounded-full text-sm font-bold" style="background-color: {{ $jurusan->color }};">
                            {{ ucfirst($jurusan->name) }}
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    <!-- Title and Description -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $jurusan->full_name }}</h2>
                        <p class="text-lg text-gray-600 mb-4">{{ $jurusan->name }}</p>
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $jurusan->description }}</p>
                    </div>

                    <!-- Competencies Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-cogs mr-2"></i>Kompetensi Keahlian
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($jurusan->competencies as $competency)
                                <div class="flex items-center bg-blue-50 rounded-lg p-3">
                                    <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                    <span class="text-gray-800">{{ $competency }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Career Prospects Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-briefcase mr-2"></i>Prospek Karir
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($jurusan->careers as $career)
                                <div class="flex items-center bg-green-50 rounded-lg p-3">
                                    <i class="fas fa-arrow-right text-green-500 mr-3"></i>
                                    <span class="text-gray-800">{{ $career }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="text-lg font-semibold text-blue-900 mb-3">
                                <i class="fas fa-info-circle mr-2"></i>Informasi Jurusan
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Nama Singkat:</span>
                                    <span class="text-blue-900 font-medium">{{ $jurusan->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Nama Lengkap:</span>
                                    <span class="text-blue-900 font-medium">{{ $jurusan->full_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Warna:</span>
                                    <span class="text-blue-900 font-medium">{{ ucfirst($jurusan->color) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Urutan:</span>
                                    <span class="text-blue-900 font-medium">{{ $jurusan->sort_order }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="text-lg font-semibold text-green-900 mb-3">
                                <i class="fas fa-calendar mr-2"></i>Informasi Sistem
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-green-700">Dibuat:</span>
                                    <span class="text-green-900 font-medium">{{ $jurusan->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-green-700">Diupdate:</span>
                                    <span class="text-green-900 font-medium">{{ $jurusan->updated_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-green-700">ID:</span>
                                    <span class="text-green-900 font-medium">{{ $jurusan->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-green-700">Status:</span>
                                    <span class="text-green-900 font-medium">
                                        {{ $jurusan->is_featured ? 'Featured' : 'Normal' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.jurusan.edit', $jurusan) }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Jurusan
                            </a>
                            <form method="POST" action="{{ route('admin.jurusan.destroy', $jurusan) }}" class="inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Jurusan
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('admin.jurusan.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Lihat Semua Jurusan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
