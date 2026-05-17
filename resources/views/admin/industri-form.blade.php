@extends('admin.layouts.app')

@section('title', isset($mitra) ? 'Edit Industri' : 'Tambah Industri')

@section('content')
<div style="background-color: #F3F4F6; min-height: calc(100vh - 68px); padding: 40px 0;">
    <div class="max-w-2xl mx-auto px-4">

        <div class="bg-white rounded-2xl p-8 shadow-sm">

            @if($errors->any())
                <div class="mb-4 p-3 rounded-xl text-sm" style="background:#FEE2E2; color:#B91C1C;">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <form method="POST" enctype="multipart/form-data"
                  action="{{ isset($mitra) ? route('admin.industri.update', $mitra->id_industri) : route('admin.industri.store') }}">
                @csrf
                @if(isset($mitra)) @method('PUT') @endif

                {{-- Nama Perusahaan --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Perusahaan</label>
                    <input type="text" name="nama_industri"
                           value="{{ old('nama_industri', $mitra->nama_industri ?? '') }}"
                           placeholder="Contoh: Bamboo Media"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Jurusan --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jurusan</label>
                    <div class="relative">
                        <select name="kategori"
                            class="w-full appearance-none px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white pr-8">
                            <option value="">Pilih Jurusan</option>
                            @foreach(['Rekayasa Perangkat Lunak (RPL)', 'Teknik Komputer dan Jaringan (TKJ)', 'Desain Komunikasi Visual (DKV)', 'Produksi Film (PRF)', 'Teknik Kendaraan Ringan (TKR)', 'Teknik Sepeda Motor (TSM)', 'Teknik Pemesinan (TPM)', 'Teknik Audio Video (TAV)', 'Teknik Instalasi Tenaga Listrik (TITL)', 'Teknik Pendingin, Tata Udara, dan Pemanasan (TPTUP)', 'Teknik Konstruksi dan Perumahan (TKP)', 'Desain Pemodelan dan Informasi Bangunan (DPIB)'] as $j)
                                <option value="{{ $j }}" {{ old('kategori', $mitra->kategori ?? '') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                </div>

                {{-- Kontak & Instagram --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kontak / No. HP</label>
                        <input type="text" name="kontak"
                               value="{{ old('kontak', $mitra->kontak ?? '') }}"
                               placeholder="021-5550982"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram</label>
                        <input type="text" name="instagram"
                               value="{{ old('instagram', $mitra->instagram ?? '') }}"
                               placeholder="@igperusahaan"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                {{-- Email & Alamat (gabungkan lokasi ke alamat) --}}
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Perusahaan</label>
                        <input type="email" name="email_perusahaan"
                               value="{{ old('email_perusahaan', $mitra->email_perusahaan ?? '') }}"
                               placeholder="perusahaan@gmail.com"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat / Lokasi</label>
                        <input type="text" name="alamat"
                               value="{{ old('alamat', $mitra->alamat ?? $mitra->lokasi ?? '') }}"
                               placeholder="Jl. Bali No. 12211, Denpasar, Bali"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                {{-- Jumlah Siswa --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Siswa PKL</label>
                    <input type="number" name="jumlah_siswa_pkl"
                           value="{{ old('jumlah_siswa_pkl', $mitra->jumlah_siswa_pkl ?? '') }}"
                           placeholder="0"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Perusahaan</label>
                    <textarea name="deskripsi" rows="4"
                              placeholder="Deskripsi singkat tentang perusahaan..."
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('deskripsi', $mitra->detail?->deskripsi ?? '') }}</textarea>
                </div>

                {{-- Posisi Magang --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Posisi Magang</label>
                    <input type="text" name="posisi_magang"
                           value="{{ old('posisi_magang', $mitra->detail?->posisi_magang ?? '') }}"
                           placeholder="Frontend Developer, UI/UX Designer, Backend Developer"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">Pisahkan dengan koma jika lebih dari satu posisi</p>
                </div>

                {{-- Upload Logo --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unggah Logo Perusahaan</label>

                    {{-- Preview logo jika edit --}}
                    @if(isset($mitra) && $mitra->gambar)
                    <div class="mb-3">
                        <img src="{{ $mitra->gambar }}" alt="Logo saat ini"
                             class="w-16 h-16 rounded-xl object-cover border border-gray-200">
                        <p class="text-xs text-gray-400 mt-1">Logo saat ini. Upload baru untuk mengganti.</p>
                    </div>
                    @endif

                    <label for="logo"
                           class="flex flex-col items-center justify-center w-full py-6 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 transition"
                           style="background:#FAFAFA;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.5" class="mb-2">
                            <polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/>
                            <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Unggah Logo</span>
                        <span class="text-xs text-gray-400 mt-1">Maksimal 10MB</span>
                        <input id="logo" type="file" name="logo" accept="image/*" class="hidden"
                               onchange="previewLogo(this)">
                    </label>
                    <div id="logo-preview" class="mt-3 hidden">
                        <img id="logo-img" src="" alt="Preview" class="w-16 h-16 rounded-xl object-cover border border-gray-200">
                        <p id="logo-name" class="text-xs text-gray-500 mt-1"></p>
                    </div>
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
function previewLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logo-img').src = e.target.result;
            document.getElementById('logo-name').textContent = input.files[0].name;
            document.getElementById('logo-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection