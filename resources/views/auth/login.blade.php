@extends('layouts.app')

@section('title', 'Masuk - Kebab Blast')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto">
        <div class="glass rounded-3xl shadow-2xl p-8 md:p-10 animate-fade-in-up">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-2xl shadow-orange-500/50 animate-float">
                    <span class="text-4xl">🌯</span>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent mb-2">
                    Selamat Datang
                </h1>
                <p class="text-gray-400">Masuk untuk melanjutkan</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-gray-300 mb-2 font-semibold">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" 
                            class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border-2 border-gray-700 rounded-xl focus:outline-none focus:border-orange-500 transition-all duration-300 @error('email') border-red-500 @enderror"
                            placeholder="nama@email.com"
                            required>
                    </div>
                    @error('email')
                        <p class="text-red-400 text-sm mt-2 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 mb-2 font-semibold">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" name="password" 
                            class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border-2 border-gray-700 rounded-xl focus:outline-none focus:border-orange-500 transition-all duration-300 @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                            required>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-sm mt-2 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-2xl shadow-orange-500/50 hover:shadow-orange-500/70 transform hover:scale-105 font-semibold text-lg">
                    <span class="flex items-center justify-center space-x-2">
                        <span>Masuk</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-400">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-orange-400 hover:text-orange-300 font-semibold transition-colors duration-300">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
