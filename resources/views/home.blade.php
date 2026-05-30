@extends('layouts.app')

@section('title', 'Beranda - Kebab Blast')

@section('content')

@php
    $produkUtama = $products->first();
    $gambarHero = asset('images/logo.png');

    if ($produkUtama && $produkUtama->image) {
        if (str_starts_with($produkUtama->image, 'http')) {
            $gambarHero = $produkUtama->image;
        } elseif (str_starts_with($produkUtama->image, 'images/')) {
            $gambarHero = asset($produkUtama->image);
        } else {
            $gambarHero = asset('storage/' . $produkUtama->image);
        }
    }
@endphp

{{-- ==================== HERO ==================== --}}
<section id="hero" class="bg-amber-50 text-stone-800 py-14 md:py-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-10 max-w-6xl mx-auto">

            {{-- Teks kiri --}}
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight">
                    <span class="text-orange-600">Kebab Segar</span><br>
                    Pedas Nikmat
                </h1>

                @if($produkUtama)
                    <p class="text-3xl font-bold text-orange-600 mt-5">
                        Rp {{ number_format($produkUtama->price, 0, ',', '.') }}
                    </p>
                @endif

                <p class="mt-5 text-stone-600 leading-relaxed max-w-md mx-auto md:mx-0">
                    Nikmati kebab premium dengan isian melimpah, saus spesial, dan level pedas
                    yang bisa kamu pilih sendiri. Cocok buat nongkrong atau dibungkus!
                </p>

                <a href="#products"
                   class="inline-block mt-8 px-8 py-3 bg-orange-600 text-white font-bold rounded-lg
                          hover:bg-orange-700 transition-colors shadow-lg shadow-orange-600/30">
                    Pesan Sekarang
                </a>
            </div>

            {{-- Gambar kanan --}}
            <div class="flex-1 flex justify-center">
                <div class="w-72 h-72 md:w-80 md:h-80 rounded-full overflow-hidden bg-white shadow-2xl ring-4 ring-orange-200">
                    <img src="{{ $gambarHero }}"
                         alt="Kebab Blast"
                         class="w-full h-full object-cover hero-gambar">
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ==================== ABOUT US ==================== --}}
<section id="about" class="bg-white text-stone-800 py-16">
    <div class="container mx-auto px-4 max-w-6xl">

        <h2 class="text-3xl md:text-4xl font-black text-center text-stone-900 mb-12">
            Tentang Kami
        </h2>

        {{-- Baris 1: gambar kiri, teks kanan --}}
        <div class="flex flex-col md:flex-row items-center gap-8 mb-16">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/kebab-original.jpg') }}"
                     alt="Kebab Original"
                     class="w-full h-64 object-cover rounded-2xl shadow-lg"
                     onerror="this.src='{{ asset('images/outlet.png') }}'">
            </div>
            <div class="w-full md:w-1/2">
                <h3 class="text-2xl font-bold text-orange-600 mb-3">Selamat Datang di Kebab Blast</h3>
                <p class="text-stone-600 leading-relaxed">
                    Kebab Blast hadir untuk pecinta makanan pedas. Kami memakai bahan segar setiap hari
                    dan resep saus rahasia yang bikin ketagihan.
                </p>
                <p id="teks-tambahan-1" class="hidden mt-3 text-stone-600 leading-relaxed">
                    Dari kebab original sampai level pedas ekstra, semua dibuat langsung saat kamu pesan
                    supaya tetap hangat dan fresh.
                </p>
                <button type="button" class="btn-baca mt-4 text-orange-600 font-semibold hover:underline"
                        data-target="teks-tambahan-1">
                    Baca selengkapnya
                </button>
            </div>
        </div>

        {{-- Baris 2: teks kiri, gambar kanan --}}
        <div class="flex flex-col md:flex-row-reverse items-center gap-8">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/kebab-jumbo.jpg') }}"
                     alt="Kebab Jumbo"
                     class="w-full h-64 object-cover rounded-2xl shadow-lg"
                     onerror="this.src='{{ asset('images/kebabjumbo.png') }}'">
            </div>
            <div class="w-full md:w-1/2">
                <h3 class="text-2xl font-bold text-orange-600 mb-3">Kebab Porsi Jumbo</h3>
                <p class="text-stone-600 leading-relaxed">
                    Porsi besar, harga bersahabat. Isian daging dan sayuran melimpah,
                    cocok buat kamu yang lapar banget setelah pulang sekolah atau kerja.
                </p>
                <p id="teks-tambahan-2" class="hidden mt-3 text-stone-600 leading-relaxed">
                    Tersedia juga varian keju dan level pedas 1 sampai 5. Pesan lewat website ini
                    lalu ambil atau tunggu diantar.
                </p>
                <button type="button" class="btn-baca mt-4 text-orange-600 font-semibold hover:underline"
                        data-target="teks-tambahan-2">
                    Baca selengkapnya
                </button>
            </div>
        </div>

    </div>
</section>


{{-- ==================== MENU / PRODUK ==================== --}}
<div id="products" class="container mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">
            <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                Menu Kami
            </span>
        </h2>
        <p class="text-gray-400">Pilihan terbaik untuk penikmat pedas sejati</p>
    </div>

    @if($products->isEmpty())
        <div class="glass rounded-2xl p-16 text-center max-w-md mx-auto">
            <div class="text-6xl mb-4 animate-float">📦</div>
            <h3 class="text-2xl font-bold mb-2">Belum Ada Produk</h3>
            <p class="text-gray-400">Menu sedang dalam persiapan</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $index => $product)
                <div class="group animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="glass rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-500 transform hover:-translate-y-2">
                        <div class="relative h-56 bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden">
                            @if($product->image)
                                @if(str_starts_with($product->image, 'http'))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @elseif(str_starts_with($product->image, 'images/'))
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-8xl">🌯</span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                @if($product->stock > 10)
                                    <span class="px-3 py-1 bg-green-500/90 rounded-full text-xs font-semibold">Tersedia</span>
                                @elseif($product->stock > 0)
                                    <span class="px-3 py-1 bg-yellow-500/90 rounded-full text-xs font-semibold">Stok Terbatas</span>
                                @else
                                    <span class="px-3 py-1 bg-red-500/90 rounded-full text-xs font-semibold">Habis</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-orange-400 transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                {{ $product->description ?? 'Kelezatan yang tak terlupakan' }}
                            </p>

                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-gray-400">Stok: {{ $product->stock }}</span>
                            </div>

                            <a href="{{ route('product.show', $product) }}"
                               class="block text-center py-3 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl
                                      hover:from-orange-600 hover:to-orange-700 transition-all font-semibold">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
