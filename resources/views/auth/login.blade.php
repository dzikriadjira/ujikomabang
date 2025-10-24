<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - Galeri Sekolah SMKN 4 Bogor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .bg-gradient-modern {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 25%, #60A5FA 50%, #93C5FD 75%, #DBEAFE 100%);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
        }
        
        .bg-overlay {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(30, 64, 175, 0.2) 100%);
        }
        
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-morphism {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(168, 216, 234, 0.3);
            box-shadow: 0 25px 45px rgba(168, 216, 234, 0.1);
        }
        
        .card-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(168, 216, 234, 0.2);
            box-shadow: 
                0 25px 50px -12px rgba(168, 216, 234, 0.15),
                0 0 0 1px rgba(184, 230, 184, 0.1);
        }
        
        .input-modern {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(168, 216, 234, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .input-modern:focus {
            background: rgba(255, 255, 255, 1);
            border-color: #3B82F6;
            transform: translateY(-2px);
            box-shadow: 
                0 10px 25px -5px rgba(59, 130, 246, 0.3),
                0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .login-button {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            border: 2px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .login-button:hover {
            background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 50%, #93C5FD 100%);
            background-size: 200% 200%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 50%, #60A5FA 100%);
            background-position: right center;
            transform: translateY(-3px);
            box-shadow: 
                0 15px 35px -5px rgba(168, 216, 234, 0.4),
                0 0 0 3px rgba(184, 230, 184, 0.2);
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-element:nth-child(2) {
            animation-delay: -2s;
        }
        
        .floating-element:nth-child(3) {
            animation-delay: -4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(-10px) rotate(-1deg); }
        }
        
        .slide-in {
            animation: slideIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 20px rgba(168, 216, 234, 0.4));
            animation: logoGlow 3s ease-in-out infinite alternate;
        }
        
        @keyframes logoGlow {
            from { filter: drop-shadow(0 0 20px rgba(168, 216, 234, 0.4)); }
            to { filter: drop-shadow(0 0 30px rgba(212, 165, 255, 0.5)); }
        }
        
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            animation: particle 20s linear infinite;
        }
        
        @keyframes particle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #7FB3D3 0%, #9DD99D 50%, #FFBF7F 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .border-gradient {
            background: linear-gradient(135deg, rgba(168, 216, 234, 0.3) 0%, rgba(184, 230, 184, 0.3) 100%);
            padding: 1px;
            border-radius: 1rem;
        }
        
        .border-gradient-inner {
            background: white;
            border-radius: calc(1rem - 1px);
        }
    </style>
</head>
<body class="bg-gradient-modern min-h-screen relative overflow-hidden">
    <!-- Animated Background Particles -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="particle" style="left: 10%; width: 4px; height: 4px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; width: 6px; height: 6px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 30%; width: 3px; height: 3px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 40%; width: 5px; height: 5px; animation-delay: 6s;"></div>
        <div class="particle" style="left: 50%; width: 4px; height: 4px; animation-delay: 8s;"></div>
        <div class="particle" style="left: 60%; width: 6px; height: 6px; animation-delay: 10s;"></div>
        <div class="particle" style="left: 70%; width: 3px; height: 3px; animation-delay: 12s;"></div>
        <div class="particle" style="left: 80%; width: 5px; height: 5px; animation-delay: 14s;"></div>
        <div class="particle" style="left: 90%; width: 4px; height: 4px; animation-delay: 16s;"></div>
    </div>

    <!-- Background Overlay -->
    <div class="bg-overlay absolute inset-0"></div>

    <!-- Floating Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="floating-element absolute -top-20 -right-20 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        <div class="floating-element absolute -bottom-20 -left-20 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        <div class="floating-element absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
        <div class="w-full max-w-md slide-in">
            <!-- Login Card -->
            <div class="card-container rounded-2xl p-6 relative">
                <!-- Decorative Corner Elements -->
                <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-blue-300 rounded-tr-lg opacity-30"></div>
                <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-blue-300 rounded-bl-lg opacity-30"></div>
                
                <!-- Header Section -->
                <div class="text-center mb-6">
                    <!-- Logo Container -->
                    <div class="mx-auto h-16 w-16 flex items-center justify-center mb-4 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full opacity-20 blur-lg"></div>
                        <img src="/images/logok4.png" alt="Logo SMK 4 Bogor" class="h-full w-full object-contain logo-glow relative z-10">
                    </div>
                    
                    <!-- Title Section -->
                    <h1 class="text-2xl font-bold text-gradient mb-2">Selamat Datang</h1>
                    <div class="space-y-1">
                        <p class="text-lg font-semibold text-gray-800">SMK NEGERI 4 BOGOR</p>
                        <p class="text-xs text-gray-600 font-medium">Sistem Galeri Sekolah</p>
                        <div class="inline-flex items-center px-2 py-1 rounded-full bg-blue-50 border border-blue-200 mt-1">
                            <i class="fas fa-shield-alt text-blue-500 mr-1 text-xs"></i>
                            <span class="text-xs font-medium text-blue-700">Admin Panel</span>
                        </div>
                    </div>
                </div>

                <!-- Login Form -->
                <form id="loginForm" class="space-y-4">
                    <!-- Username Field -->
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user mr-2 text-blue-500"></i>Username Administrator
                        </label>
                        <div class="border-gradient">
                            <input type="text" id="username" name="username" required
                                   class="border-gradient-inner w-full px-4 py-3 input-modern rounded-xl focus:outline-none text-gray-800 placeholder-gray-400"
                                   placeholder="Masukkan username admin">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                        </label>
                        <div class="border-gradient">
                            <input type="password" id="password" name="password" required
                                   class="border-gradient-inner w-full px-4 py-3 input-modern rounded-xl focus:outline-none text-gray-800 placeholder-gray-400"
                                   placeholder="Masukkan password">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                   class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-lg">
                            <label for="remember" class="ml-3 block text-sm font-medium text-gray-700">
                                Ingat saya
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" id="loginBtn"
                            class="w-full btn-gradient text-white py-3 px-6 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 font-semibold text-base relative overflow-hidden">
                        <span id="loginBtnText" class="flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Sistem
                        </span>
                        <span id="loginBtnLoading" class="hidden flex items-center justify-center">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Memproses Login...
                        </span>
                    </button>

                    <!-- Security Notice -->
                    <div class="glass-morphism p-3 rounded-xl border border-blue-200">
                        <div class="flex items-center justify-center text-center">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-shield-alt text-blue-500 text-sm"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-blue-800">
                                        Akses Terbatas - Administrator
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error/Success Message -->
                    <div id="alertMessage" class="hidden rounded-xl border-2 px-4 py-3" role="alert">
                        <div class="flex items-center">
                            <i id="alertIcon" class="mr-2 text-sm"></i>
                            <span id="alertText" class="font-medium text-sm"></span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4">
                <p class="text-xs text-white/70">
                    © 2024 SMK Negeri 4 Bogor
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add smooth focus animations
            $('.input-modern').on('focus', function() {
                $(this).parent().addClass('ring-2 ring-blue-300');
            }).on('blur', function() {
                $(this).parent().removeClass('ring-2 ring-blue-300');
            });

            // Form submission
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                const username = $('#username').val().trim();
                const password = $('#password').val();
                
                // Validation
                if (!username || !password) {
                    showAlert('error', 'Username dan password harus diisi');
                    return;
                }

                if (password.length < 6) {
                    showAlert('error', 'Password minimal 6 karakter');
                    return;
                }
                
                // Reset alert
                hideAlert();
                
                // Show loading state
                setLoadingState(true);
                
                // AJAX request
                $.ajax({
                    url: '{{ route("admin.login.post") }}',
                    type: 'POST',
                    data: {
                        username: username,
                        password: password,
                        remember: $('#remember').is(':checked'),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            showAlert('success', response.message || 'Login berhasil! Mengalihkan...');
                            
                            setTimeout(() => {
                                window.location.href = response.redirect || '/dashboard';
                            }, 1500);
                        } else {
                            showAlert('error', response.message || 'Login gagal');
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan sistem. Silakan coba lagi.';
                        
                        if (xhr.status === 401) {
                            errorMessage = 'Username atau password salah';
                        } else if (xhr.status === 403) {
                            errorMessage = 'Akses ditolak. Hanya admin yang dapat login.';
                        } else if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
                                errorMessage = Object.values(errors).flat().join(', ');
                            }
                        }
                        
                        showAlert('error', errorMessage);
                    },
                    complete: function() {
                        setLoadingState(false);
                    }
                });
            });

            // Helper functions
            function setLoadingState(loading) {
                if (loading) {
                    $('#loginBtnText').addClass('hidden');
                    $('#loginBtnLoading').removeClass('hidden');
                    $('#loginBtn').prop('disabled', true).addClass('opacity-75');
                } else {
                    $('#loginBtnText').removeClass('hidden');
                    $('#loginBtnLoading').addClass('hidden');
                    $('#loginBtn').prop('disabled', false).removeClass('opacity-75');
                }
            }

            function showAlert(type, message) {
                const alertDiv = $('#alertMessage');
                const alertIcon = $('#alertIcon');
                const alertText = $('#alertText');
                
                // Reset classes
                alertDiv.removeClass('hidden bg-red-100 bg-green-100 border-red-400 border-green-400 text-red-700 text-green-700');
                alertIcon.removeClass('fas fa-exclamation-triangle fa-check-circle text-red-500 text-green-500');
                
                if (type === 'error') {
                    alertDiv.addClass('bg-red-100 border-red-400 text-red-700');
                    alertIcon.addClass('fas fa-exclamation-triangle text-red-500');
                } else if (type === 'success') {
                    alertDiv.addClass('bg-green-100 border-green-400 text-green-700');
                    alertIcon.addClass('fas fa-check-circle text-green-500');
                }
                
                alertText.text(message);
                alertDiv.removeClass('hidden');
                
                // Auto hide after 5 seconds for success messages
                if (type === 'success') {
                    setTimeout(() => {
                        hideAlert();
                    }, 5000);
                }
            }

            function hideAlert() {
                $('#alertMessage').addClass('hidden');
            }

            // Add enter key support
            $('#username, #password').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#loginForm').submit();
                }
            });
        });
    </script>
</body>
</html>
