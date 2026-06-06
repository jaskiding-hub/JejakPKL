@extends('layouts.app')

@section('title', $mitra->nama_industri)

@section('content')

    <div style="background-color: #EAF4FB; min-height: calc(100vh - 68px); padding: 40px 0;">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Back --}}
            <a href="{{ route('home') }}#industri" class="flex items-center gap-2 text-sm font-semibold mb-8"
                style="color: #2563EB;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                JejakPKL
            </a>

            {{-- Nama, Gambar & Kategori --}}
            <div class="mb-10">
                <div class="flex items-center gap-6 justify-center md:justify-start">
                    <div class="flex-shrink-0">
                        <img src="{{ $mitra->gambar ?? 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&q=80' }}"
                             alt="Logo {{ $mitra->nama_industri }}"
                             class="rounded-xl object-cover border border-gray-100"
                             style="width:126px; height:126px;">
                    </div>
                    <div>
                        <h1 class="font-extrabold text-gray-900 mb-2" style="font-size: 2rem;">{{ $mitra->nama_industri }}</h1>
                        <div class="flex items-center gap-1.5 text-gray-500 text-sm">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                <path d="M6 12v5c3 3 9 3 12 0v-5" />
                            </svg>
                            {{ $mitra->kategori }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            @if($mitra->detail?->deskripsi)
                <div class="mb-8">
                    <p class="text-gray-700 leading-relaxed" style="font-size: 1rem;">
                        {{ $mitra->detail->deskripsi }}
                    </p>
                </div>
                <hr class="border-gray-300 mb-8">
            @endif

            {{-- Posisi Magang --}}
            @if($mitra->detail?->posisi_magang)
                <div class="mb-10">
                    <h2 class="font-bold text-gray-900 mb-5" style="font-size: 1.3rem;">Posisi Magang</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(explode(',', $mitra->detail->posisi_magang) as $posisi)
                            <div class="bg-white rounded-xl p-4 flex items-center gap-3 shadow-sm border border-gray-100">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.8">
                                    <circle cx="9" cy="6" r="3" />
                                    <path d="M2 20c0-4 3.13-7 7-7" />
                                    <circle cx="18" cy="17" r="2" />
                                    <path d="M18 13v1M18 21v1M14 17h1M21 17h1M15.5 14.5l.7.7M20.5 19.5l.7.7M15.5 19.5l.7-.7M20.5 14.5l.7-.7" />
                                </svg>
                                <span class="font-semibold text-gray-900 text-sm">{{ trim($posisi) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Info Kontak --}}
            @if($mitra->kontak || $mitra->instagram || $mitra->email_perusahaan || $mitra->alamat)
                <h2 class="font-bold text-gray-900 mb-4" style="font-size: 1.3rem;">Kontak</h2>
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8">
                    <div class="grid grid-cols-2 gap-6">

                        @if($mitra->kontak)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $mitra->kontak) }}" target="_blank" class="flex items-center gap-3 hover:opacity-80 transition">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:#EFF6FF;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-400 mb-0.5">WhatsApp</div>
                                    <div class="font-bold text-gray-900 text-sm hover:text-blue-600">{{ $mitra->kontak }}</div>
                                </div>
                            </a>
                        @endif

                        @if($mitra->instagram)
                            <a href="https://instagram.com/{{ str_replace(['@', ' '], '', $mitra->instagram) }}" target="_blank" class="flex items-center gap-3 hover:opacity-80 transition">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:#EFF6FF;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-400 mb-0.5">Instagram</div>
                                    <div class="font-bold text-gray-900 text-sm hover:text-blue-600">{{ $mitra->instagram }}</div>
                                </div>
                            </a>
                        @endif

                        @if($mitra->email_perusahaan)
                            <a href="mailto:{{ $mitra->email_perusahaan }}" class="flex items-center gap-3 hover:opacity-80 transition">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:#EFF6FF;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-400 mb-0.5">Email</div>
                                    <div class="font-bold text-gray-900 text-sm hover:text-blue-600">{{ $mitra->email_perusahaan }}</div>
                                </div>
                            </a>
                        @endif

                        @if($mitra->alamat)
                            <a href="https://maps.google.com/?q={{ urlencode($mitra->alamat) }}" target="_blank" class="flex items-center gap-3 hover:opacity-80 transition">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:#EFF6FF;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-400 mb-0.5">Alamat</div>
                                    <div class="font-bold text-gray-900 text-sm hover:text-blue-600">{{ $mitra->alamat }}</div>
                                </div>
                            </a>
                        @endif

                    </div>
                </div>

                {{-- ==================== PETA LOKASI ==================== --}}

                @if($mitra->latitude && $mitra->longitude)
                    {{-- ✅ Mode Presisi: Koordinat tersimpan → Leaflet langsung zoom ke titik lokasi --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200 mb-8" style="position: relative; z-index: 0;">
                        <div id="map-detail" style="height: 400px; width: 100%;"></div>

                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

                        <style>
                            .leaflet-pane, .leaflet-tile-pane   { z-index: 10 !important; }
                            .leaflet-overlay-pane               { z-index: 11 !important; }
                            .leaflet-shadow-pane                { z-index: 12 !important; }
                            .leaflet-marker-pane                { z-index: 13 !important; }
                            .leaflet-tooltip-pane               { z-index: 14 !important; }
                            .leaflet-popup-pane                 { z-index: 15 !important; }
                            .leaflet-top, .leaflet-bottom       { z-index: 16 !important; }
                            .leaflet-control-zoom { background: white !important; border: 1px solid #e5e7eb !important; border-radius: 8px !important; box-shadow: 0 2px 8px rgba(0,0,0,.1) !important; }
                            .leaflet-control-zoom a { color: #2563EB !important; font-weight: bold; }
                            .leaflet-control-zoom a:hover { background: #f3f4f6 !important; }
                            .leaflet-popup-content-wrapper { background: white !important; border-radius: 8px !important; box-shadow: 0 4px 12px rgba(0,0,0,.15) !important; border: 1px solid #e5e7eb !important; }
                            .leaflet-popup-content { font-family: 'Plus Jakarta Sans', sans-serif !important; font-size: 13px !important; }
                        </style>

                        <script>
                        (function () {
                            var lat  = {{ $mitra->latitude }};
                            var lng  = {{ $mitra->longitude }};
                            var name = @json($mitra->nama_industri);
                            var addr = @json($mitra->alamat ?? '');

                            function boot() {
                                if (typeof L === 'undefined') { setTimeout(boot, 200); return; }

                                var map = L.map('map-detail', { preferCanvas: true })
                                           .setView([lat, lng], 17);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
                                    maxZoom: 19
                                }).addTo(map);

                                var icon = L.icon({
                                    iconUrl:     'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                                    shadowUrl:   'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize:    [25, 41],
                                    iconAnchor:  [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize:  [41, 41]
                                });

                                var popupHtml = '<strong style="color:#2563EB;">' + name + '</strong>'
                                              + (addr ? '<br/><small style="color:#6B7280;">' + addr + '</small>' : '');

                                L.marker([lat, lng], { icon: icon })
                                 .addTo(map)
                                 .bindPopup(popupHtml)
                                 .openPopup();
                            }

                            if (document.readyState === 'loading') {
                                document.addEventListener('DOMContentLoaded', boot);
                            } else {
                                boot();
                            }
                        })();
                        </script>
                    </div>

                @elseif($mitra->alamat)
                    {{-- ✅ Mode Alamat: Google Maps Embed — langsung zoom ke lokasi berdasarkan alamat --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200 mb-8" style="position: relative; z-index: 0;">
                        <iframe
                            width="100%"
                            height="400"
                            style="border: 0; display: block;"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?q={{ urlencode($mitra->alamat) }}&output=embed&z=16">
                        </iframe>
                        <div style="padding: 10px 16px; background: #f9fafb; border-top: 1px solid #e5e7eb; display: flex; align-items: center; gap: 8px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span style="font-size: 12px; color: #6B7280;">{{ $mitra->alamat }}</span>
                            <a href="https://maps.google.com/?q={{ urlencode($mitra->alamat) }}" target="_blank"
                               style="margin-left: auto; font-size: 12px; color: #2563EB; font-weight: 600; text-decoration: none; white-space: nowrap;">
                                Buka di Maps ↗
                            </a>
                        </div>
                    </div>
                @endif

            @endif

        </div>
    </div>

@endsection