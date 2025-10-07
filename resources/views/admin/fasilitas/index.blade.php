@extends('layouts.app')

@section('title', 'Kelola Fasilitas - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Fasilitas</h1>
                        <p class="text-gray-600 mt-2">Kelola data fasilitas sekolah</p>
                    </div>
                    <a href="{{ route('admin.fasilitas.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Fasilitas
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Fasilitas Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($fasilitas as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                    <!-- Image -->
                    <div class="relative h-48 bg-gray-200">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="{{ $item->icon }} text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="text-white px-2 py-1 rounded-full text-xs font-bold" style="background: var(--primary-blue);">
                                {{ ucfirst($item->category) }}
                            </span>
                        </div>

                        <!-- Active/Inactive Badge -->
                        <div class="absolute top-3 left-3">
                            @if($item->is_active)
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
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->name }}</h3>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $item->description }}</p>
                        
                        <!-- Features -->
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-gray-800 mb-2">Fitur:</h4>
                            @php
                                // Pastikan features adalah array dan tidak kosong
                                $features = is_array($item->features) ? $item->features : [];
                                $features = array_filter($features); // Hapus nilai kosong
                            @endphp
                            
                            @if(!empty($features))
                                <div class="flex flex-wrap gap-1">
                                    @foreach($features as $feature)
                                        @if(!empty(trim($feature)))
                                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">{{ $feature }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-xs">Belum ada fitur</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.fasilitas.show', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.fasilitas.edit', $item) }}" class="text-green-600 hover:text-green-800 text-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.fasilitas.destroy', $item) }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <span class="text-xs text-gray-500">Order: {{ $item->sort_order }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-building text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada fasilitas</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan fasilitas pertama Anda</p>
                    <a href="{{ route('admin.fasilitas.create') }}" class="text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 inline-flex items-center" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Fasilitas
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

@push('scripts')
<script>
// Fungsi untuk menampilkan notifikasi
function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(notification);
    
    // Hapus notifikasi setelah 5 detik
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s ease';
        setTimeout(() => notification.remove(), 500);
    }, 5000);
}

// Tangani form hapus
document.addEventListener('DOMContentLoaded', function() {
    // Tangani klik tombol hapus
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn') || e.target.matches('.delete-btn i')) {
            e.preventDefault();
            
            const deleteBtn = e.target.closest('.delete-btn');
            const form = deleteBtn.closest('form');
            const card = deleteBtn.closest('.bg-white.rounded-lg');
            
            if (confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')) {
                // Tampilkan loading state
                const originalContent = deleteBtn.innerHTML;
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                
                // Buat form data
                const formData = new FormData();
                formData.append('_method', 'DELETE');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                
                // Kirim permintaan DELETE menggunakan fetch
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal menghapus fasilitas');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Delete successful:', data);
                    
                    // Animasi fade out
                    card.style.opacity = '0';
                    card.style.transition = 'opacity 0.3s ease';
                    
                    // Hapus card setelah animasi selesai
                    setTimeout(() => {
                        card.remove();
                        
                        // Tampilkan notifikasi sukses
                        showNotification('success', data.message || 'Fasilitas berhasil dihapus');
                        
                        // Periksa apakah tidak ada fasilitas lagi
                        const cards = document.querySelectorAll('.bg-white.rounded-lg');
                        if (cards.length === 0) {
                            window.location.reload();
                        }
                    }, 300);
                })
                .catch(error => {
                    console.error('Error:', error);
                    deleteBtn.disabled = false;
                    deleteBtn.innerHTML = originalContent;
                    showNotification('error', error.message || 'Terjadi kesalahan saat menghapus fasilitas');
                });
            }
        }
    });
});
</script>
@endpush
@endsection
