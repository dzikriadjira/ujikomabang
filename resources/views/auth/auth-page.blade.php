<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $isLogin ? 'Login' : 'Register' }} - SMKN 4 Bogor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        
        .auth-card {
            transition: all 0.3s ease;
        }
        
        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #4F46E5;
        }
        
        .input-field {
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 auth-card {{ $isLogin ? 'ring-4 ring-indigo-500' : '' }}">
                <div class="text-center mb-8">
                    <div class="mx-auto h-16 w-16 mb-4">
                        <img src="{{ asset('images/logok4.png') }}" alt="Logo" class="h-full w-full object-contain">
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Login</h2>
                </div>

                @if($isLogin && $errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('user.login.post') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" 
                                   name="email" 
                                   id="login-email"
                                   value="{{ old('email') }}"
                                   required
                                   class="input-field w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
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
                                   id="login-password"
                                   required
                                   class="input-field w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Confirm a password">
                            <span class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                                  onclick="togglePassword('login-password', this)">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium">Forgot password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition duration-300 shadow-lg hover:shadow-xl">
                        Login Now
                    </button>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Don't have an account? 
                        <a href="{{ route('user.register') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Signup now</a>
                    </p>
                </form>
            </div>

            <!-- Registration Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 auth-card {{ !$isLogin ? 'ring-4 ring-indigo-500' : '' }}">
                <div class="text-center mb-8">
                    <div class="mx-auto h-16 w-16 mb-4">
                        <img src="{{ asset('images/logok4.png') }}" alt="Logo" class="h-full w-full object-contain">
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Registration</h2>
                </div>

                @if(!$isLogin && $errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

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
                                   id="register-name"
                                   value="{{ old('name') }}"
                                   required
                                   class="input-field w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
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
                                   id="register-email"
                                   value="{{ old('email') }}"
                                   required
                                   class="input-field w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
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
                                   id="register-password"
                                   required
                                   minlength="8"
                                   class="input-field w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Create a password">
                            <span class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                                  onclick="togglePassword('register-password', this)">
                                <i class="fas fa-eye"></i>
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
                                   id="register-password-confirm"
                                   required
                                   minlength="8"
                                   class="input-field w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Confirm a password">
                            <span class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                                  onclick="togglePassword('register-password-confirm', this)">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div>
                        <label class="flex items-start">
                            <input type="checkbox" name="terms" required class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mt-1">
                            <span class="ml-2 text-sm text-gray-700">I accept all terms & conditions</span>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" 
                            class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition duration-300 shadow-lg hover:shadow-xl">
                        Register Now
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Already have an account? 
                        <a href="{{ route('user.login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Login now</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Back to Gallery -->
        <div class="text-center mt-8">
            <a href="{{ route('gallery.index') }}" class="text-white hover:text-gray-200 transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Galeri
            </a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            const iconElement = icon.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            }
        }
        
        // Password strength indicator
        document.getElementById('register-password')?.addEventListener('input', function(e) {
            const password = e.target.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            // You can add visual feedback here
        });
    </script>
</body>
</html>
