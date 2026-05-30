@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')
<div class="max-w-2xl">
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') ring-2 ring-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Harga</label>
                <input type="number" name="price" value="{{ old('price') }}" 
                    class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('price') ring-2 ring-red-500 @enderror"
                    required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock') }}" 
                    class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('stock') ring-2 ring-red-500 @enderror"
                    required>
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" 
                    class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('description') ring-2 ring-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" 
                    class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('image') ring-2 ring-red-500 @enderror"
                    onchange="previewImage(event)">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div id="imagePreview" class="mt-4 hidden">
                    <img id="preview" class="w-32 h-32 object-cover rounded-lg">
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-3 bg-orange-500 rounded-lg hover:bg-orange-600 transition font-semibold">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
