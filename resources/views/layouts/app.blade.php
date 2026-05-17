<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JejakPKL - @yield('title', 'Temukan Mitra PKL Terbaik')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            opacity: 0;
            animation: fadeIn 0.3s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #2563EB;
            transition: width 0.25s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        /* Smooth anchor scroll offset for sticky navbar */
        [id] {
            scroll-margin-top: 80px;
        }

        /* Section fade-in on scroll */
        .section-animate {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .section-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Footer link hover */
        .footer-link {
            color: #9CA3AF;
            font-size: 0.875rem;
            transition: color 0.2s;
        }
        .footer-link:hover {
            color: #fff;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    {{-- ==================== NAVBAR ==================== --}}
    <nav class="bg-white sticky top-0 z-50" style="border-bottom: 1px solid #E5E7EB;">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex justify-between items-center" style="height: 68px;">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                         fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    <span style="font-weight: 800; font-size: 1.1rem; color: #2563EB;">JejakPKL</span>
                </a>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center gap-10">
                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('admin.industri') }}"
                           class="nav-link text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                            Kelola Industri
                        </a>
                        <a href="{{ route('admin.cerita') }}"
                           class="nav-link text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                            Kelola Cerita
                        </a>
                    @endif
                    <a href="{{ route('home') }}#home"
                       class="nav-link text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                        Home
                    </a>
                    <a href="{{ route('home') }}#industri"
                       class="nav-link text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                        Industries
                    </a>
                    <a href="{{ route('home') }}#cerita-pkl"
                       class="nav-link text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                        Cerita PKL
                    </a>
                </div>

                {{-- User Info + Logout --}}
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-gray-600">
                        {{ Auth::user()->name ?? Auth::guard('admin')->user()->name ?? '' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-semibold text-white rounded-lg px-4 py-2 hover:opacity-90 transition"
                            style="background-color: #2563EB;">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
{{-- ==================== FOOTER ==================== --}}
    <footer style="background-color: #0F172A; color: #94A3B8; width: 100%;">

        {{-- Main Footer --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10">
            
            {{-- Grid Murni dipaksa ke samping, otomatis membagi rata ke 3 kolom --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 40px; align-items: start;">

                {{-- Kolom 1: Brand (Tanpa Sosmed) --}}
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                        <span style="font-weight: 800; font-size: 1.1rem; color: #fff;">JejakPKL</span>
                    </div>
                    <p style="font-size: 0.85rem; line-height: 1.6; color: #94A3B8; margin: 0;">
                        Platform pemetaan industri dan repositori laporan magang siswa SMK Negeri 1 Denpasar.
                    </p>
                </div>

                {{-- Kolom 2: Platform --}}
                <div>
                    <h4 style="color:#fff; font-weight: 700; font-size: 0.85rem; margin-top: 0; margin-bottom: 16px; letter-spacing: 0.05em;">
                        PLATFORM
                    </h4>
                    <ul class="space-y-2.5" style="list-style: none; padding: 0; margin: 0;">
                        <li><a href="{{ route('home') }}#home" class="footer-link" style="font-size: 0.85rem; text-decoration: none;">Beranda</a></li>
                        <li><a href="{{ route('home') }}#industri" class="footer-link" style="font-size: 0.85rem; text-decoration: none;">Daftar Industri</a></li>
                        <li><a href="{{ route('home') }}#cerita-pkl" class="footer-link" style="font-size: 0.85rem; text-decoration: none;">Cerita PKL</a></li>
                        <li><a href="{{ route('cerita-pkl.create') }}" class="footer-link" style="font-size: 0.85rem; text-decoration: none;">Bagikan Pengalaman</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak --}}
                <div>
                    <h4 style="color:#fff; font-weight: 700; font-size: 0.85rem; margin-top: 0; margin-bottom: 16px; letter-spacing: 0.05em;">
                        KONTAK
                    </h4>
                    <ul class="space-y-3" style="list-style: none; padding: 0; margin: 0;">
                        <li class="flex items-center gap-2.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" class="flex-shrink-0">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span style="font-size:0.85rem; color: #94A3B8;">Denpasar, Bali</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" class="flex-shrink-0">
                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            <span style="font-size:0.85rem; color: #94A3B8;">info@jejakpkl.id</span>
                        </li>
                    </ul>
                </div>

            </div> {{-- Akhir dari Grid Murni --}}
        </div>

        {{-- Bottom Bar (Hanya Hak Cipta, Bersih dari Link) --}}
        <div style="border-top: 1px solid #1E293B; padding: 16px 0;">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between">
                <p style="font-size: 0.78rem; margin: 0; color: #94A3B8;">
                    © 2026 <span style="color:#fff; font-weight:600;">JejakPKL</span>. Kelompok 3 RPL.
                </p>
            </div>
        </div>

    </footer>

    @stack('scripts')

    <script>
        // ===== Smooth page transition =====
        document.addEventListener('DOMContentLoaded', function () {
            // Fade out saat pindah halaman
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (!href || href.startsWith('#') || href.startsWith('http') ||
                        this.target === '_blank' || href === 'javascript:void(0)') return;
                    e.preventDefault();
                    document.body.style.opacity = '0';
                    document.body.style.transform = 'translateY(8px)';
                    document.body.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                    setTimeout(() => { window.location.href = href; }, 220);
                });
            });

            // ===== Section scroll animation =====
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.section-animate').forEach(el => {
                observer.observe(el);
            });

            // ===== Active navbar highlight on scroll =====
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 100;
                    if (window.scrollY >= sectionTop) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.style.color = '#374151';
                    if (link.getAttribute('href').includes(current)) {
                        link.style.color = '#2563EB';
                    }
                });
            });
        });
    </script>

</body>
</html>