@extends('layouts.app')

@section('title', 'Kelola Berita - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <style>
        /* Enhanced card look for Admin Berita */
        .berita-card {
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 10px 30px rgba(251, 146, 60, 0.08);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            backdrop-filter: saturate(120%);
            border-radius: 1rem;
        }
        .berita-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 50px rgba(251, 146, 60, 0.15);
            border-color: rgba(251, 146, 60, 0.18);
        }
        .chip {
            background: #EFF6FF !important;
            color: #1E40AF !important;
            border: 1px solid #DBEAFE !important;
        }
        .chip-orange {
            background: #FFF7ED !important;
            color: #C2410C !important;
            border: 1px solid #FED7AA !important;
        }
        .chip-green {
            background: #ECFDF5 !important;
            color: #065F46 !important;
            border: 1px solid #A7F3D0 !important;
        }
        .image-preview {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
    </style>
    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Berita</h1>
                        <p class="text-gray-600 mt-2">Kelola konten berita dan pengumuman sekolah</p>
                    </div>
                    <a href="{{ route('admin.berita.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center" style="background: linear-gradient(135deg, #FB923C 0%, #EA580C 100%); box-shadow: 0 4px 15px rgba(251, 146, 60, 0.3);">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Berita
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="berita-card bg-white p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full" style="background: rgba(251, 146, 60, 0.1);">
                            <i class="fas fa-newspaper text-2xl" style="color: #EA580C;"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Total Berita</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $beritas->total() }}</p>
                        </div>
                    </div>
                </div>
                <div class="berita-card bg-white p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full" style="background: rgba(34, 197, 94, 0.1);">
                            <i class="fas fa-check-circle text-2xl" style="color: #16A34A;"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Aktif</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Berita::where('is_active', true)->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="berita-card bg-white p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full" style="background: rgba(239, 68, 68, 0.1);">
                            <i class="fas fa-pause-circle text-2xl" style="color: #DC2626;"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Tidak Aktif</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Berita::where('is_active', false)->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="berita-card bg-white p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full" style="background: rgba(59, 130, 246, 0.1);">
                            <i class="fas fa-calendar text-2xl" style="color: #2563EB;"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Bulan Ini</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Berita::whereMonth('published_at', now()->month)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <form action="{{ route('admin.berita.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari berita..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="flex gap-2">
                        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <button type="submit" class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-redo mr-2"></i>Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Berita Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($beritas as $berita)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($berita->image)
                                        <img src="{{ asset('images/' . $berita->image) }}" alt="{{ $berita->title }}" class="image-preview">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-newspaper text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $berita->title }}</div>
                                    <div class="text-sm text-gray-500 max-w-xs truncate">{{ $berita->excerpt }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $berita->author }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $berita->formatted_date }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($berita->is_active)
                                        <span class="chip-green px-2 py-1 text-xs rounded-full">Aktif</span>
                                    @else
                                        <span class="chip-orange px-2 py-1 text-xs rounded-full">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.berita.show', $berita->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-green-600 hover:text-green-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.toggle-active', $berita->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-{{ $berita->is_active ? 'yellow' : 'green' }}-600 hover:text-{{ $berita->is_active ? 'yellow' : 'green' }}-900" title="{{ $berita->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="fas fa-{{ $berita->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <i class="fas fa-newspaper text-4xl mb-4"></i>
                                        <p>Belum ada data berita</p>
                                        <a href="{{ route('admin.berita.create') }}" class="text-orange-600 hover:text-orange-700 mt-2 inline-block">
                                            Tambah berita pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($beritas->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $beritas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
