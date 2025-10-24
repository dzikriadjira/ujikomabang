<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - SMKN 4 Bogor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <style>
        body {
            background: #f9fafb;
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #06b6d4;
        }
        
        .login-card {
            background: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="login-card rounded-2xl p-8">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="mx-auto h-20 w-20 mb-4">
                    <img src="{{ asset('images/logok4.png') }}" alt="Logo SMKN 4 Bogor" class="h-full w-full object-contain">
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang</h1>
                <p class="text-gray-600">Login untuk like, komentar, dan simpan galeri</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('user.login.post') }}" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}"
                               required
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"
                               placeholder="Enter your email">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required
                               class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"
                               placeholder="Confirm a password">
                        <span class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                              onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggle-icon"></i>
                        </span>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               class="w-4 h-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded">
                        <span class="ml-2 text-gray-700">Remember me</span>
                    </label>
                    <a href="#" class="text-cyan-600 hover:text-cyan-700 font-medium">Forgot password?</a>
                </div>

                <!-- reCAPTCHA (disabled for now) -->
                <!-- <div class="flex justify-center">
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                </div> -->

                <!-- Login Button -->
                <button type="submit" 
                        class="w-full bg-cyan-600 text-white py-3 rounded-lg font-semibold hover:bg-cyan-700 transition duration-300 shadow-md hover:shadow-lg">
                    Login Now
                </button>

                <!-- Register Link -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Don't have an account? 
                    <a href="{{ route('user.register') }}" class="text-cyan-600 hover:text-cyan-700 font-semibold">Signup now</a>
                </p>
            </form>

            <!-- Back to Gallery -->
            <div class="mt-6 text-center">
                <a href="{{ route('gallery.index') }}" class="text-sm text-gray-600 hover:text-cyan-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Galeri
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-gray-600 text-sm">
            <p>&copy; 2024 SMKN 4 Bogor. All rights reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
