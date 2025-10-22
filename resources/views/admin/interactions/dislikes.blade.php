@extends('admin.layouts.app')

@section('title', 'Daftar Dislikes')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.interactions') }}">Interaksi</a></li>
                        <li class="breadcrumb-item active">Daftar Dislikes</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar Dislikes</h4>
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
                                    <th>Galeri</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dislikes as $dislike)
                                <tr>
                                    <td>#{{ $dislike->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $dislike->user->avatar ? asset('storage/' . $dislike->user->avatar) : asset('images/default-avatar.png') }}" 
                                                 class="rounded-circle me-2" width="30" height="30" alt="{{ $dislike->user->name }}">
                                            {{ $dislike->user->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.show', $dislike->gallery->id) }}" target="_blank">
                                            {{ Str::limit($dislike->gallery->title, 50) }}
                                        </a>
                                    </td>
                                    <td>{{ $dislike->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('gallery.show', $dislike->gallery->id) }}" 
                                           class="btn btn-xs btn-info" 
                                           target="_blank"
                                           data-bs-toggle="tooltip" 
                                           title="Lihat Galeri">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data dislikes</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $dislikes->links() }}
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
