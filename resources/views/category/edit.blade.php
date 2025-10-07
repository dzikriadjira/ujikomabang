@extends('layouts.app')

@section('title', 'Edit Kategori - Admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Kategori</h1>
        <p class="text-sm text-gray-600">Perbarui informasi kategori</p>
    </div>

    <div class="bg-white shadow rounded-lg">
        <form id="categoryForm" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    <p data-error="name" class="text-sm text-red-600 mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $category->description }}</textarea>
                    <p data-error="description" class="text-sm text-red-600 mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                    <input type="color" name="color" value="{{ $category->color }}" class="w-16 h-10 p-0 border border-gray-300 rounded-md">
                    <p class="text-xs text-gray-500 mt-1">Pilih warna badge kategori</p>
                    <p data-error="color" class="text-sm text-red-600 mt-1 hidden"></p>
                </div>
            </div>
            <div class="mt-6 flex items-center space-x-3">
                <button type="submit" id="submitBtn" class="inline-flex items-center px-5 py-2.5 rounded-md bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-60">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
                <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const form = document.getElementById('categoryForm');
const submitBtn = document.getElementById('submitBtn');

function showError(field, message){
    const el = document.querySelector(`[data-error="${field}"]`);
    if(el){ el.textContent = message || ''; el.classList.toggle('hidden', !message); }
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    submitBtn.disabled = true;
    [...form.querySelectorAll('[data-error]')].forEach(el => { el.textContent=''; el.classList.add('hidden'); });

    try {
        const formData = new FormData(form);
        const res = await fetch('{{ route("categories.update", $category) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await res.json().catch(() => ({}));
        if(res.ok && data.success){
            window.location.href = data.redirect || '{{ route('categories.index') }}';
            return;
        }
        if(res.status === 422 && data.errors){
            Object.keys(data.errors).forEach(k => showError(k, data.errors[k][0]));
        } else {
            alert(data.message || 'Terjadi kesalahan saat menyimpan.');
        }
    } catch (err) {
        console.error(err);
        alert('Gagal mengirim data.');
    } finally {
        submitBtn.disabled = false;
    }
});
</script>
@endpush
@endsection


