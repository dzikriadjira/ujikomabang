@extends('layouts.app')

@section('title', 'Tambah Berita - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <style>
        .form-container {
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
        .form-input {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        .form-input:focus {
            border-color: #FB923C;
            box-shadow: 0 0 0 3px rgba(251, 146, 60, 0.1);
        }
        .image-preview-container {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }
        .image-preview-container:hover {
            border-color: #FB923C;
            background-color: #FFF7ED;
        }
    </style>
    <main class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Berita Baru</h1>
                        <p class="text-gray-600 mt-2">Buat dan publikasikan berita sekolah</p>
                    </div>
                    <a href="{{ route('admin.berita.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container bg-white p-8">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Judul Berita -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Berita <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       required
                                       class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
                                       placeholder="Masukkan judul berita yang menarik"
                                       value="{{ old('title') }}">
                            </div>

                            <!-- Konten Berita -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                    Konten Berita <span class="text-red-500">*</span>
                                </label>
                                <textarea id="content" 
                                          name="content" 
                                          required
                                          rows="12"
                                          class="form-input w-full px-4 py-3 rounded-lg focus:outline-none resize-vertical"
                                          placeholder="Tulis konten berita secara lengkap...">{{ old('content') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">
                                    Anda dapat menggunakan format teks biasa. HTML akan di-render secara otomatis.
                                </p>
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ringkasan (Opsional)
                                </label>
                                <textarea id="excerpt" 
                                          name="excerpt" 
                                          rows="3"
                                          class="form-input w-full px-4 py-3 rounded-lg focus:outline-none resize-vertical"
                                          placeholder="Ringkasan singkat berita (maks 200 karakter)">{{ old('excerpt') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">
                                    Jika dikosongkan, ringkasan akan dibuat otomatis dari konten.
                                </p>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Gambar Utama -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Gambar Utama
                                </label>
                                <div class="image-preview-container rounded-lg p-6 text-center">
                                    <input type="file" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*"
                                           class="hidden"
                                           onchange="previewImage(event)">
                                    
                                    <div id="imagePreview" class="mb-4">
                                        <i class="fas fa-image text-4xl text-gray-400"></i>
                                        <p class="text-gray-500 mt-2">Klik untuk upload gambar</p>
                                    </div>
                                    
                                    <button type="button" 
                                            onclick="document.getElementById('image').click()"
                                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                                        <i class="fas fa-upload mr-2"></i>Pilih Gambar
                                    </button>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">
                                    Format: JPEG, PNG, JPG, GIF, WebP (Maks 2MB)
                                </p>
                            </div>

                            <!-- Informasi Publikasi -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="font-medium text-gray-900 mb-4">Informasi Publikasi</h3>
                                
                                <!-- Penulis -->
                                <div class="mb-4">
                                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                        Penulis
                                    </label>
                                    <input type="text" 
                                           id="author" 
                                           name="author"
                                           class="form-input w-full px-4 py-2 rounded-lg focus:outline-none text-sm"
                                           placeholder="Nama penulis"
                                           value="{{ old('author', auth()->user()->name) }}">
                                </div>

                                <!-- Tanggal Publikasi -->
                                <div class="mb-4">
                                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Publikasi
                                    </label>
                                    <input type="datetime-local" 
                                           id="published_at" 
                                           name="published_at"
                                           class="form-input w-full px-4 py-2 rounded-lg focus:outline-none text-sm"
                                           value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                                </div>

                                <!-- Status Aktif -->
                                <div>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               checked
                                               class="mr-2 rounded text-orange-600 focus:ring-orange-500">
                                        <span class="text-sm text-gray-700">Publikasikan sekarang</span>
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Uncheck jika ingin menyimpan sebagai draft
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <button type="submit" class="btn-primary flex-1 text-white px-6 py-3 rounded-lg font-medium">
                                    <i class="fas fa-save mr-2"></i>Simpan Berita
                                </button>
                                <a href="{{ route('admin.berita.index') }}" 
                                   class="flex-1 text-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" class="w-full h-48 object-cover rounded-lg mb-4">
                <p class="text-green-600 text-sm">
                    <i class="fas fa-check-circle mr-1"></i>${file.name}
                </p>
                <button type="button" 
                        onclick="document.getElementById('image').value=''; previewImage({target: {files: []}})"
                        class="text-red-600 text-sm hover:text-red-700">
                    <i class="fas fa-trash mr-1"></i>Hapus gambar
                </button>
            `;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <i class="fas fa-image text-4xl text-gray-400"></i>
            <p class="text-gray-500 mt-2">Klik untuk upload gambar</p>
        `;
    }
}
</script>
@endsection
