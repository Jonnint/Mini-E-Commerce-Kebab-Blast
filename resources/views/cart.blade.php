@extends('layouts.app')

@section('title', 'Keranjang - Kebab Blast')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold mb-8 animate-fade-in-up">
            <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                Keranjang Belanja
            </span>
        </h1>
        
        @if($cartItems->isEmpty())
            <div class="glass rounded-3xl p-16 text-center animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="text-8xl mb-6 animate-float">🛒</div>
                <h2 class="text-3xl font-bold mb-4">Keranjang Kosong</h2>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">
                    Belum ada produk di keranjang Anda. Yuk, mulai belanja dan nikmati kelezatan Kebab Blast!
                </p>
                <a href="{{ route('home') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-2xl shadow-orange-500/50 hover:shadow-orange-500/70 transform hover:scale-105">
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span class="font-semibold">Mulai Belanja</span>
                    </span>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $index => $item)
                        <div class="glass rounded-2xl p-6 hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-300 animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="flex items-center space-x-6">
                                <!-- Image -->
                                <div class="w-24 h-24 bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if($item->product->image)
                                        @if(str_starts_with($item->product->image, 'http'))
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @elseif(str_starts_with($item->product->image, 'images/'))
                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @endif
                                    @else
                                        <span class="text-4xl">🌯</span>
                                    @endif
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold mb-2 truncate">{{ $item->product->name }}</h3>
                                    <p class="text-gray-400 text-sm mb-3">Rp {{ number_format($item->product->price, 0, ',', '.') }} / item</p>
                                    
                                    <!-- Quantity Controls -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-3">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center space-x-2">
                                            <button type="button" onclick="decreaseQty{{ $item->id }}()" class="w-8 h-8 glass rounded-lg hover:bg-orange-500/20 transition-all duration-300 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <input type="number" id="qty{{ $item->id }}" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                class="w-16 text-center bg-gray-800/50 border-2 border-gray-700 rounded-lg py-1 focus:outline-none focus:border-orange-500 transition-colors duration-300">
                                            <button type="button" onclick="increaseQty{{ $item->id }}()" class="w-8 h-8 glass rounded-lg hover:bg-orange-500/20 transition-all duration-300 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <button type="submit" class="px-4 py-1 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/30 transition-all duration-300 text-sm">
                                            Update
                                        </button>
                                    </form>
                                    
                                    <script>
                                    function increaseQty{{ $item->id }}() {
                                        const input = document.getElementById('qty{{ $item->id }}');
                                        const max = parseInt(input.max);
                                        const current = parseInt(input.value);
                                        if (current < max) input.value = current + 1;
                                    }
                                    function decreaseQty{{ $item->id }}() {
                                        const input = document.getElementById('qty{{ $item->id }}');
                                        const min = parseInt(input.min);
                                        const current = parseInt(input.value);
                                        if (current > min) input.value = current - 1;
                                    }
                                    </script>
                                </div>
                                
                                <!-- Price & Delete -->
                                <div class="text-right flex-shrink-0">
                                    <p class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent mb-4">
                                        Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                    </p>
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition-all duration-300 text-sm">
                                            <span class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Hapus</span>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="glass rounded-2xl p-6 sticky top-24 animate-fade-in-up" style="animation-delay: 0.3s;">
                        <h3 class="text-xl font-bold mb-6">Ringkasan Belanja</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-400">
                                <span>Subtotal ({{ $cartItems->count() }} item)</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Biaya Layanan</span>
                                <span>Rp 0</span>
                            </div>
                            <div class="border-t border-gray-700 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold">Total</span>
                                    <span class="text-3xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <button class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-2xl shadow-orange-500/50 hover:shadow-orange-500/70 transform hover:scale-105 font-semibold mb-4">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                <span>Checkout</span>
                            </span>
                        </button>
                        
                        <a href="{{ route('home') }}" class="block text-center text-gray-400 hover:text-orange-400 transition-colors duration-300">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Lanjut Belanja</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
