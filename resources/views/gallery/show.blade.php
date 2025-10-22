@extends('layouts.app')

@section('content')
<style>
    .comment-item {
        transition: all 0.3s ease;
    }
    
    .comment-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }
</style>

<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('gallery.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg border-2 text-gray-700 hover:bg-gray-50 transition" style="border-color: #93C5FD;">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="font-semibold">Kembali ke Galeri</span>
        </a>
    </div>

    <!-- Gallery Image Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-auto" alt="{{ $gallery->title }}">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $gallery->title }}</h1>
            <p class="text-gray-600 mb-4">
                Diposting oleh: {{ $gallery->user->name }} | {{ $gallery->created_at->diffForHumans() }}
            </p>
            <p class="text-gray-700 mb-4">{{ $gallery->description }}</p>
            
            <!-- Like, Dislike, Comment -->
            <div class="flex items-center justify-between border-t pt-4">
                <div class="flex items-center space-x-4">
                    <button class="like-btn flex items-center space-x-2 px-4 py-2 rounded-lg border-2 border-blue-500 text-blue-500 hover:bg-blue-50 transition {{ session()->has('liked_gallery_' . $gallery->id) ? 'bg-blue-100' : '' }}" 
                            data-gallery-id="{{ $gallery->id }}">
                        <i class="far fa-thumbs-up"></i>
                        <span class="like-count font-semibold">{{ session()->get('gallery_' . $gallery->id . '_likes_count', 0) }}</span>
                    </button>
                    <button class="dislike-btn flex items-center space-x-2 px-4 py-2 rounded-lg border-2 border-red-500 text-red-500 hover:bg-red-50 transition {{ session()->has('disliked_gallery_' . $gallery->id) ? 'bg-red-100' : '' }}" 
                            data-gallery-id="{{ $gallery->id }}">
                        <i class="far fa-thumbs-down"></i>
                        <span class="dislike-count font-semibold">{{ session()->get('gallery_' . $gallery->id . '_dislikes_count', 0) }}</span>
                    </button>
                </div>
                <div class="flex items-center space-x-2 text-gray-600">
                    <i class="far fa-comment"></i>
                    <span class="comment-count font-semibold">{{ $gallery->comments_count }}</span>
                    <span>Komentar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4" style="background-color: #93C5FD;">
            <div class="flex items-center space-x-2 text-gray-800">
                <i class="fas fa-comments text-xl"></i>
                <h2 class="text-xl font-bold">Komentar ({{ $gallery->comments_count }})</h2>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Comment Form -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 border border-gray-200">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-pen mr-2" style="color: #93C5FD;"></i>
                    Tulis Komentar
                </h3>
                <form action="{{ route('comment.store', $gallery->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:border-blue-400" style="--tw-ring-color: #93C5FD;">
                            <span class="px-4 bg-white" style="color: #93C5FD;">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="name" class="flex-1 px-4 py-3 border-0 focus:outline-none" placeholder="Nama Anda" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <textarea name="content" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none" placeholder="Tulis komentar Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="w-full text-gray-800 py-3 rounded-lg font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2" style="background-color: #93C5FD;">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Komentar</span>
                    </button>
                </form>
            </div>

            <!-- Comments List -->
            @if($gallery->comments_count > 0)
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center mb-4">
                    <i class="fas fa-list mr-2" style="color: #93C5FD;"></i>
                    Semua Komentar
                </h3>
                @foreach($gallery->comments as $comment)
                <div class="comment-item bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition" style="border-left: 4px solid #93C5FD;">
                    <div class="flex space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center text-gray-800 font-bold text-lg shadow-md" style="background-color: #93C5FD;">
                                {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $comment->author_name }}</h4>
                                    <p class="text-sm text-gray-500 flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                @auth
                                    @if(auth()->user()->is_admin)
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-1 rounded-full border border-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endif
                                @endauth
                            </div>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Handle like button click
    $('.like-btn').click(function() {
        const button = $(this);
        const galleryId = button.data('gallery-id');
        
        $.ajax({
            url: `/gallery/${galleryId}/like`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update like count
                button.find('.like-count').text(response.likes_count);
                $('.dislike-btn').find('.dislike-count').text(response.dislikes_count);
                
                // Update button states
                if (response.is_liked) {
                    button.addClass('active');
                    $('.dislike-btn').removeClass('active');
                } else {
                    button.removeClass('active');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
    
    // Handle dislike button click
    $('.dislike-btn').click(function() {
        const button = $(this);
        const galleryId = button.data('gallery-id');
        
        $.ajax({
            url: `/gallery/${galleryId}/dislike`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update dislike count
                button.find('.dislike-count').text(response.dislikes_count);
                $('.like-btn').find('.like-count').text(response.likes_count);
                
                // Update button states
                if (response.is_disliked) {
                    button.addClass('active');
                    $('.like-btn').removeClass('active');
                } else {
                    button.removeClass('active');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});
</script>
@endpush

@endsection
