@extends('admin.layouts.app')

@section('title', isset($cerita) ? 'Edit Cerita PKL' : 'Edit Cerita PKL')

@section('content')
<div class="max-w-3xl mx-auto px-6 lg:px-12 py-10">
    <div class="mb-6">
        <a href="{{ route('admin.cerita') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Kelola Cerita
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Cerita PKL</h1>

        @if($errors->any())
            <div class="mb-4 p-4 rounded-xl text-sm text-red-700 bg-red-50 border border-red-200">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.cerita.update', $cerita->id_pengalaman) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $cerita->nama_siswa) }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: Budi Santoso">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Lulus / Angkatan</label>
                    <select name="angkatan" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Tahun</option>
                        @for($y = date('Y'); $y >= 2018; $y--)
                            <option value="{{ $y }}" {{ old('angkatan', $cerita->angkatan) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jurusan</label>
                    <select name="jurusan" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Jurusan</option>
                        @foreach(['Rekayasa Perangkat Lunak (RPL)', 'Teknik Komputer dan Jaringan (TKJ)', 'Teknik Instalasi Tenaga Listrik (TITL)', 'Teknik Kendaraan Ringan (TKR)', 'Teknik Sepeda Motor (TSM)', 'Teknik Pemesinan (TPM)', 'Teknik Audio Video (TAV)', 'Teknik Konstruksi dan Perumahan (TKP)', 'Teknik Pendingin, Tata Udara, dan Pemanasan (TPTUP)', 'Desain Komunikasi Visual (DKV)', 'Desain Pemodelan dan Informasi Bangunan (DPIB)', 'Produksi Film (PRF)'] as $j)
                            <option value="{{ $j }}" {{ old('jurusan', $cerita->jurusan) === $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Mitra Industri</label>
                <input type="text" name="nama_industri" value="{{ old('nama_industri', $cerita->nama_industri) }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: PT. Teknologi Maju Bersama">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cerita</label>
                <textarea name="cerita" rows="6" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                          placeholder="Ubah cerita pengalaman PKL...">{{ old('cerita', $cerita->cerita) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Laporan PDF</label>
                <input type="file" name="file_laporan" accept=".pdf" class="block w-full text-sm text-gray-700" />
                @if($cerita->file_laporan)
                    <p class="text-xs text-gray-500 mt-2">File saat ini: <a href="{{ asset('storage/' . $cerita->file_laporan) }}" target="_blank" class="text-blue-600 hover:underline">lihat laporan</a></p>
                @endif
            </div>

            <button type="submit" class="w-full rounded-xl py-3 font-semibold transition"
                    style="background-color: #2563EB; color: #ffffff; border: none;">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection