<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-orange-500 mb-4">403</h1>
            <h2 class="text-3xl font-bold mb-4">Akses Ditolak</h2>
            <p class="text-gray-400 mb-8">Anda tidak memiliki akses ke halaman ini.</p>
            <a href="{{ route('home') }}" class="inline-block bg-orange-500 px-6 py-3 rounded-lg hover:bg-orange-600 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
