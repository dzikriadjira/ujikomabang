<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Galeri Sekolah SMKN 4 Bogor')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .nav-link {
            position: relative;
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
    </style>
    <!-- Blue Theme Overrides -->
    <style>
        :root {
            --primary-blue: #1E40AF;
            --primary-blue-light: #3B82F6;
            --primary-blue-dark: #1E3A8A;
            --secondary-blue: #60A5FA;
            --secondary-blue-light: #93C5FD;
            --accent-blue: #DBEAFE;
            --accent-blue-light: #EFF6FF;
            --gradient-primary: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            --gradient-secondary: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);
            --gradient-light: linear-gradient(135deg, #DBEAFE 0%, #93C5FD 100%);
        }

        /* Navbar blue styling */
        .nav-link::after {
            background: var(--gradient-primary) !important;
        }

        /* Icon utilities - blue theme */
        .icon-blue { color: var(--primary-blue) !important; }
        .icon-blue-soft { color: var(--secondary-blue-light) !important; }
        .icon-blue-accent { color: var(--accent-blue) !important; }
        .icon-blue:hover, .icon-blue-soft:hover, .icon-blue-accent:hover { filter: brightness(0.9); }

        /* Button styling - match global buttons */
        .bg-blue-600 { 
            background: var(--primary-blue-light) !important; 
            border: none !important;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3) !important;
        }
        .bg-blue-600:hover { 
            background: var(--primary-blue-dark) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.4) !important;
        }

        /* Navigation links */
        .hover\:text-cyan-600:hover { color: var(--primary-blue-dark) !important; }
        
        /* Footer blue styling */
        .bg-gray-900 { 
            background: var(--gradient-light) !important; 
            color: #374151 !important;
        }
        .bg-gray-900 .text-white { color: #374151 !important; }
        .bg-gray-900 .text-gray-400 { color: #6B7280 !important; }
        .bg-gray-900 .border-gray-800 { border-color: #D1D5DB !important; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="h-16 w-16 mr-4 shadow-lg rounded-xl overflow-hidden bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logok4.png') }}" alt="Logo SMKN 4 Bogor" class="h-full w-full object-contain p-1">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">SMK NEGRI 4</h1>
                        <p class="text-sm text-gray-600">KOTA BOGOR</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">BERANDA</a>
                    
                    <a href="{{ route('gallery.index') }}" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">GALLERY</a>
                    
                    <!-- Jurusan Dropdown -->
                    <div class="dropdown relative">
                        <button class="nav-link flex items-center text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">
                            JURUSAN <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200 hidden">
                            <a href="{{ route('jurusan.index', ['jurusan' => 'pplg']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">PPLG (Pengembangan Perangkat Lunak & Gim)</a>
                            <a href="{{ route('jurusan.index', ['jurusan' => 'otomotif']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Teknik Otomotif</a>
                            <a href="{{ route('jurusan.index', ['jurusan' => 'tpfl']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">TPFL (Teknik Pengelasan & Fabrikasi Logam)</a>
                            <a href="{{ route('jurusan.index', ['jurusan' => 'tjkt']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">TJKT (Teknik Jaringan Komputer & Telekomunikasi)</a>
                        </div>
                    </div>
                    
                    <!-- Profil Dropdown -->
                    <div class="dropdown relative">
                        <button class="nav-link flex items-center text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">
                            PROFIL <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200 hidden">
                            <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 transition-colors duration-200">
                                <i class="fas fa-building mr-2"></i>Fasilitas
                            </a>
                            <a href="{{ route('profil.prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 transition-colors duration-200">
                                <i class="fas fa-trophy mr-2"></i>Prestasi
                            </a>
                        </div>
                    </div>
                    
                    <!-- Admin Links (Hidden from public users) -->
                    @auth
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">DASHBOARD</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">LOGOUT</button>
                        </form>
                    </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-900 hover:text-cyan-600">
                        <i class="fas fa-bars text-xl"></i>
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

        @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
        @endif

@section('title', 'Galeri - Galeri Sekolah SMKN 4 Bogor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Galeri Sekolah</h1>
                <p class="mt-2 text-gray-600">Lihat koleksi foto kegiatan dan fasilitas sekolah</p>
                <p class="mt-1 text-sm text-blue-600 font-medium">SMKN 4 Bogor</p>
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

    <!-- Search and Filters -->
    <div class="bg-white shadow rounded-lg mb-8">
        <div class="p-6">
            <form action="{{ route('gallery.search') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="q" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                        <input type="text" name="q" id="q" value="{{ request('q') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Cari judul atau deskripsi...">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category" id="category" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search mr-2 text-white"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galleries->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($galleries as $gallery)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow duration-200">
            <div class="relative group">
                <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200" 
                     src="{{ url('storage/'.$gallery->image) }}" 
                     alt="{{ $gallery->title }}"
                     onerror="this.src='{{ asset('images/logok4.png') }}'; this.alt='Gambar tidak tersedia';">
                
                <!-- Featured Badge -->
                @if($gallery->is_featured)
                <div class="absolute top-2 right-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-star mr-1"></i>Unggulan
                    </span>
                </div>
                @endif

                <!-- Category Badge -->
                @if($gallery->category_id)
                <div class="absolute top-2 left-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white shadow-sm"
                          style="background-color: {{ $gallery->category->color }};">
                        {{ $gallery->category->name }}
                    </span>
                </div>
                @endif

                <!-- Click to view full size -->
                <div class="absolute inset-0 cursor-pointer" onclick="openImageModal('{{ url('storage/'.$gallery->image) }}', '{{ $gallery->title }}')" aria-label="Lihat foto full size"></div>
                
                <!-- Quick Actions Overlay (only for authenticated users) -->
                @auth
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center pointer-events-none">
                    <div class="flex space-x-2 pointer-events-auto">
                        <a href="{{ route('gallery.edit', $gallery) }}" 
                           class="p-2 bg-white rounded-full text-gray-800 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="deleteGallery({{ $gallery->id }})" 
                                class="p-2 bg-white rounded-full text-gray-800 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endauth
            </div>
            
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $gallery->title }}</h3>
                
                @if($gallery->description)
                <p class="text-sm text-gray-600 mb-3">{{ $gallery->description }}</p>
                @endif
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                    <span class="flex items-center">
                        <i class="fas fa-user mr-1"></i>
                        {{ $gallery->user->name }}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-eye mr-1"></i>
                        {{ $gallery->views }}
                    </span>
                </div>
                
                @if($gallery->location || $gallery->event_date)
                <div class="text-xs text-gray-500 space-y-1 mb-2">
                    @if($gallery->location)
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $gallery->location }}
                    </div>
                    @endif
                    @if($gallery->event_date)
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $gallery->event_date->format('d M Y') }}
                    </div>
                    @endif
                </div>
                @endif
                
                <div class="text-xs text-gray-400">
                        {{ $gallery->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $galleries->links() }}
    </div>
    @else
    <div class="text-center py-12">
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
</main>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-7xl max-h-full">
        <!-- Close Button -->
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <i class="fas fa-times text-3xl"></i>
        </button>
        
        <!-- Image -->
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        
        <!-- Image Info -->
        <div class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-70 text-white p-4 rounded-lg">
            <h3 id="modalTitle" class="text-xl font-bold mb-2"></h3>
            <p class="text-sm opacity-90">Klik di luar gambar atau tekan ESC untuk menutup</p>
        </div>
    </div>
</div>

<script>
// API Configuration
const API_BASE_URL = 'http://localhost:8000/api';
let authToken = localStorage.getItem('auth_token');

// Check if user is logged in via API (optional for public gallery)
function checkAuthStatus() {
    if (!authToken) {
        // No token found, but this is OK for public gallery viewing
        console.log('No auth token found - viewing as guest');
        return;
    }
    
    // Verify token is still valid (only if token exists)
    fetch(`${API_BASE_URL}/auth/profile`, {
        headers: {
            'Authorization': `Bearer ${authToken}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            // Token expired, remove it but don't redirect
            localStorage.removeItem('auth_token');
            console.log('Auth token expired - viewing as guest');
        }
    })
    .catch(error => {
        console.error('Auth check failed:', error);
        localStorage.removeItem('auth_token');
        console.log('Auth check failed - viewing as guest');
    });
}

// Note: Gallery loading and searching is now handled by Laravel controller
// The data is passed to the Blade template and rendered server-side

// Note: CRUD operations are now handled by Laravel web routes
// Create, Update, Delete operations use standard form submissions

// Image Modal Functions
function openImageModal(imageSrc, imageTitle) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    
    modalImage.src = imageSrc;
    modalImage.alt = imageTitle;
    modalTitle.textContent = imageTitle;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close modal when clicking outside image
document.addEventListener('click', function(e) {
    const modal = document.getElementById('imageModal');
    if (e.target === modal) {
        closeImageModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

function showToast(message, type = 'info') {
    // Simple toast implementation
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Check authentication (optional for public viewing)
    checkAuthStatus();
    
    // Initialize dropdown menus
    initializeDropdowns();
    
// Note: Galleries are loaded from Laravel controller, not from API
// The data is already available in the Blade template
});

// Initialize dropdown functionality
function initializeDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
        
        // Toggle dropdown on button click
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Close all other dropdowns
            dropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown) {
                    otherDropdown.querySelector('.dropdown-menu').classList.add('hidden');
                }
            });
            
            // Toggle current dropdown
            menu.classList.toggle('hidden');
        });
    });
}

// Delete gallery function (uses standard form submission)
function deleteGallery(galleryId) {
    if (confirm('Apakah Anda yakin ingin menghapus galeri ini?')) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/gallery/${galleryId}`;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        // Add method override for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

</body>
</html>
