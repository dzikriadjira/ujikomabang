@extends('layouts.app')

@section('title', 'Kategori - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kategori</h1>
            <p class="text-sm text-gray-600">Kelola kategori untuk galeri</p>
        </div>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 rounded-md text-white transition-all duration-300 transform hover:scale-105" style="background: var(--gradient-primary); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
            <i class="fas fa-plus mr-2"></i>Tambah Kategori
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Warna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Galeri</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" style="background-color: {{ $category->color }};">
                                {{ $category->color }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->galleries_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">Edit</a>
                            <a href="{{ route('categories.show', $category) }}" class="font-medium transition-colors duration-200" style="color: var(--primary-blue); hover:color: var(--primary-blue-dark);">Lihat</a>
                            <button onclick="deleteCategory({{ $category->id }})" class="text-red-600 hover:text-red-800 font-medium transition-colors duration-200">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada kategori</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $categories->links() }}</div>
    </div>
</div>

@push('scripts')
<script>
function deleteCategory(id){
    if(!confirm('Hapus kategori ini?')) return;
    fetch(`/categories/${id}`,{method:'POST',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),'Accept':'application/json'},body:new URLSearchParams({_method:'DELETE'})})
    .then(async r=>{const d=await r.json().catch(()=>({})); if(r.ok&&d.success){location.reload();} else {alert(d.message||'Gagal menghapus kategori');}})
    .catch(()=>alert('Gagal menghapus kategori'))
}
</script>
@endpush
@endsection


