<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $gallery->title }} - SMKN 4 Bogor</title>
    
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
        
        /* Gallery Detail */
        .gallery-detail-image {
            max-height: 70vh;
            width: 100%;
            object-fit: contain;
            background: #000;
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
                    <a href="{{ route('jurusan.index') }}" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">JURUSAN</a>
                    <div class="relative group">
                        <button class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200 flex items-center">
                            PROFIL
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block z-50">
                            <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Fasilitas</a>
                            <a href="{{ route('profil.prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Prestasi</a>
                        </div>
                    </div>
                    
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="font-medium">Kembali ke Galeri</span>
                </a>
            </div>

            <!-- Gallery Detail Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Image -->
                <div class="bg-black">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         class="gallery-detail-image mx-auto" 
                         alt="{{ $gallery->title }}"
                         onerror="this.src='{{ asset('images/logok4.png') }}'">
                </div>

                <!-- Content -->
                <div class="p-6 md:p-8">
                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $gallery->title }}</h1>
                    
                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-6 pb-6 border-b">
                        @if($gallery->event_date)
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day mr-2 text-blue-600"></i>
                            <span>{{ $gallery->event_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        
                        @if($gallery->location)
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
                            <span>{{ $gallery->location }}</span>
                        </div>
                        @endif
                        
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-2 text-gray-600"></i>
                            <span>{{ $gallery->views ?? 0 }} views</span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-user mr-2 text-green-600"></i>
                            <span>{{ $gallery->user->name ?? 'Admin' }}</span>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    @if($gallery->description)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Deskripsi</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $gallery->description }}</p>
                    </div>
                    @endif
                    
                    <!-- Category -->
                    @if($gallery->category)
                    <div class="mb-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-tag mr-2"></i>
                            {{ $gallery->category->name }}
                        </span>
                    </div>
                    @endif
                    
                    <!-- Like, Dislike, Comment Section -->
                    <div class="border-t border-b py-6 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <!-- Like Button -->
                                @auth
                                <button onclick="handleLike({{ $gallery->id }})" 
                                        id="like-btn"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span id="like-count">{{ $gallery->likes->count() ?? 0 }}</span>
                                </button>
                                
                                <!-- Dislike Button -->
                                <button onclick="handleDislike({{ $gallery->id }})" 
                                        id="dislike-btn"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-red-500 text-red-500 hover:bg-red-50 transition">
                                    <i class="fas fa-thumbs-down"></i>
                                    <span id="dislike-count">{{ $gallery->dislikes->count() ?? 0 }}</span>
                                </button>
                                @else
                                <button onclick="showLoginAlert()" 
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-gray-300 text-gray-500 hover:bg-gray-50 transition">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>{{ $gallery->likes->count() ?? 0 }}</span>
                                </button>
                                
                                <button onclick="showLoginAlert()" 
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-gray-300 text-gray-500 hover:bg-gray-50 transition">
                                    <i class="fas fa-thumbs-down"></i>
                                    <span>{{ $gallery->dislikes->count() ?? 0 }}</span>
                                </button>
                                @endauth
                            </div>
                            
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-comment"></i>
                                <span id="comment-count">{{ $gallery->comments->count() ?? 0 }}</span>
                                <span>Komentar</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comments Section -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            <i class="fas fa-comments mr-2 text-blue-600"></i>
                            Komentar
                        </h2>
                        
                        <!-- Comment Form -->
                        @auth
                        <div class="bg-gray-50 rounded-lg p-6 mb-6 border border-gray-200">
                            <form action="{{ route('comment.store', $gallery->id) }}" method="POST" id="comment-form">
                                @csrf
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tulis Komentar Anda
                                    </label>
                                    <textarea name="content" 
                                              id="content" 
                                              rows="4" 
                                              required
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                              placeholder="Bagikan pendapat Anda..."></textarea>
                                </div>
                                <button type="submit" 
                                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>Kirim Komentar</span>
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-info-circle text-yellow-600 text-2xl"></i>
                                <div>
                                    <p class="text-gray-700 font-medium mb-2">Silakan login untuk berkomentar</p>
                                    <a href="{{ route('user.login') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        Login Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endauth
                        
                        <!-- Comments List -->
                        <div id="comments-list">
                            @forelse($gallery->comments as $comment)
                            <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border border-gray-200">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                            {{ strtoupper(substr($comment->author_name ?? $comment->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $comment->author_name ?? $comment->user->name ?? 'User' }}</h4>
                                                <p class="text-sm text-gray-500 flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            @auth
                                            @if(auth()->user()->is_admin || auth()->id() == $comment->user_id)
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-1 rounded-full border border-red-600 hover:bg-red-50 transition">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @endauth
                                        </div>
                                        <p class="text-gray-700">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-12 bg-gray-50 rounded-lg">
                                <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- Admin Actions -->
                    @auth
                    @if(\App\Helpers\AdminHelper::isCurrentUserSuperAdmin())
                    <div class="flex gap-3 pt-6 border-t">
                        <a href="{{ route('gallery.edit', $gallery->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>
                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus galeri ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Related Images (if any) -->
            @if($gallery->category)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Galeri Lainnya</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @php
                        $relatedGalleries = \App\Models\Gallery::where('category_id', $gallery->category_id)
                            ->where('id', '!=', $gallery->id)
                            ->where(function($query) {
                                $query->where('is_active', true)
                                      ->orWhereNull('is_active');
                            })
                            ->latest()
                            ->take(4)
                            ->get();
                    @endphp
                    
                    @foreach($relatedGalleries as $related)
                    <a href="{{ route('gallery.show', $related->id) }}" 
                       class="group relative aspect-square rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                        <img src="{{ asset('storage/'.$related->image) }}" 
                             alt="{{ $related->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                             onerror="this.src='{{ asset('images/logok4.png') }}'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <p class="text-white font-medium text-sm">{{ $related->title }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2024 SMKN 4 Bogor. All rights reserved.</p>
            </div>
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
        
        // Show login alert for non-authenticated users
        function showLoginAlert() {
            if (confirm('Anda harus login terlebih dahulu untuk memberikan like/dislike. Login sekarang?')) {
                window.location.href = '{{ route("user.login") }}';
            }
        }
        
        // Handle Like
        function handleLike(galleryId) {
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
                    document.getElementById('like-count').textContent = data.likes_count;
                    document.getElementById('dislike-count').textContent = data.dislikes_count;
                    
                    // Update button styles
                    const likeBtn = document.getElementById('like-btn');
                    const dislikeBtn = document.getElementById('dislike-btn');
                    
                    if (data.is_liked) {
                        likeBtn.classList.add('bg-blue-100');
                        dislikeBtn.classList.remove('bg-red-100');
                    } else {
                        likeBtn.classList.remove('bg-blue-100');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }
        
        // Handle Dislike
        function handleDislike(galleryId) {
            fetch(`/gallery/${galleryId}/dislike`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('like-count').textContent = data.likes_count;
                    document.getElementById('dislike-count').textContent = data.dislikes_count;
                    
                    // Update button styles
                    const likeBtn = document.getElementById('like-btn');
                    const dislikeBtn = document.getElementById('dislike-btn');
                    
                    if (data.is_disliked) {
                        dislikeBtn.classList.add('bg-red-100');
                        likeBtn.classList.remove('bg-blue-100');
                    } else {
                        dislikeBtn.classList.remove('bg-red-100');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }
    </script>
</body>
</html>
