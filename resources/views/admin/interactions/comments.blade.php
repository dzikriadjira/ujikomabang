@extends('admin.layouts.app')

@section('title', 'Daftar Komentar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.interactions') }}">Interaksi</a></li>
                        <li class="breadcrumb-item active">Daftar Komentar</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar Komentar</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Pengguna</th>
                                    <th>Komentar</th>
                                    <th>Galeri</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $comment)
                                <tr>
                                    <td>#{{ $comment->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('images/default-avatar.png') }}" 
                                                 class="rounded-circle me-2" width="30" height="30" alt="{{ $comment->user->name }}">
                                            {{ $comment->user->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>{{ Str::limit($comment->content, 60) }}</span>
                                            @if($comment->parent_id)
                                            <small class="text-muted">
                                                Balasan untuk komentar #{{ $comment->parent_id }}
                                            </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.show', $comment->gallery_id) }}" target="_blank">
                                            {{ Str::limit($comment->gallery->title, 30) }}
                                        </a>
                                    </td>
                                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('gallery.show', $comment->gallery_id) }}#comment-{{ $comment->id }}" 
                                               class="btn btn-xs btn-info" 
                                               target="_blank"
                                               data-bs-toggle="tooltip" 
                                               title="Lihat di Galeri">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.interactions.comments.delete', $comment->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Hapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-xs btn-danger"
                                                        data-bs-toggle="tooltip" 
                                                        title="Hapus Komentar">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data komentar</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush

@endsection
