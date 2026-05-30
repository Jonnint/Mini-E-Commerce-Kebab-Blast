@extends('layouts.app')

@section('title', $product->name . ' - Kebab Blast')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-8 animate-fade-in-up">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 inline-flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <div class="glass rounded-3xl overflow-hidden shadow-2xl animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="md:flex">
                <!-- Image Section -->
                <div class="md:w-1/2 relative">
                    <div class="aspect-square bg-gradient-to-br from-gray-800 to-gray-900 relative overflow-hidden group">
                        @if($product->image)
                            @if(str_starts_with($product->image, 'http'))
                                <img src="{{ $product->image }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @elseif(str_starts_with($product->image, 'images/'))
                                <img src="{{ asset($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @endif
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-9xl animate-float">🌯</span>
                            </div>
                        @endif
                        
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    
                    <!-- Stock Badge -->
                    <div class="absolute top-6 right-6">
                        @if($product->stock > 10)
                            <span class="px-4 py-2 bg-green-500/90 backdrop-blur-sm rounded-xl text-sm font-semibold shadow-lg">
                                ✓ Tersedia
                            </span>
                        @elseif($product->stock > 0)
                            <span class="px-4 py-2 bg-yellow-500/90 backdrop-blur-sm rounded-xl text-sm font-semibold shadow-lg">
                                ⚠ Stok Terbatas
                            </span>
                        @else
                            <span class="px-4 py-2 bg-red-500/90 backdrop-blur-sm rounded-xl text-sm font-semibold shadow-lg">
                                ✗ Habis
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Content Section -->
                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="h-full flex flex-col">
                        <!-- Title & Description -->
                        <div class="flex-1">
                            <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                                {{ $product->name }}
                            </h1>
                            
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                {{ $product->description ?? 'Kelezatan yang tak terlupakan dengan bumbu rahasia yang bikin ketagihan. Dibuat fresh setiap hari dengan bahan pilihan terbaik.' }}
                            </p>
                            
                            <!-- Price -->
                            <div class="mb-6">
                                <span class="text-sm text-gray-400 block mb-2">Harga</span>
                                <span class="text-5xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <!-- Stock Info -->
                            <div class="mb-8 glass rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">Stok tersedia:</span>
                                    <span class="text-2xl font-bold text-orange-400">{{ $product->stock }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Form -->
                        @auth
                            <form action="{{ route('cart.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div>
                                    <label class="block text-gray-300 mb-3 font-semibold">Jumlah</label>
                                    <div class="flex items-center space-x-4">
                                        <button type="button" onclick="decreaseQty()" class="w-12 h-12 glass rounded-xl hover:bg-orange-500/20 transition-all duration-300 flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                            class="w-24 text-center text-2xl font-bold bg-transparent border-2 border-orange-500/30 rounded-xl py-3 focus:outline-none focus:border-orange-500 transition-colors duration-300">
                                        <button type="button" onclick="increaseQty()" class="w-12 h-12 glass rounded-xl hover:bg-orange-500/20 transition-all duration-300 flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-2xl shadow-orange-500/50 hover:shadow-orange-500/70 transform hover:scale-105 font-semibold text-lg">
                                    <span class="flex items-center justify-center space-x-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span>Tambah ke Keranjang</span>
                                    </span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block text-center py-4 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-2xl shadow-orange-500/50 hover:shadow-orange-500/70 transform hover:scale-105 font-semibold text-lg">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Masuk untuk Membeli</span>
                                </span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function increaseQty() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.max);
    const current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
    }
}

function decreaseQty() {
    const input = document.getElementById('quantity');
    const min = parseInt(input.min);
    const current = parseInt(input.value);
    if (current > min) {
        input.value = current - 1;
    }
}
</script>
@endsection
