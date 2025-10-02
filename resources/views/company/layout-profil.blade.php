{{-- resources/views/layouts/company.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Glints for Employers')</title>
    @vite('resources/css/app.css')
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white border-gray">
        <div class="max-w-7xl mx-auto px-2 py-1 flex justify-between items-center">

            {{-- Kiri: Logo --}}
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo dan teks glints.png') }}" alt="Glints Logo" class="h-15 w-auto">
            </div>

            {{-- Kanan: Login & Language --}}
            <div class="flex items-center space-x-4">

                {{-- Tombol Masuk --}}
                <a href="#"
                class="px-4 py-1.5 border rounded text-xs font-medium hover:bg-gray-100">
                    Hubungi Bantuan
                </a>

            </div>
        </div>
    </nav>

<script>
    // Dropdown toggle
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('languageDropdownButton');
        const menu = document.getElementById('languageDropdownMenu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Klik di luar dropdown -> close
        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>


    {{-- Konten --}}
    <main>
        @yield('content')
    </main>

</body>
</html>
