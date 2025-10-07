<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan - SMKN 4 Bogor</title>
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
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        /* Enhanced Jurusan Card Styles */
        .jurusan-card {
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.08);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            backdrop-filter: saturate(120%);
        }
        .jurusan-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 50px rgba(2, 132, 199, 0.15);
            border-color: rgba(2, 132, 199, 0.18);
        }
        .jurusan-header {
            position: relative;
            overflow: hidden;
        }
        .jurusan-header::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 180px;
            height: 180px;
            background: rgba(255,255,255,0.15);
            filter: blur(12px);
            border-radius: 50%;
        }
        .chip {
            background: #EFF6FF;
            color: #1E40AF;
            border: 1px solid #DBEAFE;
        }
        .chip-green {
            background: #ECFDF5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }
        /* Icon utilities - blue theme */
        .icon-blue { color: var(--primary-blue) !important; }
        .icon-blue-soft { color: var(--secondary-blue-light) !important; }
        .icon-blue-accent { color: var(--accent-blue) !important; }
        .icon-blue:hover, .icon-blue-soft:hover, .icon-blue-accent:hover { filter: brightness(0.9); }
        /* Footer overrides identical to Gallery footer */
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
                    <a href="/" class="text-gray-900 font-medium transition-colors duration-200" style="hover:color: var(--primary-blue);">BERANDA</a>
                    <a href="{{ route('gallery.index') }}" class="text-gray-900 font-medium transition-colors duration-200" style="hover:color: var(--primary-blue);">GALLERY</a>
                    <a href="{{ route('jurusan.index') }}" class="font-medium" style="color: var(--primary-blue);">JURUSAN</a>
                    <!-- Profil Dropdown -->
                    <div class="dropdown relative">
                        <button class="nav-link flex items-center text-gray-900 font-medium transition-colors duration-200" style="hover:color: var(--primary-blue);">
                            PROFIL <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200 hidden">
                            <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 transition-colors duration-200" style="hover:background: var(--accent-blue); hover:color: var(--primary-blue);">
                                <i class="fas fa-building mr-2"></i>Fasilitas
                            </a>
                            <a href="{{ route('profil.prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 transition-colors duration-200" style="hover:background: var(--accent-blue); hover:color: var(--primary-blue);">
                                <i class="fas fa-trophy mr-2"></i>Prestasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-900 transition-colors duration-200" style="hover:color: var(--primary-blue);">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-wide">JURUSAN</h1>
            <p class="text-2xl md:text-3xl font-light mb-4">SMKN 4 Bogor</p>
            <p class="text-lg md:text-xl opacity-90 max-w-3xl mx-auto leading-relaxed">
                Pilih jurusan yang sesuai dengan minat dan bakat Anda untuk masa depan yang cerah
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Jurusan Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($jurusanList as $jurusan)
            <!-- {{ $jurusan['nama'] }} Card -->
            <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden jurusan-card">
                <div class="bg-gradient-to-r {{ $jurusan['color'] }} text-white p-6 jurusan-header">
                    <div class="flex items-center justify-between">
                        <div>
                            @if($jurusan['is_featured'])
                            <div class="flex items-center mb-2">
                                <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold">Jurusan Pilihan</span>
                            </div>
                            @endif
                            <h2 class="text-2xl font-bold mb-1">{{ $jurusan['nama'] }}</h2>
                            <p class="text-lg opacity-90">{{ $jurusan['fullName'] }}</p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            @if($jurusan['image'])
                                <img src="{{ asset($jurusan['image']) }}" alt="{{ $jurusan['nama'] }}" class="w-12 h-12 object-contain rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                                    <i class="{{ $jurusan['icon'] }} text-2xl {{ $jurusan['textColor'] }}"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="mb-6">
                        <p class="text-gray-600 leading-relaxed">
                            {{ $jurusan['description'] }}
                        </p>
                    </div>
                    
                    @if(count($jurusan['skills']) > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Kompetensi:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($jurusan['skills'] as $skill)
                            <span class="px-3 py-1 {{ $jurusan['bgColor'] }} {{ $jurusan['textColor'] }} text-sm rounded-full chip">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(count($jurusan['careers']) > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Prospek Karir:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($jurusan['careers'] as $career)
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full chip-green">{{ $career }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer (exactly like Gallery) -->
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
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Raya Bogor - Jakarta KM 25</p>
                        <p><i class="fas fa-phone mr-2"></i>(0251) 123456</p>
                        <p><i class="fas fa-envelope mr-2"></i>info@smkn4bogor.sch.id</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors"
                           title="Facebook SMKN 4 Bogor">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors"
                           title="Instagram SMKN 4 Bogor">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors"
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
        // Initialize dropdown functionality (same pattern as other pages)
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

        document.addEventListener('DOMContentLoaded', function() {
            // Enable navbar dropdowns
            initializeDropdowns();

            // Animate cards on scroll
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
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>