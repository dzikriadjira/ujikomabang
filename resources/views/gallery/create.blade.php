@extends('layouts.app')

@section('title', 'Tambah Galeri - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <main class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Foto Galeri</h1>
                        <p class="text-gray-600 mt-2">Unggah foto kegiatan/fasilitas. Setelah tersimpan, foto akan tampil di halaman galeri publik.</p>
                    </div>
                    <a href="{{ route('gallery.index') }}" class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Galeri</h2>
                    <p class="text-sm text-gray-600 mt-1">Lengkapi form di bawah untuk menambah foto ke galeri</p>
                </div>
                <form id="galleryForm" class="p-6" enctype="multipart/form-data">
            @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-heading mr-2 text-blue-500"></i>Judul *
                            </label>
                            <input type="text" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="Masukkan judul foto" required>
                            <p data-error="title" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-tags mr-2 text-blue-500"></i>Kategori
                            </label>
                            <select name="category_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">Pilih Kategori (Opsional)</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <p data-error="category_id" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>Deskripsi
                            </label>
                            <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" placeholder="Deskripsi singkat tentang foto (opsional)"></textarea>
                            <p data-error="description" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>Lokasi
                            </label>
                            <input type="text" name="location" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="Contoh: Lapangan, Aula, Lab Komputer">
                            <p data-error="location" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-calendar mr-2 text-blue-500"></i>Tanggal Kegiatan
                            </label>
                            <input type="date" name="event_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <p data-error="event_date" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-image mr-2 text-blue-500"></i>Upload Gambar *
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                                <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-700 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors file:duration-200" required>
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF (Max: 2MB)</p>
                            </div>
                            <p data-error="image" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div class="md:col-span-2">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_featured" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-3">
                                    <div>
                                        <span class="text-sm font-semibold text-gray-800">Tandai sebagai foto unggulan</span>
                                        <p class="text-xs text-gray-600">Foto unggulan akan ditampilkan lebih menonjol di galeri</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Field bertanda * wajib diisi
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('gallery.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </a>
                                <button type="submit" id="submitBtn" class="inline-flex items-center px-6 py-3 rounded-lg text-white font-semibold disabled:opacity-60 transition-all duration-300 transform hover:scale-105 shadow-lg" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                                    <i class="fas fa-save mr-2"></i>Simpan Galeri
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
const form = document.getElementById('galleryForm');
const submitBtn = document.getElementById('submitBtn');

// Check authentication (using session-based auth)
function checkAuth() {
    // Since this page is protected by middleware, if we can access it, user is authenticated
    return true;
}

function showError(field, message){
    const el = document.querySelector(`[data-error="${field}"]`);
    if(el){ el.textContent = message || ''; el.classList.toggle('hidden', !message); }
}

function showSuccess(message) {
    // Create success toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 bg-green-500';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Check authentication
    if (!checkAuth()) return;
    
    submitBtn.disabled = true;
    [...form.querySelectorAll('[data-error]')].forEach(el => { el.textContent=''; el.classList.add('hidden'); });

    try {
        const formData = new FormData(form);
        
        // Send to web route (session-based auth)
        const res = await fetch('{{ route("gallery.store") }}', {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        });
        
        if(res.ok){
            const data = await res.json();
            if(data.success){
                showSuccess('Galeri berhasil dibuat!');
                setTimeout(() => {
                    window.location.href = '/gallery';
                }, 1500);
                return;
            } else {
                alert(data.message || 'Gagal membuat galeri');
            }
        }
        
        if(res.status === 422){
            const data = await res.json();
            const errors = data.errors || {};
            Object.keys(errors).forEach(k => showError(k, errors[k][0]));
        } else if(res.status === 401) {
            alert('Session expired. Silakan login ulang.');
            window.location.href = '/admin/login';
        } else {
            alert('Terjadi kesalahan saat menyimpan.');
        }
    } catch(err){
        console.error('Error:', err);
        alert('Gagal mengirim data ke API.');
    } finally {
        submitBtn.disabled = false;
    }
});

// Page is already protected by middleware, no need to check auth on load
</script>
@endpush
