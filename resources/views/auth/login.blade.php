<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JejakPKL - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    style="font-family: 'Plus Jakarta Sans', sans-serif; background-color: #EAF4FB; height: 100vh; margin: 0; padding: 0; overflow: hidden;">

    <div class="flex min-h-screen">

        {{-- KIRI: Ilustrasi --}}
        <div class="hidden lg:flex flex-1 items-center justify-center p-12" style="background-color: #EAF4FB;">
            {{--
            Taruh ilustrasi login di: public/images/ilustrasi-login.png
            (gunakan gambar ilustrasi siswa di laptop dari design kamu)
            --}}
            <img src="{{ asset('images/ilustrasi-login.png') }}" alt="Ilustrasi Login"
                class="w-full max-w-lg object-contain" onerror="this.style.display='none'">
        </div>

        {{-- KANAN: Form Login --}}
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

                <h2 class="font-bold text-gray-900 text-center mb-6" style="font-size: 1.6rem;">Login</h2>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-xl text-sm" style="background:#FEE2E2; color:#B91C1C;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"
                                required
                                class="w-full pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-sm font-semibold text-gray-700">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-semibold"
                                    style="color:#2563EB;">Lupa Kata Sandi?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <input type="password" name="password" id="password" placeholder="••••••••" required
                                class="w-full pl-10 pr-10 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                            {{-- Toggle show/hide password --}}
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

                    {{-- Tombol Masuk --}}
                    <button type="submit"
                        class="w-full text-white font-semibold py-3 rounded-xl transition-all duration-150 shadow-md hover:shadow-lg hover:translate-y-0 active:translate-y-1"
                        style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%); font-size: 0.95rem;">
                        Masuk
                    </button>

                    {{-- Link Register --}}
                    <p class="text-center text-sm text-gray-500 mt-5">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-semibold" style="color:#2563EB;">Daftar</a>
                    </p>
                </form>
            </div>
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