@extends('layouts.app')

@section('title', 'Statistik Kategori - SMKN 4 Bogor')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Statistik Kategori</h1>
        <p class="text-gray-600 mt-2">Jumlah galeri per kategori</p>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Galleries Card -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600">Total Galeri</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($totalGalleries) }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-images text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Categories Count -->
                <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg border border-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600">Total Kategori</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $categories->count() }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-tags text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Average per Category -->
                @if($categories->count() > 0)
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-600">Rata-rata per Kategori</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ number_format($totalGalleries / $categories->count(), 1) }}
                            </p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Categories Table -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Kategori</h2>
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Galeri
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persentase
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $category->galleries_count }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $percentage = $totalGalleries > 0 ? ($category->galleries_count / $totalGalleries) * 100 : 0;
                                    @endphp
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">{{ number_format($percentage, 1) }}%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($category->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
