@extends('layouts.app')

@section('title', 'Edit Prestasi - SMKN 4 Bogor')

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
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-gray-500 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.prestasi.index') }}" class="text-blue-600 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-trophy mr-2"></i>Prestasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Edit Prestasi</h1>

                <form action="{{ route('admin.prestasi.update', $prestasi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul Prestasi -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Prestasi</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $prestasi->title) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea id="description" name="description" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $prestasi->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="md:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                            @if($prestasi->image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="max-w-xs h-auto rounded-md shadow-sm">
                                    <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select id="category" name="category" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="prestasi" {{ old('category', $prestasi->category) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="penghargaan" {{ old('category', $prestasi->category) == 'penghargaan' ? 'selected' : '' }}>Penghargaan</option>
                                <option value="pencapaian" {{ old('category', $prestasi->category) == 'pencapaian' ? 'selected' : '' }}>Pencapaian</option>
                                <option value="lomba" {{ old('category', $prestasi->category) == 'lomba' ? 'selected' : '' }}>Lomba</option>
                                <option value="kompetisi" {{ old('category', $prestasi->category) == 'kompetisi' ? 'selected' : '' }}>Kompetisi</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Level -->
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                            <select id="level" name="level" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('level') border-red-500 @enderror">
                                <option value="">Pilih Level</option>
                                <option value="nasional" {{ old('level', $prestasi->level) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="provinsi" {{ old('level', $prestasi->level) == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                                <option value="kabupaten" {{ old('level', $prestasi->level) == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                <option value="sekolah" {{ old('level', $prestasi->level) == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                            </select>
                            @error('level')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                            <input type="text" id="year" name="year" value="{{ old('year', $prestasi->year) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('year') border-red-500 @enderror">
                            @error('year')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Siswa -->
                        <div>
                            <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa (Opsional)</label>
                            <input type="text" id="student_name" name="student_name" value="{{ old('student_name', $prestasi->student_name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('student_name') border-red-500 @enderror">
                            @error('student_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Guru -->
                        <div>
                            <label for="teacher_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Guru (Opsional)</label>
                            <input type="text" id="teacher_name" name="teacher_name" value="{{ old('teacher_name', $prestasi->teacher_name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('teacher_name') border-red-500 @enderror">
                            @error('teacher_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Detail Pencapaian -->
                        <div class="md:col-span-2">
                            <label for="achievement_details" class="block text-sm font-medium text-gray-700 mb-2">Detail Pencapaian (Opsional)</label>
                            <textarea id="achievement_details" name="achievement_details" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('achievement_details') border-red-500 @enderror">{{ old('achievement_details', $prestasi->achievement_details) }}</textarea>
                            @error('achievement_details')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Warna -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                            <select id="color" name="color" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror">
                                <option value="blue" {{ old('color', $prestasi->color) == 'blue' ? 'selected' : '' }}>Biru</option>
                                <option value="red" {{ old('color', $prestasi->color) == 'red' ? 'selected' : '' }}>Merah</option>
                                <option value="green" {{ old('color', $prestasi->color) == 'green' ? 'selected' : '' }}>Hijau</option>
                                <option value="purple" {{ old('color', $prestasi->color) == 'purple' ? 'selected' : '' }}>Ungu</option>
                                <option value="yellow" {{ old('color', $prestasi->color) == 'yellow' ? 'selected' : '' }}>Kuning</option>
                                <option value="gray" {{ old('color', $prestasi->color) == 'gray' ? 'selected' : '' }}>Abu-abu</option>
                                <option value="orange" {{ old('color', $prestasi->color) == 'orange' ? 'selected' : '' }}>Orange</option>
                            </select>
                            @error('color')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                            <input type="text" id="icon" name="icon" value="{{ old('icon', $prestasi->icon) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('icon') border-red-500 @enderror"
                                placeholder="fas fa-trophy">
                            @error('icon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $prestasi->sort_order) }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-500 @enderror">
                            @error('sort_order')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center">
                                    <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $prestasi->is_featured) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Featured</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $prestasi->is_active) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ route('admin.prestasi.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Update Prestasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
