@extends('layouts.admin')

@section('title', 'Monitoring Keranjang')
@section('page-title', 'Monitoring Keranjang')

@section('content')
@if($cartItems->isEmpty())
    <div class="bg-gray-800 rounded-xl shadow-lg p-16 text-center">
        <span class="text-6xl mb-4 block">🛒</span>
        <h2 class="text-2xl font-bold mb-2">Belum Ada Item Keranjang</h2>
        <p class="text-gray-400">Belum ada user yang menambahkan produk ke keranjang</p>
    </div>
@else
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left">User</th>
                    <th class="px-6 py-4 text-left">Produk</th>
                    <th class="px-6 py-4 text-left">Harga Satuan</th>
                    <th class="px-6 py-4 text-left">Quantity</th>
                    <th class="px-6 py-4 text-left">Subtotal</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold">{{ $item->user->name }}</p>
                                <p class="text-sm text-gray-400">{{ $item->user->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center mr-3 overflow-hidden">
                                    @if($item->product->image)
                                        @if(str_starts_with($item->product->image, 'http'))
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @elseif(str_starts_with($item->product->image, 'images/'))
                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @endif
                                    @else
                                        <span class="text-xl">🌯</span>
                                    @endif
                                </div>
                                <span class="font-semibold">{{ $item->product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-500 rounded-full text-xs">{{ $item->quantity }}x</span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-orange-500">
                            Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-gray-400">{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $cartItems->links() }}
    </div>
@endif
@endsection
