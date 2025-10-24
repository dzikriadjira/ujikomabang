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
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <!-- Soft Pastel Modern Theme -->
    <style>
        :root {
            /* Blue Theme Variables */
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
            
            /* Pastel Color Palette */
            --pastel-blue: #A8D8EA;
            --pastel-blue-light: #C7E9F1;
            --pastel-blue-dark: #7FB3D3;
            
            --pastel-mint: #B8E6B8;
            --pastel-mint-light: #D1F2D1;
            --pastel-mint-dark: #9DD99D;
            
            --pastel-peach: #FFD3A5;
            --pastel-peach-light: #FFE4C4;
            --pastel-peach-dark: #FFBF7F;
            
            --pastel-lavender: #D4A5FF;
            --pastel-lavender-light: #E4C7FF;
            --pastel-lavender-dark: #C285FF;
            
            --pastel-pink: #FFB3D1;
            --pastel-pink-light: #FFCCE0;
            --pastel-pink-dark: #FF99C2;
            
            --pastel-yellow: #FFF2A5;
            --pastel-yellow-light: #FFF8C4;
            --pastel-yellow-dark: #FFED7F;

            /* Background and Surface Colors */
            --bg: #FFFFFF;
            --surface: #FEFEFE;
            --surface-soft: #F8F9FA;
            --border: #E8E9EA;
            --border-soft: #F0F1F2;

            /* Text Colors */
            --text-primary: #2D3748;
            --text-secondary: #4A5568;
            --text-muted: #718096;
            --text-light: #A0AEC0;

            /* Primary Colors */
            --primary: var(--pastel-blue);
            --primary-hover: var(--pastel-blue-dark);
            --secondary: var(--pastel-mint);
            --secondary-hover: var(--pastel-mint-dark);
            --accent: var(--pastel-peach);
            --accent-hover: var(--pastel-peach-dark);
        }

        html, body { 
            background: var(--bg); 
            color: var(--text-primary); 
        }
        
        a { 
            color: var(--pastel-blue-dark); 
            transition: color 0.3s ease;
        }
        a:hover { 
            color: var(--pastel-lavender-dark); 
        }

        /* Navbar */
        .app-navbar, nav.navbar, .top-nav, .site-header, nav.bg-white {
            background: var(--gradient-light) !important;
            border-bottom: 1px solid rgba(59, 130, 246, 0.2) !important;
            color: var(--primary-blue-dark) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(59, 130, 246, 0.15);
        }
        
        .app-navbar a, nav.navbar a, .top-nav a, nav.bg-white a { 
            color: var(--primary-blue) !important; 
            transition: all 0.3s ease;
        }
        
        .app-navbar a:hover, nav.navbar a:hover, .top-nav a:hover, nav.bg-white a:hover { 
            color: var(--primary-blue-dark) !important; 
            transform: translateY(-1px);
        }

        /* Cards and Surfaces */
        .bg-white { 
            background-color: var(--surface) !important; 
            border: 1px solid var(--border-soft);
            box-shadow: 0 4px 20px rgba(168, 216, 234, 0.08);
        }
        
        .bg-gray-50 { 
            background-color: var(--surface-soft) !important; 
        }
        
        .bg-gray-800 { 
            background: linear-gradient(135deg, var(--pastel-blue-light) 0%, var(--pastel-mint-light) 100%) !important; 
        }
        
        .text-gray-900 { color: var(--text-primary) !important; }
        .text-gray-700, .text-gray-600 { color: var(--text-secondary) !important; }
        .text-gray-500 { color: var(--text-muted) !important; }
        .border-gray-200, .border-gray-800 { border-color: var(--border) !important; }

        /* Buttons */
        .bg-blue-600, .bg-indigo-600 { 
            background: var(--primary-blue-light) !important; 
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }
        
        .bg-blue-600:hover, .bg-indigo-600:hover { 
            background: var(--primary-blue-dark) !important; 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }
        
        .bg-purple-600, .bg-violet-600 { 
            background: linear-gradient(135deg, var(--pastel-lavender) 0%, var(--pastel-pink) 100%) !important; 
            box-shadow: 0 4px 15px rgba(212, 165, 255, 0.3);
        }
        
        .bg-purple-600:hover, .bg-violet-600:hover { 
            background: linear-gradient(135deg, var(--pastel-lavender-dark) 0%, var(--pastel-pink-dark) 100%) !important; 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 165, 255, 0.4);
        }

        .bg-green-600 {
            background: linear-gradient(135deg, var(--pastel-mint) 0%, var(--pastel-mint-dark) 100%) !important;
            box-shadow: 0 4px 15px rgba(184, 230, 184, 0.3);
        }

        .bg-green-600:hover {
            background: linear-gradient(135deg, var(--pastel-mint-dark) 0%, var(--pastel-blue) 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(184, 230, 184, 0.4);
        }

        .bg-yellow-600 {
            background: linear-gradient(135deg, var(--pastel-yellow) 0%, var(--pastel-peach) 100%) !important;
            box-shadow: 0 4px 15px rgba(255, 242, 165, 0.3);
        }

        .bg-yellow-600:hover {
            background: linear-gradient(135deg, var(--pastel-peach) 0%, var(--pastel-pink) 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 242, 165, 0.4);
        }

        /* Inputs */
        input, select, textarea {
            background: var(--surface) !important;
            color: var(--text-primary) !important;
            border: 2px solid var(--border) !important;
            transition: all 0.3s ease;
        }
        
        input:focus, select:focus, textarea:focus {
            border-color: var(--pastel-blue) !important;
            box-shadow: 0 0 0 3px rgba(168, 216, 234, 0.2) !important;
            transform: translateY(-1px);
        }
        
        input::placeholder, textarea::placeholder { 
            color: var(--text-light) !important; 
        }

        /* Tables */
        thead { 
            background: linear-gradient(135deg, var(--pastel-blue-light) 0%, var(--pastel-mint-light) 100%) !important; 
        }
        
        tbody tr:hover { 
            background: rgba(168, 216, 234, 0.05) !important; 
            transform: translateX(2px);
            transition: all 0.3s ease;
        }

        /* Alerts and Badges */
        .bg-green-100 {
            background: linear-gradient(135deg, var(--pastel-mint-light) 0%, rgba(184, 230, 184, 0.3) 100%) !important;
            border-color: var(--pastel-mint) !important;
        }

        .bg-red-100 {
            background: linear-gradient(135deg, var(--pastel-pink-light) 0%, rgba(255, 179, 209, 0.3) 100%) !important;
            border-color: var(--pastel-pink) !important;
        }

        .bg-blue-100 {
            background: linear-gradient(135deg, var(--pastel-blue-light) 0%, rgba(168, 216, 234, 0.3) 100%) !important;
            border-color: var(--pastel-blue) !important;
        }

        .bg-yellow-100 {
            background: linear-gradient(135deg, var(--pastel-yellow-light) 0%, rgba(255, 242, 165, 0.3) 100%) !important;
            border-color: var(--pastel-yellow) !important;
        }

        /* Footer */
        footer.bg-gray-800 { 
            background: var(--secondary-blue-light) !important; 
            color: var(--text-secondary) !important; 
        }

        /* Icon utilities - blue theme */
        .icon-blue { color: var(--primary-blue) !important; }
        .icon-blue-soft { color: var(--secondary-blue-light) !important; }
        .icon-blue-accent { color: var(--accent-blue) !important; }
        .icon-blue:hover, .icon-blue-soft:hover, .icon-blue-accent:hover { filter: brightness(0.9); }
        /* Primary light blue icon utility */
        .icon-primary { color: var(--primary-blue-light) !important; }

        /* Custom Animations */
        @keyframes pastelGlow {
            0%, 100% { box-shadow: 0 4px 20px rgba(168, 216, 234, 0.2); }
            50% { box-shadow: 0 6px 30px rgba(212, 165, 255, 0.3); }
        }

        .pastel-glow {
            animation: pastelGlow 3s ease-in-out infinite;
        }

        /* Smooth transitions for all interactive elements */
        button, .btn, a, input, select, textarea {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @auth
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Section -->
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/logok4.png') }}" alt="SMKN 4 Bogor" class="h-10 w-10 rounded-lg">
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-gray-900 leading-tight">Galeri Sekolah</h1>
                        <p class="text-xs text-gray-600 font-medium">SMKN 4 Bogor</p>
                    </div>
                </div>

                <!-- Main Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-tachometer-alt w-4 h-4 mr-2"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('gallery.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('gallery.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-images w-4 h-4 mr-2"></i>
                        <span>Galeri</span>
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.jurusan.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.jurusan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-graduation-cap w-4 h-4 mr-2"></i>
                        <span>Jurusan</span>
                    </a>
                    <a href="{{ route('admin.fasilitas.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.fasilitas.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-building w-4 h-4 mr-2"></i>
                        <span>Fasilitas</span>
                    </a>
                    <a href="{{ route('admin.prestasi.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-trophy w-4 h-4 mr-2"></i>
                        <span>Prestasi</span>
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-tags w-4 h-4 mr-2"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.register') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.register') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                        <i class="fas fa-user-plus w-4 h-4 mr-2"></i>
                        <span>Tambah User</span>
                    </a>
                    @endif
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-2">
                    <div class="hidden md:flex items-center space-x-2">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-all duration-200 focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold mr-2">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="max-w-32 truncate">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-xs text-gray-500"></i>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 style="display: none;">
                                <div class="py-1">
                                    <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                                        <i class="fas fa-user-circle w-4 h-4 mr-3 text-gray-400"></i>
                                        Profil Saya
                                    </a>
                                    @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-purple-600">
                                        <i class="fas fa-users-cog w-4 h-4 mr-3 text-gray-400"></i>
                                        Kelola Pengguna
                                    </a>
                                    @endif
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                            <i class="fas fa-sign-out-alt w-4 h-4 mr-3 text-gray-400"></i>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="lg:hidden">
                        <button type="button" id="mobile-menu-button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="lg:hidden mobile-menu hidden transition-all duration-300 ease-in-out transform" id="mobile-menu">
                <div class="px-2 pt-2 pb-4 space-y-1 bg-white rounded-md shadow-lg mt-2 border border-gray-200">
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 rounded-t-md">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-lg mr-3">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-2 py-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                            <i class="fas fa-tachometer-alt w-5 text-center mr-3 text-gray-500"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('gallery.index') }}" class="flex items-center px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('gallery.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                            <i class="fas fa-images w-5 text-center mr-3 text-gray-500"></i>
                            Galeri
                        </a>
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.jurusan.index') }}" class="flex items-center px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('admin.jurusan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                            <i class="fas fa-graduation-cap w-5 text-center mr-3 text-gray-500"></i>
                            Jurusan
                        </a>
                        <a href="{{ route('admin.fasilitas.index') }}" class="flex items-center px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('admin.fasilitas.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                            <i class="fas fa-building w-5 text-center mr-3 text-gray-500"></i>
                            Fasilitas
                        </a>
                        <a href="{{ route('admin.prestasi.index') }}" class="flex items-center px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                            <i class="fas fa-trophy w-5 text-center mr-3 text-gray-500"></i>
                            Prestasi
                        </a>
                        <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                            <i class="fas fa-tags w-5 text-center mr-3 text-gray-500"></i>
                        Kategori
                    </a>
                    <a href="{{ route('admin.register') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-150">
                        <i class="fas fa-user-plus w-4 h-4 mr-2 text-blue-500"></i>
                        Tambah User
                    </a>
                    @endif
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <a href="{{ route('profile') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-150">
                            <i class="fas fa-user w-4 h-4 mr-2 text-gray-500"></i>
                            {{ auth()->user()->name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-150">
                                <i class="fas fa-sign-out-alt w-4 h-4 mr-2 text-red-500"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    const isExpanded = !mobileMenu.classList.contains('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', isExpanded);
                });
            }
        });
    </script>
    @endauth

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

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Galeri Sekolah SMKN 4 Bogor. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Toast notification function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
    
    @stack('scripts')
</body>
</html>
