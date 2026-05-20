@extends('layouts.app')

@section('title', 'Temukan Mitra PKL yang Tepat')

@section('content')

{{-- ==================== HERO ==================== --}}
<section id="home" style="background-color: #EAF4FB; height: calc(100vh - 68px); scroll-margin-top: 68px;" class="flex items-center overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex-1 flex justify-center md:justify-start">
                <img src="{{ asset('images/hero.png') }}" alt="Hero"
                     class="w-full max-w-sm md:max-w-lg object-contain"
                     style="filter: drop-shadow(0px 10px 30px rgba(37,99,235,0.1));">
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="font-extrabold text-gray-900 leading-tight mb-5"
                    style="font-size: clamp(2.2rem, 4vw, 3.4rem); line-height: 1.15;">
                    Temukan Mitra PKL<br>yang Tepat untuk Anda
                </h1>
                <p class="text-gray-600 mb-8 leading-relaxed" style="font-size: 1.05rem; max-width: 480px;">
                    Cari perusahaan, jurusan, atau lokasi mitra praktik kerja lapangan dengan cepat.
                    Jelajahi ribuan mitra dari berbagai industri untuk pengalaman magang yang bermakna.
                </p>
                <a href="#industri"
                   class="inline-block text-white font-semibold rounded-lg transition-all duration-200 hover:opacity-90"
                   style="background-color: #1D4ED8; padding: 14px 32px; font-size: 1rem; box-shadow: 0 4px 16px rgba(29,78,216,0.35);">
                    Lihat Daftar Industri
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ==================== TOP MITRA ==================== --}}
<section id="industri" class="bg-white pt-12 pb-10" style="scroll-margin-top: 68px;">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <h1 class="font-extrabold text-gray-900 mb-2" style="font-size: 2rem;">Top Mitra Industri JejakPKL</h1>
        <p class="text-gray-500 mb-10" style="font-size: 0.95rem; max-width: 480px;">
            Daftar industri dengan jumlah siswa PKL terbanyak saat ini.
        </p>

        {{-- 3 Card Besar --}}
        <div id="top-mitra-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach($topMitra as $mitra)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="relative overflow-hidden" style="height: 180px;">
                    <img src="{{ $mitra->gambar ?? 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&q=80' }}"
                         alt="{{ $mitra->nama_industri }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    <div class="absolute bottom-3 left-3">
                        <span class="text-xs font-bold uppercase px-2 py-1 rounded-md"
                              style="background:rgba(0,0,0,0.5); color:#fff; backdrop-filter:blur(4px); letter-spacing:0.08em;">
                            {{ $mitra->kategori }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2" style="font-size: 1.35rem;">{{ $mitra->nama_industri }}</h3>
                    <p class="text-gray-400 text-sm mb-2 flex items-center gap-1.5">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                        </svg>
                        {{ $mitra->lokasi }}
                    </p>
                    <p class="text-gray-500 text-sm mb-4 flex items-center gap-1.5">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        {{ $mitra->jumlah_siswa_pkl }}+ Siswa PKL Tahun Ini
                    </p>
                    <a href="{{ route('industri.detail', $mitra->id_industri) }}"
                       class="flex items-center justify-center gap-2 w-full text-sm font-semibold py-2.5 rounded-xl border transition-all duration-150"
                       style="border-color:#D1D5DB; color:#374151;"
                       onmouseover="this.style.borderColor='#2563EB'; this.style.color='#2563EB';"
                       onmouseout="this.style.borderColor='#D1D5DB'; this.style.color='#374151';">
                        Lihat Detail
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination Top Mitra --}}
        <div id="top-pagination" class="flex justify-center items-center gap-2 mb-12">
            @if($topMitra->currentPage() > 1)
                <button onclick="loadTopMitra({{ $topMitra->currentPage() - 1 }})"
                    class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">‹</button>
            @else
                <button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">‹</button>
            @endif

            @for($i = 1; $i <= $topMitra->lastPage(); $i++)
                <button onclick="loadTopMitra({{ $i }})" class="w-9 h-9 rounded-xl text-sm font-semibold"
                    style="{{ $topMitra->currentPage() == $i ? 'background:#2563EB; color:#fff;' : 'border:1px solid #E5E7EB; color:#374151;' }}">
                    {{ $i }}
                </button>
            @endfor

            @if($topMitra->hasMorePages())
                <button onclick="loadTopMitra({{ $topMitra->currentPage() + 1 }})"
                    class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">›</button>
            @else
                <button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">›</button>
            @endif
        </div>

    </div>
</section>

{{-- ==================== SEMUA INDUSTRI ==================== --}}
<section style="background-color: #F3F4F6; padding: 40px 0;">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        {{-- Filter --}}
        <div class="bg-white rounded-2xl p-5 mb-8 flex flex-col md:flex-row gap-4 items-end shadow-sm border border-gray-100">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Perusahaan atau Posisi</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="search-input" placeholder="Contoh: PT Lorem, RPL..."
                           class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Pilih Jurusan</label>
                <div class="relative">
                    <select id="jurusan-select"
                        class="w-full appearance-none border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white pr-8">
                        <option value="Semua Jurusan">Semua Jurusan</option>
                        <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Teknik Komputer dan Jaringan (TKJ)">Teknik Komputer dan Jaringan (TKJ)</option>
                        <option value="Desain Komunikasi Visual (DKV)">Desain Komunikasi Visual (DKV)</option>
                        <option value="Produksi Film (PRF)">Produksi Film (PRF)</option>
                        <option value="Teknik Kendaraan Ringan (TKR)">Teknik Kendaraan Ringan (TKR)</option>
                        <option value="Teknik Sepeda Motor (TSM)">Teknik Sepeda Motor (TSM)</option>
                        <option value="Teknik Pemesinan (TPM)">Teknik Pemesinan (TPM)</option>
                        <option value="Teknik Audio Video (TAV)">Teknik Audio Video (TAV)</option>
                        <option value="Teknik Instalasi Tenaga Listrik (TITL)">Teknik Instalasi Tenaga Listrik (TITL)</option>
                        <option value="Teknik Pendingin, Tata Udara, dan Pemanasan (TPTUP)">Teknik Pendingin, Tata Udara, dan Pemanasan (TPTUP)</option>
                        <option value="Teknik Konstruksi dan Perumahan (TKP)">Teknik Konstruksi dan Perumahan (TKP)</option>
                        <option value="Desain Pemodelan dan Informasi Bangunan (DPIB)">Desain Pemodelan dan Informasi Bangunan (DPIB)</option>
                    </select>
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </div>
            </div>
            <button onclick="loadSemuaMitra(1)"
                class="flex items-center gap-2 text-sm font-semibold text-white rounded-xl px-6 py-2.5 hover:opacity-90 whitespace-nowrap"
                style="background-color: #2563EB;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Terapkan Filter
            </button>
        </div>

        {{-- Grid --}}
        <div id="semua-mitra-grid" class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            @foreach($semuaMitra as $mitra)
            <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <img src="{{ $mitra->gambar ?? 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&q=80' }}"
                         alt="{{ $mitra->nama_industri }}" class="w-12 h-12 rounded-xl object-cover">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-lg" style="background:#DBEAFE; color:#1D4ED8;">
                        {{ $mitra->kategori }}
                    </span>
                </div>
                <h3 class="font-bold text-gray-900 mb-1" style="font-size: 1rem;">{{ $mitra->nama_industri }}</h3>
                <p class="text-xs text-gray-400 flex items-center gap-1 mb-4">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $mitra->lokasi }}
                </p>
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <span class="text-xs text-gray-400">{{ $mitra->jumlah_siswa_pkl }} Kuota Tersisa</span>
                    <a href="{{ route('industri.detail', $mitra->id_industri) }}"
                       class="text-sm font-semibold flex items-center gap-1" style="color:#2563EB;"
                       onmouseover="this.style.color='#1D4ED8';" onmouseout="this.style.color='#2563EB';">
                        Lihat Detail
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination Semua Mitra --}}
        <div id="semua-pagination" class="flex justify-center items-center gap-2 pb-4">
            @if($semuaMitra->currentPage() > 1)
                <button onclick="loadSemuaMitra({{ $semuaMitra->currentPage() - 1 }})"
                    class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">‹</button>
            @else
                <button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">‹</button>
            @endif

            <button onclick="loadSemuaMitra(1)" class="w-9 h-9 rounded-xl text-sm font-semibold"
                style="{{ $semuaMitra->currentPage() == 1 ? 'background:#2563EB; color:#fff;' : 'border:1px solid #E5E7EB; color:#374151;' }}">1</button>

            @if($semuaMitra->currentPage() > 3)
                <span class="text-gray-400 text-sm px-1">...</span>
            @endif

            @for($i = max(2, $semuaMitra->currentPage() - 1); $i <= min($semuaMitra->lastPage() - 1, $semuaMitra->currentPage() + 1); $i++)
                <button onclick="loadSemuaMitra({{ $i }})" class="w-9 h-9 rounded-xl text-sm font-semibold"
                    style="{{ $semuaMitra->currentPage() == $i ? 'background:#2563EB; color:#fff;' : 'border:1px solid #E5E7EB; color:#374151;' }}">{{ $i }}</button>
            @endfor

            @if($semuaMitra->currentPage() < $semuaMitra->lastPage() - 2)
                <span class="text-gray-400 text-sm px-1">...</span>
            @endif

            @if($semuaMitra->lastPage() > 1)
                <button onclick="loadSemuaMitra({{ $semuaMitra->lastPage() }})" class="w-9 h-9 rounded-xl text-sm font-semibold"
                    style="{{ $semuaMitra->currentPage() == $semuaMitra->lastPage() ? 'background:#2563EB; color:#fff;' : 'border:1px solid #E5E7EB; color:#374151;' }}">{{ $semuaMitra->lastPage() }}</button>
            @endif

            @if($semuaMitra->hasMorePages())
                <button onclick="loadSemuaMitra({{ $semuaMitra->currentPage() + 1 }})"
                    class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">›</button>
            @else
                <button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">›</button>
            @endif
        </div>

    </div>
</section>

{{-- ==================== CERITA PKL ==================== --}}
<section id="cerita-pkl" class="py-12 bg-white" style="scroll-margin-top: 68px;">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Berbagi Pengalaman PKL</h1>
                <p class="text-gray-500 text-sm mt-1">Dengarkan cerita dan pelajari laporan dari alumni SMK.</p>
            </div>
            <a href="{{ route('cerita-pkl.create') }}"
               class="flex items-center gap-2 text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:opacity-90 transition"
               style="background-color: #2563EB;">
                Bagikan Pengalaman
            </a>
        </div>

        @if($cerita->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($cerita as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">
                       <img src="{{ asset('images/profilsiswa.png') }}" alt="Profil" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                        <div class="flex-1">
                            <div class="font-semibold text-gray-900 text-sm">{{ $item->nama_siswa }}</div>
                            <div class="text-xs text-gray-400">Alumni {{ $item->angkatan }} • {{ $item->nama_industri }}</div>
                        </div>
                        <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2 py-0.5 rounded-full">
                            {{ $item->jurusan }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $item->cerita }}</p>
                    @if($item->file_laporan)
                    <div class="mt-4 flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-medium text-gray-700">Laporan:</span>
                            <span class="text-xs font-medium text-gray-700">{{ basename($item->file_laporan) }}</span>
                        </div>
                        <a href="{{ Storage::url($item->file_laporan) }}"
                           class="text-xs text-blue-600 font-semibold hover:underline" download>
                            Download
                        </a>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-gray-400">
                <p class="text-lg font-semibold">Belum ada cerita PKL</p>
                <p class="text-sm mt-1">Jadilah yang pertama berbagi pengalaman!</p>
            </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
function loadTopMitra(page) {
    fetch(`/api/top-mitra?top_page=${page}`)
        .then(r => r.json())
        .then(data => {
            let html = '';
            data.data.forEach(m => {
                const gambar = m.gambar || 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&q=80';
                html += `
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                    <div class="relative overflow-hidden" style="height:180px;">
                        <img src="${gambar}" alt="${m.nama_industri}" class="w-full h-full object-cover">
                        <div class="absolute bottom-3 left-3">
                            <span class="text-xs font-bold uppercase px-2 py-1 rounded-md" style="background:rgba(0,0,0,0.5);color:#fff;backdrop-filter:blur(4px);">${m.kategori}</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2" style="font-size:1.35rem;">${m.nama_industri}</h3>
                        <p class="text-gray-400 text-sm mb-2">${m.lokasi}</p>
                        <p class="text-gray-500 text-sm mb-4">${m.jumlah_siswa_pkl}+ Siswa PKL Tahun Ini</p>
                        <a href="/industri/${m.id_industri}" class="flex items-center justify-center gap-2 w-full text-sm font-semibold py-2.5 rounded-xl border" style="border-color:#D1D5DB;color:#374151;">
                            Lihat Detail
                        </a>
                    </div>
                </div>`;
            });
            document.getElementById('top-mitra-grid').innerHTML = html;
            updateTopPagination(data.current_page, data.last_page);
            document.getElementById('industri').scrollIntoView({ behavior: 'smooth' });
        });
}

function updateTopPagination(current, last) {
    let html = current > 1
        ? `<button onclick="loadTopMitra(${current-1})" class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">‹</button>`
        : `<button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">‹</button>`;

    for (let i = 1; i <= last; i++) {
        html += `<button onclick="loadTopMitra(${i})" class="w-9 h-9 rounded-xl text-sm font-semibold" style="${i===current?'background:#2563EB;color:#fff;':'border:1px solid #E5E7EB;color:#374151;'}">${i}</button>`;
    }

    html += current < last
        ? `<button onclick="loadTopMitra(${current+1})" class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">›</button>`
        : `<button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">›</button>`;

    document.getElementById('top-pagination').innerHTML = html;
}

function loadSemuaMitra(page) {
    const search  = document.getElementById('search-input').value;
    const jurusan = document.getElementById('jurusan-select').value;

    fetch(`/api/semua-mitra?page=${page}&search=${encodeURIComponent(search)}&jurusan=${encodeURIComponent(jurusan)}`)
        .then(r => r.json())
        .then(data => {
            let html = '';
            data.data.forEach(m => {
                const gambar = m.gambar || 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&q=80';
                html += `
                <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-md transition-all duration-200">
                    <div class="flex items-start justify-between mb-4">
                        <img src="${gambar}" alt="${m.nama_industri}" class="w-12 h-12 rounded-xl object-cover">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-lg" style="background:#DBEAFE;color:#1D4ED8;">${m.kategori}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1" style="font-size:1rem;">${m.nama_industri}</h3>
                    <p class="text-xs text-gray-400 flex items-center gap-1 mb-4"> ${m.lokasi}</p>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xs text-gray-400">${m.jumlah_siswa_pkl} Kuota Tersisa</span>
                        <a href="/industri/${m.id_industri}" class="text-sm font-semibold flex items-center gap-1" style="color:#2563EB;">Lihat Detail</a>
                    </div>
                </div>`;
            });
            document.getElementById('semua-mitra-grid').innerHTML = html;
            updateSemuaPagination(data.current_page, data.last_page);
            document.getElementById('semua-mitra-grid').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
}

function updateSemuaPagination(current, last) {
    let html = current > 1
        ? `<button onclick="loadSemuaMitra(${current-1})" class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">‹</button>`
        : `<button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">‹</button>`;

    html += `<button onclick="loadSemuaMitra(1)" class="w-9 h-9 rounded-xl text-sm font-semibold" style="${current==1?'background:#2563EB;color:#fff;':'border:1px solid #E5E7EB;color:#374151;'}">1</button>`;
    if (current > 3) html += `<span class="text-gray-400 text-sm px-1">...</span>`;

    for (let i = Math.max(2, current-1); i <= Math.min(last-1, current+1); i++) {
        html += `<button onclick="loadSemuaMitra(${i})" class="w-9 h-9 rounded-xl text-sm font-semibold" style="${i==current?'background:#2563EB;color:#fff;':'border:1px solid #E5E7EB;color:#374151;'}">${i}</button>`;
    }

    if (current < last - 2) html += `<span class="text-gray-400 text-sm px-1">...</span>`;
    if (last > 1) html += `<button onclick="loadSemuaMitra(${last})" class="w-9 h-9 rounded-xl text-sm font-semibold" style="${current==last?'background:#2563EB;color:#fff;':'border:1px solid #E5E7EB;color:#374151;'}">${last}</button>`;

    html += current < last
        ? `<button onclick="loadSemuaMitra(${current+1})" class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-blue-400 transition">›</button>`
        : `<button class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">›</button>`;

    document.getElementById('semua-pagination').innerHTML = html;
}
</script>
@endpush