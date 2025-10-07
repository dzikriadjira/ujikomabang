<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Admin - Galeri Sekolah SMKN 4 Bogor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .bg-pattern {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 25%, #60a5fa 50%, #3b82f6 75%, #1e40af 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-pattern min-h-screen">
    <!-- Home Icon -->
    <div class="absolute top-6 left-6">
        <a href="/" class="text-white hover:text-blue-200 transition-colors duration-200">
            <i class="fas fa-home text-2xl"></i>
        </a>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            <!-- Register Card -->
            <div class="bg-white rounded-lg card-shadow p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-blue-100 mb-4">
                        <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Admin Baru</h1>
                    <p class="text-sm text-gray-600">Galeri Sekolah SMKN 4 Bogor - Admin Only</p>
                </div>

                <!-- Register Form -->
                <form id="registerForm" class="space-y-4">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>
                        <input type="text" id="username" name="username" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Masukkan username">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Masukkan email">
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            No. Telepon
                        </label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Masukkan no. telepon (opsional)">
                    </div>

                    <!-- Address Field -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea id="address" name="address" rows="2"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                  placeholder="Masukkan alamat (opsional)"></textarea>
                    </div>

                    <!-- Role Field -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role Admin
                        </label>
                        <select id="role" name="role" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">Pilih role</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Masukkan password">
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Konfirmasi password">
                    </div>

                    <!-- Register Button -->
                    <button type="submit" id="registerBtn"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 font-medium mt-6">
                        <span id="registerBtnText">Tambah Admin</span>
                        <span id="registerBtnLoading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Loading...
                        </span>
                    </button>

                    <!-- Back to Dashboard Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Dashboard
                            </a>
                        </p>
                    </div>

                    <!-- Error Message -->
                    <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                        <span id="errorText"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Flame Icon -->
    <div class="absolute bottom-6 right-6">
        <div class="text-orange-400">
            <i class="fas fa-fire text-xl"></i>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    name: $('#name').val(),
                    username: $('#username').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    role: $('#role').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                
                // Reset error message
                $('#errorMessage').addClass('hidden');
                
                // Show loading state
                $('#registerBtnText').addClass('hidden');
                $('#registerBtnLoading').removeClass('hidden');
                $('#registerBtn').prop('disabled', true);
                
                $.ajax({
                    url: '{{ route("register.post") }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            $('#errorMessage').removeClass('hidden bg-red-100 border-red-400 text-red-700')
                                             .addClass('bg-green-100 border-green-400 text-green-700');
                            $('#errorText').text(response.message);
                            
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            const errorList = Object.values(errors).flat().join(', ');
                            errorMessage = errorList;
                        }
                        
                        $('#errorText').text(errorMessage);
                        $('#errorMessage').removeClass('hidden');
                    },
                    complete: function() {
                        // Reset button state
                        $('#registerBtnText').removeClass('hidden');
                        $('#registerBtnLoading').addClass('hidden');
                        $('#registerBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
