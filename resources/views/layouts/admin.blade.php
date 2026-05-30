<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Kebab Blast</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 shadow-lg hidden md:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-orange-500">🌯 Admin Panel</h1>
                <p class="text-sm text-gray-400 mt-1">Kebab Blast</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('home') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Produk
                </a>
                
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    User
                </a>
                
                <a href="{{ route('admin.carts.index') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.carts.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Keranjang
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 text-gray-300 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-gray-800 shadow-lg">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-400">{{ auth()->user()->name }}</span>
                        <span class="px-3 py-1 bg-orange-500 rounded-full text-xs">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Alert Messages -->
            @if(session('success'))
                <div id="success-alert" class="mx-6 mt-4">
                    <div class="bg-green-500 text-white px-4 py-3 rounded-lg flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button onclick="closeAlert('success-alert')" class="ml-4 hover:text-green-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div id="error-alert" class="mx-6 mt-4">
                    <div class="bg-red-500 text-white px-4 py-3 rounded-lg flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button onclick="closeAlert('error-alert')" class="ml-4 hover:text-red-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <script>
                // Auto hide alerts after 5 seconds
                setTimeout(() => {
                    const successAlert = document.getElementById('success-alert');
                    const errorAlert = document.getElementById('error-alert');
                    
                    if (successAlert) {
                        successAlert.style.transition = 'opacity 0.5s ease-out';
                        successAlert.style.opacity = '0';
                        setTimeout(() => successAlert.remove(), 500);
                    }
                    
                    if (errorAlert) {
                        errorAlert.style.transition = 'opacity 0.5s ease-out';
                        errorAlert.style.opacity = '0';
                        setTimeout(() => errorAlert.remove(), 500);
                    }
                }, 5000);

                // Manual close function
                function closeAlert(id) {
                    const alert = document.getElementById(id);
                    if (alert) {
                        alert.style.transition = 'opacity 0.3s ease-out';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 300);
                    }
                }
            </script>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
