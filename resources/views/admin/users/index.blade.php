@extends('layouts.admin')

@section('title', 'Data User')
@section('page-title', 'Data User')

@section('content')
@if($users->isEmpty())
    <div class="bg-gray-800 rounded-xl shadow-lg p-16 text-center">
        <span class="text-6xl mb-4 block">👥</span>
        <h2 class="text-2xl font-bold mb-2">Belum Ada User</h2>
        <p class="text-gray-400">Belum ada user yang terdaftar</p>
    </div>
@else
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Item Keranjang</th>
                    <th class="px-6 py-4 text-left">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                        <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-500 rounded-full text-xs">{{ $user->role }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-500 rounded-full text-xs">{{ $user->cart_items_count }} item</span>
                        </td>
                        <td class="px-6 py-4 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endif
@endsection
