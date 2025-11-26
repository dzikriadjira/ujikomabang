@extends('layouts.app')

@section('title', 'Detail Interaksi - ' . $gallery->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Detail Interaksi</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
            <span class="mx-2 text-gray-500">/</span>
            <a href="{{ route('admin.interactions.index') }}" class="text-blue-600 hover:text-blue-800">Interaksi</a>
            <span class="mx-2 text-gray-500">/</span>
            <span class="text-gray-700">{{ Str::limit($gallery->title, 30) }}</span>
        </nav>
    </div>

    <!-- Gallery Info -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200" style="background-color: #93C5FD;">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-image mr-2"></i>
                Informasi Galeri
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full rounded-lg shadow">
                </div>
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $gallery->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $gallery->description }}</p>
                    <hr class="my-4">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-blue-500 text-white rounded-lg">
                            <h4 class="text-3xl font-bold"><i class="fas fa-thumbs-up"></i> {{ $likesCount }}</h4>
                            <p class="text-sm">Likes</p>
                        </div>
                        <div class="text-center p-4 bg-red-500 text-white rounded-lg">
                            <h4 class="text-3xl font-bold"><i class="fas fa-thumbs-down"></i> {{ $dislikesCount }}</h4>
                            <p class="text-sm">Dislikes</p>
                        </div>
                        <div class="text-center p-4 bg-green-500 text-white rounded-lg">
                            <h4 class="text-3xl font-bold"><i class="fas fa-comment"></i> {{ $gallery->comments->count() }}</h4>
                            <p class="text-sm">Komentar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Likes List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200" style="background-color: #93C5FD;">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-thumbs-up mr-2"></i>
                Daftar User Yang Like ({{ $likesCount }})
            </h2>
        </div>
        <div class="p-6">
            @forelse($gallery->likes as $like)
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border-l-4" style="border-left-color: #3B82F6;">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if($like->user)
                                <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($like->user->name, 0, 1)) }}
                                </div>
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900">
                                @if($like->user)
                                    {{ $like->user->name }}
                                @else
                                    User Tidak Diketahui
                                @endif
                            </h5>
                            <p class="text-sm text-gray-500">
                                <i class="far fa-clock"></i> {{ $like->created_at->format('d M Y, H:i') }}
                                <span class="text-gray-400">({{ $like->created_at->diffForHumans() }})</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            <i class="fas fa-thumbs-up mr-1"></i>Like
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-thumbs-up text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada user yang like galeri ini</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Dislikes List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200" style="background-color: #93C5FD;">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-thumbs-down mr-2"></i>
                Daftar User Yang Dislike ({{ $dislikesCount }})
            </h2>
        </div>
        <div class="p-6">
            @forelse($gallery->dislikes as $dislike)
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border-l-4" style="border-left-color: #EF4444;">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if($dislike->user)
                                <div class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($dislike->user->name, 0, 1)) }}
                                </div>
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900">
                                @if($dislike->user)
                                    {{ $dislike->user->name }}
                                @else
                                    User Tidak Diketahui
                                @endif
                            </h5>
                            <p class="text-sm text-gray-500">
                                <i class="far fa-clock"></i> {{ $dislike->created_at->format('d M Y, H:i') }}
                                <span class="text-gray-400">({{ $dislike->created_at->diffForHumans() }})</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                            <i class="fas fa-thumbs-down mr-1"></i>Dislike
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-thumbs-down text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada user yang dislike galeri ini</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Comments List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200" style="background-color: #93C5FD;">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-comments mr-2"></i>
                Daftar Komentar ({{ $gallery->comments->count() }})
            </h2>
        </div>
        <div class="p-6">
            @forelse($gallery->comments as $comment)
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border-l-4" style="border-left-color: #93C5FD;">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h5 class="font-bold text-gray-900 mb-1">{{ $comment->author_name }}</h5>
                        <p class="text-sm text-gray-500 mb-2">
                            <i class="far fa-clock"></i> {{ $comment->created_at->format('d M Y, H:i') }}
                            <span class="text-gray-400">({{ $comment->created_at->diffForHumans() }})</span>
                        </p>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                    <div>
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada komentar pada galeri ini</p>
            </div>
            @endforelse
        </div>
    </div>

    <a href="{{ route('admin.interactions.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition mb-4">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

@endsection
