<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JejakPKL - Daftar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="font-family: 'Plus Jakarta Sans', sans-serif; background-color: #EAF4FB; min-height: 100vh;">

    <div class="flex min-h-screen">

        {{-- KIRI: Form Register --}}
        <div class="flex-1 flex flex-col items-center justify-center px-8 py-12 bg-white">

            {{-- Logo --}}
            <div class="text-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="mx-auto mb-3">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
                <h1 style="font-weight: 800; font-size: 1.5rem; color: #2563EB;">JejakPKL</h1>
                <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px;">Langkah awal menuju karier profesional
                    Anda</p>
            </div>

            {{-- Card Form --}}
            <div class="w-full max-w-md bg-white rounded-2xl p-8"
                style="box-shadow: 0 4px 24px rgba(0,0,0,0.08); border: 1px solid #F3F4F6;">

                <h2 class="font-bold text-gray-900 text-center mb-6" style="font-size: 1.6rem;">Register</h2>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-xl text-sm" style="background:#FEE2E2; color:#B91C1C;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap Anda" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com"
                                required
                                class="w-full pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                                required
                                class="w-full pl-10 pr-10 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>



                    {{-- Tombol Daftar --}}
                    <button type="submit"
                        class="w-full text-white font-semibold py-3 rounded-xl transition-all duration-150 shadow-md hover:shadow-lg hover:translate-y-0 active:translate-y-1 flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%); font-size: 0.95rem;">
                        Daftar Sekarang
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>

                    {{-- Link Login --}}
                    <p class="text-center text-sm text-gray-500 mt-5">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold" style="color:#2563EB;">Masuk</a>
                    </p>
                </form>
            </div>
        </div>

        {{-- KANAN: Ilustrasi --}}
        <div class="hidden lg:flex flex-1 items-center justify-center p-12" style="background-color: #EAF4FB;">
            <img src="{{ asset('images/ilustrasi-login.png') }}" alt="Ilustrasi Register"
                class="w-full max-w-lg object-contain" onerror="this.style.display='none'">
        </div>

    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                btn.style.color = '#2563EB';
            } else {
                input.type = 'password';
                btn.style.color = '';
            }
        }
    </script>

</body>

</html>