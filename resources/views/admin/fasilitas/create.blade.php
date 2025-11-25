@extends('layouts.app')

@section('title', 'Tambah Fasilitas - SMKN 4 Bogor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logok4.png') }}" alt="SMKN 4 Bogor" class="h-10 w-10">
                        <span class="text-xl font-bold text-gray-900">SMKN 4 Bogor</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <!-- Admin Links -->
                    @auth
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">DASHBOARD</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-900 hover:text-cyan-600 font-medium transition-colors duration-200">LOGOUT</button>
                        </form>
                    </div>
                    @endauth
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

    <main class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Tambah Fasilitas</h1>

                <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Fasilitas -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Fasilitas</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @else border-gray-300 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea id="description" name="description" rows="4" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @else border-gray-300 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="md:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Fasilitas</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @else border-gray-300 @enderror">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Warna -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna Tema</label>
                            <select id="color" name="color" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @else border-gray-300 @enderror">
                                <option value="">Pilih Warna</option>
                                <option value="blue" {{ old('color') == 'blue' ? 'selected' : '' }}>Biru</option>
                                <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>Merah</option>
                                <option value="green" {{ old('color') == 'green' ? 'selected' : '' }}>Hijau</option>
                                <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>Ungu</option>
                                <option value="yellow" {{ old('color') == 'yellow' ? 'selected' : '' }}>Kuning</option>
                                <option value="gray" {{ old('color') == 'gray' ? 'selected' : '' }}>Abu-abu</option>
                                <option value="orange" {{ old('color') == 'orange' ? 'selected' : '' }}>Orange</option>
                            </select>
                            @error('color')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                            <input type="text" id="icon" name="icon" value="{{ old('icon', 'fas fa-building') }}" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('icon') border-red-500 @else border-gray-300 @enderror"
                                placeholder="fas fa-building">
                            @error('icon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select id="category" name="category" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @else border-gray-300 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="pplg" {{ old('category') == 'pplg' ? 'selected' : '' }}>PPLG</option>
                                <option value="tkj" {{ old('category') == 'tkj' ? 'selected' : '' }}>TKJ</option>
                                <option value="otomotif" {{ old('category') == 'otomotif' ? 'selected' : '' }}>Teknik Otomotif</option>
                                <option value="pemesinan" {{ old('category') == 'pemesinan' ? 'selected' : '' }}>Teknik Pemesinan</option>
                                <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-500 @else border-gray-300 @enderror">
                            @error('sort_order')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Active -->
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">Aktif</label>
                        </div>
                    </div>

                    <!-- Fitur -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fitur</label>
                        <div id="features-container">
                            <div class="flex items-center space-x-2 mb-2">
                                <input type="text" name="features[]" value="{{ old('features.0') }}" required
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan fitur">
                                <button type="button" onclick="addFeature()" class="bg-green-500 text-white px-3 py-2 rounded-md hover:bg-green-600">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        @error('features')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ route('admin.fasilitas.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            Simpan Fasilitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    function addFeature() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-2 mb-2';
        div.innerHTML = `
            <input type="text" name="features[]" required
                class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan fitur">
            <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(div);
    }

    function removeField(button) {
        button.parentElement.remove();
    }
</script>
@endsection
