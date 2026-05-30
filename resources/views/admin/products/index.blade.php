@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" 
            placeholder="Cari produk..." 
            class="px-4 py-2 bg-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
        <button type="submit" class="px-4 py-2 bg-orange-500 rounded-lg hover:bg-orange-600 transition">
            Cari
        </button>
    </form>
    
    <a href="{{ route('admin.products.create') }}" 
        class="px-4 py-2 bg-orange-500 rounded-lg hover:bg-orange-600 transition">
        + Tambah Produk
    </a>
</div>

@if($products->isEmpty())
    <div class="bg-gray-800 rounded-xl shadow-lg p-16 text-center">
        <span class="text-6xl mb-4 block">📦</span>
        <h2 class="text-2xl font-bold mb-2">Belum Ada Produk</h2>
        <p class="text-gray-400 mb-6">Tambahkan produk pertama Anda</p>
        <a href="{{ route('admin.products.create') }}" class="inline-block bg-orange-500 px-6 py-3 rounded-lg hover:bg-orange-600 transition">
            Tambah Produk
        </a>
    </div>
@else
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left">Gambar</th>
                    <th class="px-6 py-4 text-left">Nama Produk</th>
                    <th class="px-6 py-4 text-left">Harga</th>
                    <th class="px-6 py-4 text-left">Stok</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                        <td class="px-6 py-4">
                            <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
                                @if($product->image)
                                    @if(str_starts_with($product->image, 'http'))
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @elseif(str_starts_with($product->image, 'images/'))
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @endif
                                @else
                                    <span class="text-2xl">🌯</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-orange-500">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 {{ $product->stock > 10 ? 'bg-green-500' : 'bg-red-500' }} rounded-full text-xs">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                    class="px-3 py-1 bg-blue-500 rounded hover:bg-blue-600 transition text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 rounded hover:bg-red-600 transition text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endif
@endsection
