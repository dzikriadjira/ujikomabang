<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri - SMKN 4 Bogor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Navigation */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #06b6d4;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1rem 0;
        }
        
        .gallery-item {
            position: relative;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            aspect-ratio: 1;
        }
        
        .gallery-item:hover {
            transform: translateY(-4px);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        /* Gallery Action Buttons */
        .gallery-actions {
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 20;
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .action-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            background: rgba(0, 0, 0, 0.7);
        }
        
        .action-btn i {
            font-size: 18px;
        }
        
        .action-btn.active-love i {
            color: #ef4444 !important;
        }
        
        .action-btn.active-save i {
            color: #3b82f6 !important;
        }
        
        
        /* Dropdown */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease-in-out;
        }
        
        .dropdown-menu:not(.hidden) {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        /* Mobile menu */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        #mobile-menu:not(.hidden) {
            max-height: 800px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="h-12 w-12 sm:h-16 sm:w-16 mr-3 sm:mr-4 shadow-lg rounded-xl overflow-hidden bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logok4.png') }}" alt="Logo SMKN 4 Bogor" class="h-full w-full object-contain p-1">
                    </div>
                    <div>
                        <h1 class="text-lg sm:text-2xl font-bold text-gray-900">SMK NEGRI 4</h1>
                        <p class="text-xs sm:text-sm text-gray-600">KOTA BOGOR</p>
                    </div>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">BERANDA</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">DASHBOARD</a>
                        @endif
                    @endauth
                    <a href="{{ route('gallery.index') }}" class="nav-link text-blue-600 font-medium transition-colors duration-200 border-b-2 border-blue-600">GALLERY</a>
                    <a href="#" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">JURUSAN</a>
                    <a href="#" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">PROFIL</a>
                    
                    @auth
                    <div class="flex items-center gap-3 ml-4 pl-4 border-l border-gray-300">
                        <span class="text-gray-700">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="flex items-center gap-3 ml-4 pl-4 border-l border-gray-300">
                        <a href="{{ route('user.login') }}" class="inline-flex items-center px-5 py-2.5 bg-cyan-600 text-white rounded-full font-medium hover:bg-cyan-700 transition shadow-md hover:shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('user.register') }}" class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white rounded-full font-medium hover:bg-green-700 transition shadow-md hover:shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-900 hover:text-cyan-600 p-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-6">
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl font-bold text-gray-900">Galeri Sekolah</h1>
                        <p class="mt-2 text-gray-600">Koleksi foto kegiatan dan momen berharga di SMKN 4 Bogor</p>
                    </div>
                    @auth
                    @if(\App\Helpers\AdminHelper::isCurrentUserSuperAdmin())
                    <a href="{{ route('gallery.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Galeri
                    </a>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <form action="{{ route('gallery.search') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Search Input -->
                        <div class="md:col-span-2">
                            <label for="q" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-search mr-2"></i>Cari Galeri
                            </label>
                            <input type="text" 
                                   name="q" 
                                   id="q" 
                                   value="{{ request('q') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Cari berdasarkan judul atau deskripsi...">
                        </div>
                        
                        <!-- Category Filter -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tag mr-2"></i>Kategori
                            </label>
                            <select name="category" 
                                    id="category" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        <a href="{{ route('gallery.index') }}" 
                           class="inline-flex items-center px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-redo mr-2"></i>
                            Reset
                        </a>
                    </div>
                    
                    <!-- Search Results Info -->
                    @if(request('q') || request('category'))
                    <div class="pt-4 border-t">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>
                            Menampilkan hasil untuk:
                            @if(request('q'))
                                <span class="font-semibold">"{{ request('q') }}"</span>
                            @endif
                            @if(request('category'))
                                @php
                                    $selectedCat = $categories->firstWhere('id', request('category'));
                                @endphp
                                @if($selectedCat)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                        {{ $selectedCat->name }}
                                    </span>
                                @endif
                            @endif
                            <span class="ml-2">({{ $galleries->total() }} hasil)</span>
                        </p>
                    </div>
                    @endif
                </form>
            </div>

            <!-- Gallery Content -->
            @if($galleries->count() > 0)
                <div class="gallery-grid">
                    @foreach($galleries as $gallery)
                    <div class="gallery-item" style="position: relative;">
                        <a href="{{ route('gallery.show', $gallery->id) }}" style="display: block; width: 100%; height: 100%;">
                            <img src="{{ asset('storage/'.$gallery->image) }}" 
                                 alt="{{ $gallery->title }}"
                                 onerror="this.src='{{ asset('images/logok4.png') }}'">
                            
                            <!-- Category Badge -->
                            @if($gallery->category)
                            <div class="absolute top-2 right-2 z-10">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-600 text-white shadow-lg">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $gallery->category->name }}
                                </span>
                            </div>
                            @endif
                            
                            <div class="gallery-overlay">
                                <div class="font-medium">{{ $gallery->title }}</div>
                                @if($gallery->event_date || $gallery->location)
                                <div class="text-sm mt-1">
                                    @if($gallery->event_date)
                                    <div><i class="fas fa-calendar-day mr-1"></i> {{ $gallery->event_date->format('d M Y') }}</div>
                                    @endif
                                    @if($gallery->location)
                                    <div><i class="fas fa-map-marker-alt mr-1"></i> {{ $gallery->location }}</div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </a>
                        
                        <!-- Action Buttons -->
                        <div class="gallery-actions">
                            @auth
                            <button class="action-btn" onclick="handleDirectLike(event, {{ $gallery->id }})" title="Like" id="love-btn-{{ $gallery->id }}">
                                <i class="far fa-heart text-white"></i>
                            </button>
                            <button class="action-btn" onclick="handleDirectSave(event, {{ $gallery->id }})" title="Simpan" id="save-btn-{{ $gallery->id }}">
                                <i class="far fa-bookmark text-white"></i>
                            </button>
                            @else
                            <button class="action-btn" onclick="showLoginAlert(event)" title="Like">
                                <i class="far fa-heart text-white"></i>
                            </button>
                            <button class="action-btn" onclick="showLoginAlert(event)" title="Simpan">
                                <i class="far fa-bookmark text-white"></i>
                            </button>
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $galleries->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-images text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada galeri</h3>
                    <p class="text-gray-500 mb-6">Galeri akan tampil di sini saat admin menambahkannya.</p>
                    @auth
                    @if(\App\Helpers\AdminHelper::isCurrentUserSuperAdmin())
                    <a href="{{ route('gallery.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Galeri Pertama
                    </a>
                    @endif
                    @endauth
                </div>
            @endif
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Footer content here -->
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
        });
        
        // Show login alert
        function showLoginAlert(event) {
            event.preventDefault();
            event.stopPropagation();
            
            if (confirm('Anda harus login terlebih dahulu. Login sekarang?')) {
                window.location.href = '{{ route("user.login") }}';
            }
        }
        
        // Handle direct like (no menu)
        function handleDirectLike(event, galleryId) {
            event.preventDefault();
            event.stopPropagation();
            
            fetch(`/gallery/${galleryId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update love button
                    const loveBtn = document.getElementById('love-btn-' + galleryId);
                    const loveIcon = loveBtn.querySelector('i');
                    
                    if (data.is_liked) {
                        loveBtn.classList.add('active-love');
                        loveIcon.classList.remove('far');
                        loveIcon.classList.add('fas');
                        showToast('Liked!', 'success');
                    } else {
                        loveBtn.classList.remove('active-love');
                        loveIcon.classList.remove('fas');
                        loveIcon.classList.add('far');
                        showToast('Like removed', 'success');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan', 'error');
            });
        }
        
        // Handle direct save (no menu)
        function handleDirectSave(event, galleryId) {
            event.preventDefault();
            event.stopPropagation();
            
            // Update save button
            const saveBtn = document.getElementById('save-btn-' + galleryId);
            const saveIcon = saveBtn.querySelector('i');
            
            // Toggle saved state
            if (saveBtn.classList.contains('active-save')) {
                saveBtn.classList.remove('active-save');
                saveIcon.classList.remove('fas');
                saveIcon.classList.add('far');
                showToast('Dihapus dari simpanan', 'success');
            } else {
                saveBtn.classList.add('active-save');
                saveIcon.classList.remove('far');
                saveIcon.classList.add('fas');
                showToast('Disimpan!', 'success');
            }
        }
        
        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 2000);
        }
    </script>
</body>
</html>
