@extends('layouts.app')

@section('title', 'Detail Berita - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <style>
        .detail-container {
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 10px 30px rgba(251, 146, 60, 0.08);
            border-radius: 1rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #FB923C 0%, #EA580C 100%);
            box-shadow: 0 4px 15px rgba(251, 146, 60, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(251, 146, 60, 0.4);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-active {
            background-color: #D1FAE5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }
        .status-inactive {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }
        .meta-info {
            background: linear-gradient(135deg, #FFF7ED 0%, #FED7AA 100%);
            border: 1px solid #FED7AA;
        }
        .content-box {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
        }
    </style>
    <main class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Berita</h1>
                        <p class="text-gray-600 mt-2">Lihat informasi lengkap berita</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.berita.edit', $berita->id) }}" 
                           class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                            <i class="fas fa-edit mr-2"></i>Edit Berita
                        </a>
                        <a href="{{ route('admin.berita.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Article Preview -->
                    <div class="detail-container bg-white overflow-hidden">
                        <!-- Header Image -->
                        @if($berita->image)
                        <div class="h-64 md:h-96 bg-gray-100">
                            <img src="{{ asset('images/' . $berita->image) }}" 
                                 alt="{{ $berita->title }}"
                                 class="w-full h-full object-cover">
                        </div>
                        @endif
                        
                        <!-- Article Content -->
                        <div class="p-8">
                            <!-- Title and Status -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $berita->title }}</h1>
                                    <div class="status-badge {{ $berita->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="fas fa-{{ $berita->is_active ? 'check' : 'pause' }}-circle mr-1"></i>
                                        {{ $berita->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </div>
                                </div>
                                
                                <!-- Meta Information -->
                                <div class="meta-info rounded-lg p-4 mb-6">
                                    <div class="flex flex-wrap items-center gap-4 text-sm">
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-user mr-2 text-orange-600"></i>
                                            <span>{{ $berita->author }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-calendar mr-2 text-orange-600"></i>
                                            <span>{{ $berita->formatted_date }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-clock mr-2 text-orange-600"></i>
                                            <span>Dibuat {{ $berita->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Excerpt -->
                                @if($berita->excerpt)
                                <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6">
                                    <p class="text-gray-700 italic">{{ $berita->excerpt }}</p>
                                </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="content-box p-6">
                                <div class="prose prose-lg max-w-none text-gray-700">
                                    {!! $berita->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="detail-container bg-white p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" 
                               class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-edit mr-2"></i>Edit Berita
                            </a>
                            
                            <form action="{{ route('admin.berita.toggle-active', $berita->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full px-4 py-2 {{ $berita->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition">
                                    <i class="fas fa-{{ $berita->is_active ? 'pause' : 'play' }} mr-2"></i>
                                    {{ $berita->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="w-full" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    <i class="fas fa-trash mr-2"></i>Hapus Berita
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="detail-container bg-white p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Statistik</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Status</span>
                                <span class="status-badge {{ $berita->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $berita->is_active ? 'Aktif' : 'Draft' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Dibuat</span>
                                <span class="text-sm text-gray-900">{{ $berita->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Diperbarui</span>
                                <span class="text-sm text-gray-900">{{ $berita->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Publikasi</span>
                                <span class="text-sm text-gray-900">{{ $berita->formatted_date }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Gambar</span>
                                <span class="text-sm text-gray-900">{{ $berita->image ? 'Ada' : 'Tidak ada' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Info -->
                    <div class="detail-container bg-white p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Info SEO</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm text-gray-600">Judul (Title)</label>
                                <p class="text-sm text-gray-900 font-medium truncate">{{ $berita->title }}</p>
                                <p class="text-xs text-gray-500">{{ strlen($berita->title) }} karakter</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Deskripsi (Meta Description)</label>
                                <p class="text-sm text-gray-900 truncate">{{ $berita->excerpt ?: substr(strip_tags($berita->content), 0, 160) }}</p>
                                <p class="text-xs text-gray-500">{{ strlen($berita->excerpt ?: substr(strip_tags($berita->content), 0, 160)) }} karakter</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">URL Slug</label>
                                <p class="text-sm text-gray-900 font-mono">{{ Str::slug($berita->title) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Public Link -->
                    <div class="detail-container bg-white p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Tautan Publik</h3>
                        <div class="space-y-3">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-600 mb-2">Link berita di halaman publik:</p>
                                <a href="{{ route('berita.show', $berita->id) }}" 
                                   target="_blank"
                                   class="text-sm text-blue-600 hover:text-blue-800 break-all">
                                    {{ route('berita.show', $berita->id) }}
                                </a>
                            </div>
                            <button onclick="window.open('{{ route('berita.show', $berita->id) }}', '_blank')" 
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-external-link-alt mr-2"></i>Buka di Tab Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
