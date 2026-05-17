<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JejakPKL - Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family: 'Plus Jakarta Sans', sans-serif; background-color: #EAF4FB; min-height: 100vh;" class="flex items-center justify-center">

<div class="w-full max-w-md mx-auto px-4 py-12">

    <div class="text-center mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
             fill="none" stroke="#2563EB" stroke-width="2" class="mx-auto mb-3">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
        <h1 style="font-weight: 800; font-size: 1.5rem; color: #2563EB;">JejakPKL</h1>
        <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px;">Admin Panel</p>
    </div>

    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
        <h2 class="font-bold text-gray-900 text-center mb-6" style="font-size: 1.6rem;">Login Admin</h2>

        @if($errors->any())
            <div class="mb-4 p-3 rounded-xl text-sm" style="background:#FEE2E2; color:#B91C1C;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Admin</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@jejakpkl.com" required
                           class="w-full pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="••••••••" required
                           class="w-full pl-10 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           style="background:#F3F4F6; border: 1.5px solid #E5E7EB;">
                </div>
            </div>

            <button type="submit" class="w-full text-white font-semibold py-3 rounded-xl hover:opacity-90 transition"
                    style="background-color: #1D4ED8; font-size: 0.95rem;">
                Masuk sebagai Admin
            </button>

            <p class="text-center text-sm text-gray-500 mt-5">
                <a href="{{ route('login') }}" style="color:#2563EB;" class="font-semibold">← Kembali ke Login User</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>