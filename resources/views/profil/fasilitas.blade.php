<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas - SMKN 4 Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Animasi untuk tampilan fasilitas */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
            }
            50% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.8);
            }
        }
        
        .gradient-bg {
            background: #60A5FA;
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeInUp 0.6s ease-out;
        }
        
        .card-hover:nth-child(1) { animation-delay: 0.1s; }
        .card-hover:nth-child(2) { animation-delay: 0.2s; }
        .card-hover:nth-child(3) { animation-delay: 0.3s; }
        .card-hover:nth-child(4) { animation-delay: 0.4s; }
        .card-hover:nth-child(5) { animation-delay: 0.5s; }
        .card-hover:nth-child(6) { animation-delay: 0.6s; }
        
        .card-hover:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
            animation: glow 2s infinite;
        }
        
        .facility-image {
            transition: transform 0.5s ease;
            overflow: hidden;
        }
        
        .card-hover:hover .facility-image {
            transform: scale(1.15) rotate(2deg);
        }
        
        .facility-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }
        
        .card-hover:hover .facility-image::before {
            left: 100%;
        }
        
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        /* Animasi untuk badge */
        .facility-badge {
            animation: slideInLeft 0.5s ease-out;
            transition: all 0.3s ease;
        }
        
        .card-hover:hover .facility-badge {
            transform: scale(1.1) rotate(-5deg);
        }
        
        /* Animasi untuk content */
        .facility-content {
            animation: fadeInUp 0.8s ease-out;
            animation-delay: 0.3s;
            animation-fill-mode: both;
        }
        
        /* Animasi untuk features */
        .feature-tag {
            animation: fadeInUp 0.5s ease-out;
            transition: all 0.3s ease;
        }
        
        .feature-tag:hover {
            transform: translateY(-2px) scale(1.05);
            background: var(--gradient-primary) !important;
            color: white !important;
        }
        
        /* Animasi untuk header */
        .page-header {
            animation: slideInLeft 0.8s ease-out;
        }
        
        .header-title {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Loading shimmer effect */
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }
        
        /* Floating animation untuk icons */
        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Pulse animation untuk CTA buttons */
        .pulse-button {
            animation: pulse 2s infinite;
        }
        
        /* Primary light blue icon */
        .icon-primary { color: var(--primary-blue-light) !important; }
        
        /* Footer blue styling identical to Gallery */
        .bg-gray-900 { 
            background: var(--gradient-light) !important; 
            color: #374151 !important; 
        }
        .bg-gray-900 .text-white { color: #374151 !important; }
        .bg-gray-900 .text-gray-400 { color: #6B7280 !important; }
        .bg-gray-900 .border-gray-800 { border-color: #D1D5DB !important; }
        
        /* Mobile menu animation */
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
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logok4.png') }}" alt="SMKN 4 Bogor" class="h-8 w-8 sm:h-10 sm:w-10 floating-icon">
                        <span class="text-base sm:text-xl font-bold text-gray-900">SMKN 4 Bogor</span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-gray-900 hover:text-blue-600 font-medium transition-colors duration-200">BERANDA</a>
                    <a href="{{ route('gallery.index') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-colors duration-200">GALLERY</a>
                    <a href="{{ route('jurusan.index') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-colors duration-200">JURUSAN</a>
                    
                    <!-- Profil Dropdown -->
                    <div class="dropdown relative">
                        <button class="flex items-center text-blue-600 font-medium transition-colors duration-200">
                            PROFIL <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200 hidden">
                            <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-building mr-2"></i>Fasilitas
                            </a>
                            <a href="{{ route('profil.prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-trophy mr-2"></i>Prestasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-900 hover:text-blue-600 p-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <div class="flex flex-col space-y-2">
                    <a href="/" class="block px-4 py-3 text-gray-900 hover:bg-blue-50 hover:text-blue-600 font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>BERANDA
                    </a>
                    
                    <a href="{{ route('gallery.index') }}" class="block px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-images mr-2"></i>GALLERY
                    </a>
                    
                    <a href="{{ route('jurusan.index') }}" class="block px-4 py-3 text-gray-900 hover:bg-green-50 hover:text-green-600 font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-graduation-cap mr-2"></i>JURUSAN
                    </a>
                    
                    <!-- Mobile Profil Section -->
                    <div class="border-t border-gray-200 pt-2">
                        <div class="px-4 py-2 text-sm font-semibold text-gray-500 uppercase">Profil</div>
                        <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-3 bg-blue-50 text-blue-600 font-medium rounded-md">
                            <i class="fas fa-building mr-2"></i>Fasilitas
                        </a>
                        <a href="{{ route('profil.prestasi') }}" class="block px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 font-medium rounded-md transition-colors duration-200">
                            <i class="fas fa-trophy mr-2"></i>Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="gradient-bg text-white py-20 page-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-wide header-title">
                <i class="fas fa-school mr-4 floating-icon"></i>FASILITAS
            </h1>
            <p class="text-2xl md:text-3xl font-light mb-4 header-title" style="animation-delay: 0.2s;">SMKN 4 Bogor</p>
            <p class="text-lg md:text-xl opacity-90 max-w-3xl mx-auto leading-relaxed header-title" style="animation-delay: 0.4s;">
                Fasilitas modern dan lengkap untuk mendukung pembelajaran yang optimal
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Fasilitas Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($fasilitasList as $fasilitas)
            <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden group">
                <div class="relative">
                    @if($fasilitas['image'])
                        <img src="{{ asset('images/' . $fasilitas['image']) }}?v={{ time() }}" 
                             alt="{{ $fasilitas['name'] }}" 
                             class="w-full h-48 object-cover facility-image"
                             onerror="console.log('Image failed: {{ $fasilitas['image'] }}'); this.onerror=null; this.src='{{ asset('images/logok4.png') }}';">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <i class="{{ $fasilitas['icon'] }} text-4xl text-gray-500"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="{{ $fasilitas['bgColor'] }} text-white px-3 py-1 rounded-full text-sm font-bold facility-badge">
                            <i class="{{ $fasilitas['icon'] }} mr-1"></i>{{ ucfirst($fasilitas['category']) }}
                        </span>
                    </div>
                </div>
                <div class="p-6 facility-content">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $fasilitas['name'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $fasilitas['description'] }}</p>
                    @if(!empty($fasilitas['features']))
                    <ul class="space-y-2 text-gray-600">
                        @foreach($fasilitas['features'] as $feature)
                        <li class="flex items-center feature-tag"><i class="fas fa-check text-green-500 mr-2"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-building text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-500 mb-2">Belum Ada Fasilitas</h3>
                <p class="text-gray-400">Fasilitas akan segera ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <!-- Back Button -->
        <div class="text-center mt-16">
            <a href="/" class="inline-flex items-center px-8 py-4 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg pulse-button" style="background: var(--primary-blue-light);">
                <i class="fas fa-arrow-left mr-3 icon-primary"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Footer identical to Gallery -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
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

    <script>
        // Initialize mobile menu functionality
        function initializeMobileMenu() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    
                    // Toggle icon between bars and times
                    const icon = mobileMenuButton.querySelector('i');
                    if (mobileMenu.classList.contains('hidden')) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    }
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        const icon = mobileMenuButton.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
                
                // Close mobile menu when clicking a link
                const mobileMenuLinks = mobileMenu.querySelectorAll('a');
                mobileMenuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                        const icon = mobileMenuButton.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    });
                });
            }
        }

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

                // Toggle on button click
                if (button && menu) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        // Close other dropdowns
                        document.querySelectorAll('.dropdown .dropdown-menu').forEach(m => {
                            if (m !== menu) m.classList.add('hidden');
                        });
                        menu.classList.toggle('hidden');
                    });
                }
            });
        }

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize mobile menu and dropdowns
            initializeMobileMenu();
            initializeDropdowns();
            const cards = document.querySelectorAll('.card-hover');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                observer.observe(card);
            });

            // Add staggered animation delay
            cards.forEach((card, index) => {
                card.style.transitionDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
