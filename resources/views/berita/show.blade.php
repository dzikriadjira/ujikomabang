<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $berita->title }} - SMKN 4 Bogor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Blue Theme Variables */
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
                    <a href="{{ route('berita.index') }}" class="nav-link text-blue-600 font-medium transition-colors duration-200 border-b-2 border-blue-600">BERITA</a>
                    <a href="{{ route('gallery.index') }}" class="nav-link text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">GALLERY</a>
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
    <main class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="/" class="hover:text-gray-700">Beranda</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-gray-700">Berita</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li class="text-gray-900">{{ $berita->title }}</li>
                </ol>
            </nav>

            <!-- Article Header -->
            <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($berita->image)
                <div class="h-64 md:h-96 bg-gray-200">
                    <img src="{{ asset('images/' . $berita->image) }}" 
                         alt="{{ $berita->title }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('images/logok4.png') }}'">
                </div>
                @endif
                
                <div class="p-6 md:p-8">
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="far fa-calendar mr-2"></i>
                        <span>{{ $berita->formatted_date }}</span>
                        <span class="mx-2">•</span>
                        <i class="far fa-user mr-2"></i>
                        <span>{{ $berita->author }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $berita->title }}</h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! $berita->content !!}
                    </div>
                </div>
            </article>

            <!-- Back to Berita -->
            <div class="mt-8 text-center">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Berita
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer style="background: var(--secondary-blue-light);" class="text-gray-800 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">SMKN 4 Bogor</h3>
                    <p class="text-gray-600 text-sm">
                        Sekolah menengah kejuruan yang berfokus pada teknologi dan inovasi untuk masa depan yang lebih baik.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-sm text-gray-600">
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
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-300 mt-8 pt-8 text-center text-sm text-gray-600">
                <p>&copy; 2024 SMKN 4 Bogor. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
