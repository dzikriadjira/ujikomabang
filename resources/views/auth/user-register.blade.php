<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - SMKN 4 Bogor</title>
    
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
        
        .register-card {
            background: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Register Card -->
        <div class="register-card rounded-2xl p-8">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="mx-auto h-20 w-20 mb-4">
                    <img src="{{ asset('images/logok4.png') }}" alt="Logo SMKN 4 Bogor" class="h-full w-full object-contain">
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Registration</h1>
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

            <!-- Register Form -->
            <form method="POST" action="{{ route('user.register.post') }}" class="space-y-5">
                @csrf
                
                <!-- Name -->
                <div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
                               required
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"
                               placeholder="Enter your name">
                    </div>
                </div>

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
                               minlength="6"
                               class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"
                               placeholder="Create a password (min 6 characters)">
                        <span class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                              onclick="togglePassword('password', 'toggle-icon-1')">
                            <i class="fas fa-eye" id="toggle-icon-1"></i>
                        </span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               required
                               minlength="6"
                               class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"
                               placeholder="Confirm a password">
                        <span class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                              onclick="togglePassword('password_confirmation', 'toggle-icon-2')">
                            <i class="fas fa-eye" id="toggle-icon-2"></i>
                        </span>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div>
                    <label class="flex items-start">
                        <input type="checkbox" 
                               name="terms" 
                               id="terms"
                               required
                               class="w-4 h-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded mt-1">
                        <span class="ml-2 text-sm text-gray-700">I accept all terms & conditions</span>
                    </label>
                </div>

                <!-- reCAPTCHA (disabled for now) -->
                <!-- <div class="flex justify-center">
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                </div> -->

                <!-- Register Button -->
                <button type="submit" 
                        class="w-full bg-cyan-600 text-white py-3 rounded-lg font-semibold hover:bg-cyan-700 transition duration-300 shadow-md hover:shadow-lg">
                    Register Now
                </button>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Already have an account? 
                    <a href="{{ route('user.login') }}" class="text-cyan-600 hover:text-cyan-700 font-semibold">Login now</a>
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
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
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
