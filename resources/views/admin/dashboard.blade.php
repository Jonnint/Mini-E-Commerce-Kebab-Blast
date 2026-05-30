@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Produk -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Total Produk</p>
                <h3 class="text-3xl font-bold text-orange-500 mt-2">{{ $totalProducts }}</h3>
            </div>
            <div class="bg-orange-500 bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total User -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Total User</p>
                <h3 class="text-3xl font-bold text-blue-500 mt-2">{{ $totalUsers }}</h3>
            </div>
            <div class="bg-blue-500 bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Item Keranjang -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Item Keranjang</p>
                <h3 class="text-3xl font-bold text-yellow-500 mt-2">{{ $totalCartItems }}</h3>
            </div>
            <div class="bg-yellow-500 bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Pendapatan Simulasi</p>
                <h3 class="text-2xl font-bold text-green-500 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-green-500 bg-opacity-20 p-3 rounded-lg">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('admin.products.create') }}" class="bg-gray-800 rounded-xl shadow-lg p-6 hover:bg-gray-700 transition">
        <div class="flex items-center">
            <div class="bg-orange-500 p-3 rounded-lg mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Tambah Produk</h4>
                <p class="text-sm text-gray-400">Tambah produk baru</p>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.products.index') }}" class="bg-gray-800 rounded-xl shadow-lg p-6 hover:bg-gray-700 transition">
        <div class="flex items-center">
            <div class="bg-blue-500 p-3 rounded-lg mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Kelola Produk</h4>
                <p class="text-sm text-gray-400">Edit & hapus produk</p>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.users.index') }}" class="bg-gray-800 rounded-xl shadow-lg p-6 hover:bg-gray-700 transition">
        <div class="flex items-center">
            <div class="bg-green-500 p-3 rounded-lg mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Data User</h4>
                <p class="text-sm text-gray-400">Lihat semua user</p>
            </div>
        </div>
    </a>
</div>
@endsection
