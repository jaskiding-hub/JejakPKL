<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JejakPKL Admin - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    {{-- NAVBAR ADMIN --}}
    <nav class="bg-white sticky top-0 z-50" style="border-bottom: 1px solid #E5E7EB;">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex justify-between items-center" style="height: 68px;">

                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                        stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                    </svg>
                    <span style="font-weight: 800; font-size: 1.1rem; color: #2563EB;">JejakPKL</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('admin.industri') }}" class="text-sm font-semibold transition"
                        style="color: {{ request()->routeIs('admin.industri*') ? '#2563EB' : '#374151' }};">
                        Kelola Industri
                    </a>
                    <a href="{{ route('admin.cerita') }}" class="text-sm font-semibold transition"
                        style="color: {{ request()->routeIs('admin.cerita*') ? '#2563EB' : '#374151' }};">
                        Kelola Cerita PKL
                    </a>
                    <a href="{{ route('home') }}#home"
                        class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Home</a>
                    <a href="{{ route('home') }}#industri"
                        class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Industries</a>
                    <a href="{{ route('home') }}#cerita-pkl"
                        class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Cerita PKL</a>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold px-4 py-2 rounded-lg border border-gray-200 text-gray-600">
                        {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                    </span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-semibold text-white rounded-lg px-4 py-2 hover:opacity-90 transition"
                            style="background-color: #2563EB;">
                            Log Out
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>

</html>