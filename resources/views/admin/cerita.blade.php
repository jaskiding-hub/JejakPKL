@extends('admin.layouts.app')

@section('title', 'Kelola Cerita PKL')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-12 py-10">

    {{-- Header --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="font-extrabold text-gray-900" style="font-size: 1.8rem;">Kelola Cerita PKL</h1>
            <p class="text-gray-500 text-sm mt-1">Pusat kontrol berbagi pengalaman dan laporan PKL di JejakPKL.</p>
        </div>
        <a href="{{ route('cerita-pkl.create') }}"
           class="flex items-center gap-2 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:opacity-90 transition"
           style="background-color: #2563EB;">
            Bagikan Pengalaman
        </a>
    </div>

    {{-- Success --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded-xl text-sm" style="background:#DCFCE7; color:#15803D;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

        {{-- Header Tabel --}}
        <div class="flex items-center justify-between px-6 py-4" style="background-color: #2563EB;">
            <h2 class="font-bold text-white" style="font-size: 1.1rem;">Daftar Siswa</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm font-bold text-white uppercase tracking-wide">Total: {{ $total }} Siswa</span>
                <form method="GET" action="{{ route('admin.cerita') }}">
                    <select name="jurusan" onchange="this.form.submit()" class="text-sm rounded-xl px-4 py-2 border-0 focus:outline-none w-48 max-w-full" style="background:white; color:#374151;">
                        <option value="Semua Jurusan" {{ $jurusan === 'Semua Jurusan' ? 'selected' : '' }}>Semua Jurusan</option>
                        @foreach($jurusans as $j)
                            @php
                                preg_match('/\(([^)]+)\)$/', $j, $matches);
                                $label = $matches[1] ?? $j;
                            @endphp
                            <option value="{{ $j }}" {{ $jurusan === $j ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        {{-- Column Headers --}}
        <div class="grid grid-cols-4 px-6 py-3 border-b border-gray-100">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nama</div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Perusahaan</div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Jurusan</div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</div>
        </div>

        {{-- Rows --}}
        @forelse($cerita as $item)
        <div class="grid grid-cols-4 px-6 py-4 border-b border-gray-50 hover:bg-gray-50 transition items-center">
            <div>
                <div class="font-semibold text-gray-900 text-sm">{{ $item->nama_siswa }}</div>
                <div class="text-xs text-gray-400">Alumni {{ $item->angkatan }}</div>
            </div>
            <div class="text-sm text-gray-600 text-center">{{ $item->nama_industri }}</div>
            <div class="text-center">
                <span class="text-xs font-bold text-gray-800">{{ $item->jurusan }}</span>
            </div>
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.cerita.edit', $item->id_pengalaman) }}"
                   class="text-gray-400 hover:text-blue-500 transition">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </a>
                {{-- Download laporan --}}
                @if($item->file_laporan)
                <a href="{{ asset('storage/' . $item->file_laporan) }}" download
                   class="text-gray-400 hover:text-blue-500 transition">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                </a>
                @endif
                {{-- Delete --}}
                <form method="POST" action="{{ route('admin.cerita.destroy', $item->id_pengalaman) }}"
                      onsubmit="return confirm('Yakin hapus cerita ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                            <path d="M10 11v6M14 11v6"/>
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="px-6 py-10 text-center text-gray-400 text-sm">
            Belum ada cerita PKL yang dibagikan.
        </div>
        @endforelse

    </div>

</div>
@endsection