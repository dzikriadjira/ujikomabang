@extends('layouts.app')

@section('title', 'Kelola Jurusan - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <style>
        /* Enhanced card look for Admin Jurusan */
        .jurusan-card {
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.08);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            backdrop-filter: saturate(120%);
            border-radius: 1rem;
        }
        .jurusan-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 50px rgba(2, 132, 199, 0.15);
            border-color: rgba(2, 132, 199, 0.18);
        }
        .chip {
            background: #EFF6FF !important;
            color: #1E40AF !important;
            border: 1px solid #DBEAFE !important;
        }
        .chip-green {
            background: #ECFDF5 !important;
            color: #065F46 !important;
            border: 1px solid #A7F3D0 !important;
        }
    </style>
    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Jurusan</h1>
                        <p class="text-gray-600 mt-2">Kelola data jurusan sekolah</p>
                    </div>
                    <a href="{{ route('admin.jurusan.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Jurusan
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Jurusan Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($jurusans as $jurusan)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200 jurusan-card">
                    <!-- Image -->
                    <div class="relative h-48 bg-gray-200">
                        @if($jurusan->image)
                            <img src="{{ asset($jurusan->image) }}" alt="{{ $jurusan->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="{{ $jurusan->icon }} text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <!-- Featured Badge -->
                        @if($jurusan->is_featured)
                            <div class="absolute top-3 right-3">
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    <i class="fas fa-star mr-1"></i>Featured
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $jurusan->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $jurusan->full_name }}</p>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $jurusan->description }}</p>
                        
                        <!-- Competencies -->
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-gray-800 mb-2">Kompetensi:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($jurusan->competencies as $competency)
                                    <span class="px-3 py-1 rounded-full text-sm chip">{{ $competency }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.jurusan.show', $jurusan) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.jurusan.edit', $jurusan) }}" class="text-green-600 hover:text-green-800 text-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.jurusan.destroy', $jurusan) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <span class="text-xs text-gray-500">Order: {{ $jurusan->sort_order }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-graduation-cap text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada jurusan</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan jurusan pertama Anda</p>
                    <a href="{{ route('admin.jurusan.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 inline-flex items-center" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Jurusan
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">SMKN 4 Bogor</h3>
                    <p class="text-gray-400 text-sm">
                        Sekolah menengah kejuruan yang berfokus pada teknologi dan inovasi untuk masa depan yang lebih baik.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-sm text-gray-400">
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Raya Tajur No. 123, Bogor</p>
                        <p><i class="fas fa-phone mr-2"></i>(0251) 123 456</p>
                        <p><i class="fas fa-envelope mr-2"></i>info@smkn4bogor.sch.id</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors duration-200"
                           title="Facebook SMKN 4 Bogor">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors duration-200"
                           title="Instagram SMKN 4 Bogor">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors duration-200"
                           title="YouTube SMKN 4 Bogor">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 SMKN 4 Bogor. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>
@endsection
