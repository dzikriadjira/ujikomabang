<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri Sekolah SMKN 4 Bogor</title>
    
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
        
        /* Icon color utility for primary blue light */
        .icon-primary { color: var(--primary-blue-light) !important; }
        
        .hero-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 0.5s ease-in-out;
        }
        
        .hero-overlay {
            background: rgba(0, 0, 0, 0.3);
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
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .slide {
            opacity: 0;
            transition: all 0.8s ease-in-out;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(20px);
        }

        .slide.active {
            opacity: 1;
            transform: translateY(0);
            z-index: 10;
        }

        /* Smooth background transition */
        .hero-bg {
            position: relative;
        }

        .hero-bg.transitioning {
            transition: background-image 0.8s ease-in-out;
        }

        /* Mobile menu animation */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        #mobile-menu:not(.hidden) {
            max-height: 500px;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .hero-bg {
                height: 70vh;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Contact Bar -->
    <div style="background: var(--gradient-light);" class="text-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center py-2 sm:py-2 gap-2 sm:gap-0">
                <div class="flex flex-col sm:flex-row items-center space-y-1 sm:space-y-0 sm:space-x-6 text-xs sm:text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>
                        <span>(0251) 123 456</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>
                        <span class="truncate">info@smkn4bogor.sch.id</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4 text-xs sm:text-sm">
                    <span class="hidden sm:inline">Informasi Sekolah</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="h-12 w-12 sm:h-16 sm:w-16 mr-3 sm:mr-4 shadow-lg rounded-xl overflow-hidden bg-white flex items-center justify-center">
                        <img src="{{ asset('images/lg_pplg-removebg-preview.png') }}" alt="Logo SMKN 4 Bogor" class="h-full w-full object-contain p-1">
                    </div>
                    <div>
                        <h1 class="text-lg sm:text-2xl font-bold text-gray-900">SMK NEGRI 4</h1>
                        <p class="text-xs sm:text-sm text-gray-600">KOTA BOGOR</p>
                    </div>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="nav-link text-gray-900 hover:text-blue-600 font-medium transition-colors duration-200">BERANDA</a>
                    
                    <a href="{{ route('gallery.index') }}" class="nav-link text-gray-900 hover:text-purple-600 font-medium transition-colors duration-200">GALLERY</a>
                    
                    <a href="{{ route('jurusan.index') }}" class="nav-link text-gray-900 hover:text-green-600 font-medium transition-colors duration-200">JURUSAN</a>
                    
                    <!-- Profil Dropdown -->
                    <div class="dropdown relative">
                        <button class="nav-link flex items-center text-gray-900 hover:text-pink-600 font-medium transition-colors duration-200">
                            PROFIL <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200 hidden">
                            <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-building mr-2"></i>Fasilitas
                            </a>
                            <a href="{{ route('profil.prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors duration-200">
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
                        <a href="{{ route('profil.fasilitas') }}" class="block px-4 py-3 text-gray-900 hover:bg-blue-50 hover:text-blue-600 font-medium rounded-md transition-colors duration-200">
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

    <!-- Hero Section -->
    <div class="hero-bg relative h-screen" id="heroSlider">
        <div class="hero-overlay absolute inset-0"></div>
        
        <!-- Navigation Arrows -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-75 transition-all duration-200 z-20" onclick="changeSlide(-1)">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-75 transition-all duration-200 z-20" onclick="changeSlide(1)">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
        
        <!-- Hero Content Slides -->
        <!-- Slide 1 -->
        <div class="slide active text-center text-white">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    VISI SEKOLAH
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                    Manusia muda yang unggul dalam Humanitas, Kecerdasan, Kejujuran, Kedisiplinan, dan Pelayanan (HK3P).
                </p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide text-center text-white">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    TEKNOLOGI & INOVASI
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                    Mengembangkan potensi siswa melalui pendidikan teknologi yang berkualitas dan inovatif untuk masa depan yang gemilang.
                </p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide text-center text-white">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    PRESTASI & KEBERHASILAN
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                    Membangun generasi unggul yang siap menghadapi tantangan global dengan kompetensi dan karakter yang kuat.
                </p>
            </div>
        </div>

        <!-- Slider Indicators -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
            <div class="w-3 h-3 bg-white rounded-full opacity-100 cursor-pointer" onclick="goToSlide(0)"></div>
            <div class="w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer" onclick="goToSlide(1)"></div>
            <div class="w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer" onclick="goToSlide(2)"></div>
        </div>
    </div>

 <!-- Bottom Section -->
<div style="background: var(--gradient-secondary);" class="text-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold tracking-wide">
            Membangun Generasi Emas Masa Depan
        </h2>
    </div>
</div>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tentang SMKN 4 Bogor</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    SMKN 4 Bogor adalah sekolah menengah kejuruan yang berfokus pada pengembangan teknologi dan inovasi. 
                    Kami berkomitmen untuk menghasilkan lulusan yang siap kerja dan berdaya saing global.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="mx-auto h-16 w-16 rounded-full flex items-center justify-center mb-4" style="background: var(--gradient-primary);">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pendidikan Berkualitas</h3>
                    <p class="text-gray-600">Kurikulum yang disesuaikan dengan kebutuhan industri dan teknologi terkini</p>
                </div>

                <div class="text-center p-6">
                    <div class="mx-auto h-16 w-16 rounded-full flex items-center justify-center mb-4" style="background: var(--gradient-secondary);">
                        <i class="fas fa-users icon-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Guru Berpengalaman</h3>
                    <p class="text-gray-600">Tim pengajar yang kompeten dan berpengalaman di bidang teknologi</p>
                </div>

                <div class="text-center p-6">
                    <div class="mx-auto h-16 w-16 rounded-full flex items-center justify-center mb-4" style="background: var(--gradient-light);">
                        <i class="fas fa-tools icon-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Fasilitas Lengkap</h3>
                    <p class="text-gray-600">Laboratorium dan peralatan modern untuk mendukung pembelajaran</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: var(--secondary-blue-light);" class="text-gray-800 py-12">
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
                        <p><i class="fas fa-map-marker-alt mr-2 icon-blue"></i>Jl. Raya Tajur No. 123, Bogor</p>
                        <p><i class="fas fa-phone mr-2 icon-blue"></i>(0251) 123 456</p>
                        <p><i class="fas fa-envelope mr-2 icon-blue"></i>info@smkn4bogor.sch.id</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200"
                           title="Facebook SMKN 4 Bogor">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200"
                           title="Instagram SMKN 4 Bogor">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200"
                           title="YouTube SMKN 4 Bogor">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Google Maps Section -->
            <div class="mt-12">
                <h3 class="text-lg font-semibold mb-6 text-center">Lokasi SMKN 4 Bogor</h3>
                <div class="flex justify-center">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.049839558919!2d106.8246939!3d-6.640733399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1756434780909!5m2!1sid!2sid" 
                        width="100%" 
                        height="400" 
                        style="border:0; border-radius: 8px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            
            <div class="border-t border-gray-300 mt-8 pt-8 text-center text-sm text-gray-600">
                <p>&copy; 2024 SMKN 4 Bogor. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
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

            // Initialize hero slider
            initHeroSlider();
            
            // Initialize dropdown functionality
            initializeDropdowns();
        });

        // Hero Slider functionality
        let currentSlide = 0;
        const slides = [
            {
                background: '{{ asset("images/upcr.jpg") }}',
                title: 'VISI SEKOLAH',
                description: 'Manusia muda yang unggul dalam Humanitas, Kecerdasan, Kejujuran, Kedisiplinan, dan Pelayanan (HK3P).'
            },
            {
                background: '{{ asset("images/lap.webp") }}',
                title: 'TEKNOLOGI & INOVASI',
                description: 'Mengembangkan potensi siswa melalui pendidikan teknologi yang berkualitas dan inovatif untuk masa depan yang gemilang.'
            },
            {
                background: '{{ asset("images/drn.webp") }}',
                title: 'PRESTASI & KEBERHASILAN',
                description: 'Membangun generasi unggul yang siap menghadapi tantangan global dengan kompetensi dan karakter yang kuat.'
            }
        ];

        function initHeroSlider() {
            const heroSlider = document.getElementById('heroSlider');
            if (heroSlider) {
                heroSlider.style.backgroundImage = `url('${slides[0].background}')`;
            }
            
            // Auto-advance slides every 5 seconds
            setInterval(() => {
                changeSlide(1);
            }, 5000);
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

        function changeSlide(direction) {
            const slideElements = document.querySelectorAll('.slide');
            const indicators = document.querySelectorAll('.absolute.bottom-8 .w-3');
            
            // Hide current slide
            slideElements[currentSlide].classList.remove('active');
            indicators[currentSlide].style.opacity = '0.5';
            
            // Calculate new slide index
            currentSlide = (currentSlide + direction + slides.length) % slides.length;
            
            // Show new slide
            slideElements[currentSlide].classList.add('active');
            indicators[currentSlide].style.opacity = '1';
            
            // Change background image
            const heroSlider = document.getElementById('heroSlider');
            if (heroSlider) {
                heroSlider.style.backgroundImage = `url('${slides[currentSlide].background}')`;
            }
        }

        function goToSlide(slideIndex) {
            const slideElements = document.querySelectorAll('.slide');
            const indicators = document.querySelectorAll('.absolute.bottom-8 .w-3');
            
            // Hide current slide
            slideElements[currentSlide].classList.remove('active');
            indicators[currentSlide].style.opacity = '0.5';
            
            // Set new slide
            currentSlide = slideIndex;
            
            // Show new slide
            slideElements[currentSlide].classList.add('active');
            indicators[currentSlide].style.opacity = '1';
            
            // Change background image
            const heroSlider = document.getElementById('heroSlider');
            if (heroSlider) {
                heroSlider.style.backgroundImage = `url('${slides[currentSlide].background}')`;
            }
        }
    </script>
</body>
</html>
