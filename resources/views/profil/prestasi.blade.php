<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi - SMKN 4 Bogor</title>
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
        .gradient-bg {
            background: #60A5FA;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
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
        /* Primary light blue icon */
        .icon-primary { color: var(--primary-blue-light) !important; }
        .achievement-badge {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }
        .student-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .student-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        .student-image {
            transition: transform 0.4s ease;
        }
        .student-card:hover .student-image {
            transform: scale(1.1);
        }
        .trophy-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logok4.png') }}" alt="SMKN 4 Bogor" class="h-10 w-10">
                        <span class="text-xl font-bold text-gray-900">SMKN 4 Bogor</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">BERANDA</a>
                    <a href="{{ route('gallery.index') }}" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">GALLERY</a>
                    <a href="{{ route('jurusan.index') }}" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">JURUSAN</a>
                    
                    <!-- Profil Dropdown -->
                    <div class="dropdown relative">
                        <button class="flex items-center text-cyan-600 font-medium transition-colors duration-200">
                            PROFIL <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                            <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 transition-colors duration-200">
                                <i class="fas fa-building mr-2"></i>Fasilitas
                            </a>
                            <a href="{{ route('profil.prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 transition-colors duration-200">
                                <i class="fas fa-trophy mr-2"></i>Prestasi
                            </a>
                        </div>
                    </div>
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

    <!-- Header Section -->
    <div class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-wide">PRESTASI</h1>
            <p class="text-2xl md:text-3xl font-light mb-4">SMKN 4 Bogor</p>
            <p class="text-lg md:text-xl opacity-90 max-w-3xl mx-auto leading-relaxed">
                Galeri foto pelajar berprestasi yang membanggakan sekolah
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Achievement Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="achievement-badge w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-2xl text-white"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['nasional'] }}</h3>
                <p class="text-gray-600">Prestasi Nasional</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="achievement-badge w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-medal text-2xl text-white"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['provinsi'] + $stats['kabupaten'] }}</h3>
                <p class="text-gray-600">Prestasi Regional</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="achievement-badge w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-2xl text-white"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_prestasi'] }}</h3>
                <p class="text-gray-600">Total Prestasi</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="achievement-badge w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-2xl text-white"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['this_year'] }}</h3>
                <p class="text-gray-600">Prestasi {{ date('Y') }}</p>
            </div>
        </div>

        <!-- Galeri Foto Pelajar Berprestasi -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Galeri Foto Pelajar Berprestasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($prestasiList as $prestasi)
                <div class="bg-white rounded-2xl shadow-lg student-card overflow-hidden group">
                    <div class="relative overflow-hidden">
                        @if($prestasi['image'])
                            <img src="{{ asset('storage/' . $prestasi['image']) }}" 
                                 alt="{{ $prestasi['title'] }}" 
                                 class="w-full h-64 object-cover student-image">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <i class="{{ $prestasi['icon'] }} text-white text-6xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="{{ $prestasi['bgColor'] }} text-white px-3 py-1 rounded-full text-sm font-bold flex items-center trophy-badge">
                                <i class="{{ $prestasi['icon'] }} mr-1"></i>{{ ucfirst($prestasi['level']) }}
                            </span>
                        </div>
                        @if($prestasi['is_featured'])
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $prestasi['title'] }}</h3>
                        <p class="text-gray-600 mb-3">{{ $prestasi['description'] }}</p>
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($prestasi['category']) }}</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($prestasi['level']) }}</span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar mr-2"></i>
                                <span>{{ $prestasi['year'] }}</span>
                            </div>
                            @if($prestasi['student_name'])
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user mr-2"></i>
                                <span>{{ $prestasi['student_name'] }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-trophy text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Belum Ada Prestasi</h3>
                    <p class="text-gray-400">Prestasi akan segera ditambahkan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-16">
            <a href="/" class="inline-flex items-center px-8 py-4 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg" style="background: var(--gradient-primary); hover:background: var(--gradient-secondary);">
                <i class="fas fa-arrow-left mr-3 icon-primary"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: #C7E9F1;" class="text-gray-800 py-12 mt-16">
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
        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.student-card');
            
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
