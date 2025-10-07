@extends('layouts.app')

@section('title', 'Detail Kategori - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kategori: {{ $category->name }}</h1>
            <p class="text-sm text-gray-600">{{ $category->description }}</p>
        </div>
        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800">Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <div class="text-sm text-gray-500">Nama</div>
                <div class="text-gray-900">{{ $category->name }}</div>
            </div>
            <div>
                <div class="text-sm text-gray-500">Slug</div>
                <div class="text-gray-900">{{ $category->slug }}</div>
            </div>
            <div>
                <div class="text-sm text-gray-500">Warna</div>
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" style="background-color: {{ $category->color }};">
                        {{ $category->color }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Galeri dalam Kategori ini</h2>
        @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($galleries as $gallery)
            <div class="border rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <div class="font-semibold">{{ $gallery->title }}</div>
                    <div class="text-sm text-gray-500">{{ $gallery->user->name }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $galleries->links() }}</div>
        @else
        <p class="text-sm text-gray-500">Belum ada galeri.</p>
        @endif
    </div>
</div>
@endsection


