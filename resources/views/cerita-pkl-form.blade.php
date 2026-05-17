@extends('layouts.app')

@section('title', 'Bagikan Pengalaman PKL')

@section('content')

<div style="background-color: #F3F4F6; min-height: calc(100vh - 68px); padding: 40px 0;">
    <div class="max-w-2xl mx-auto px-4">

        {{-- Back --}}
        <a href="{{ route('home') }}#cerita-pkl"
           class="flex items-center gap-2 text-sm font-semibold mb-6"
           style="color: #2563EB;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Bagikan Pengalaman
        </a>

        <div class="bg-white rounded-2xl p-8 shadow-sm">

            @if($errors->any())
                <div class="mb-4 p-3 rounded-xl text-sm" style="background:#FEE2E2; color:#B91C1C;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('cerita-pkl.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}"
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Tahun + Jurusan --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Lulus / Angkatan</label>
                        <div class="relative">
                            <select name="angkatan"
                                class="w-full appearance-none px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white pr-8">
                                <option value="">Pilih Tahun</option>
                                @for($y = date('Y'); $y >= 2018; $y--)
                                    <option value="{{ $y }}" {{ old('angkatan') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jurusan</label>
                        <div class="relative">
                            <select name="jurusan"
                                class="w-full appearance-none px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white pr-8">
                                <option value="">Pilih Jurusan</option>
                                @foreach(['Rekayasa Perangkat Lunak (RPL)', 'Teknik Komputer dan Jaringan (TKJ)', 'Desain Komunikasi Visual (DKV)', 'Produksi Film (PRF)', 'Teknik Kendaraan Ringan (TKR)', 'Teknik Sepeda Motor (TSM)', 'Teknik Pemesinan (TPM)', 'Teknik Audio Video (TAV)', 'Teknik Instalasi Tenaga Listrik (TITL)', 'Teknik Pendingin, Tata Udara, dan Pemanasan (TPTUP)', 'Teknik Konstruksi dan Perumahan (TKP)', 'Desain Pemodelan dan Informasi Bangunan (DPIB)'] as $j)
                                    <option value="{{ $j }}" {{ old('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Nama Mitra --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Mitra Industri</label>
                    <input type="text" name="nama_industri" value="{{ old('nama_industri') }}"
                           placeholder="Contoh: PT. Teknologi Maju Bersama"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Review --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Review Pengalaman</label>
                    <textarea name="cerita" rows="5"
                              placeholder="Ceritakan detail tugas, budaya kerja, dan pembelajaran yang Anda dapatkan..."
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('cerita') }}</textarea>
                </div>

                {{-- Upload PDF --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unggah Laporan PDF</label>
                    <label for="file_laporan"
                           class="flex flex-col items-center justify-center w-full py-8 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 transition"
                           style="background:#FAFAFA;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.5" class="mb-2">
                            <polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/>
                            <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Unggah Laporan PDF</span>
                        <span class="text-xs text-gray-400 mt-1">Maksimal 10MB</span>
                        <input id="file_laporan" type="file" name="file_laporan" accept=".pdf" class="hidden">
                    </label>
                    <p id="file-name" class="text-xs text-gray-500 mt-2"></p>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full text-white font-semibold py-3 rounded-xl hover:opacity-90 transition"
                    style="background-color: #1D4ED8; font-size: 1rem;">
                    Save
                </button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-6 flex items-center justify-center gap-1">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                Informasi Anda akan ditinjau sebelum dipublikasikan di platform.
            </p>
        </div>
    </div>
</div>

<script>
document.getElementById('file_laporan').addEventListener('change', function(e) {
    const name = e.target.files[0]?.name || '';
    document.getElementById('file-name').textContent = name ? `File dipilih: ${name}` : '';
});
</script>

@endsection