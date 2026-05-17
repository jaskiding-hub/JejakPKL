<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengalamanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCeritaController extends Controller
{
    public function index()
    {
        $jurusan = request('jurusan', 'Semua Jurusan');
        $jurusans = [
            'Rekayasa Perangkat Lunak (RPL)',
            'Teknik Komputer dan Jaringan (TKJ)',
            'Teknik Instalasi Tenaga Listrik (TITL)',
            'Teknik Kendaraan Ringan (TKR)',
            'Teknik Sepeda Motor (TSM)',
            'Teknik Pemesinan (TPM)',
            'Teknik Audio Video (TAV)',
            'Teknik Konstruksi dan Perumahan (TKP)',
            'Teknik Pendingin, Tata Udara, dan Pemanasan (TPTUP)',
            'Desain Komunikasi Visual (DKV)',
            'Desain Pemodelan dan Informasi Bangunan (DPIB)',
            'Produksi Film (PRF)',
        ];

        $query = PengalamanPKL::latest();
        if ($jurusan !== 'Semua Jurusan') {
            $query->where('jurusan', $jurusan);
        }

        $cerita = $query->get();
        $total = $cerita->count();

        return view('admin.cerita', compact('cerita', 'total', 'jurusans', 'jurusan'));
    }

    public function edit($id)
    {
        $cerita = PengalamanPKL::findOrFail($id);
        return view('admin.cerita-form', compact('cerita'));
    }

    public function update(Request $request, $id)
    {
        $cerita = PengalamanPKL::findOrFail($id);

        $request->validate([
            'nama_siswa'   => 'required|string|max:100',
            'angkatan'     => 'required|digits:4',
            'jurusan'      => 'required|string',
            'nama_industri'=> 'required|string|max:100',
            'cerita'       => 'required|string',
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_laporan')) {
            if ($cerita->file_laporan) {
                Storage::disk('public')->delete($cerita->file_laporan);
            }
            $cerita->file_laporan = $request->file('file_laporan')->store('laporan', 'public');
        }

        $cerita->update([
            'nama_siswa'    => $request->nama_siswa,
            'angkatan'      => $request->angkatan,
            'jurusan'       => $request->jurusan,
            'nama_industri' => $request->nama_industri,
            'cerita'        => $request->cerita,
            'file_laporan'  => $cerita->file_laporan,
        ]);

        return redirect()->route('admin.cerita')->with('success', 'Data cerita PKL berhasil diupdate!');
    }

    public function destroy($id)
    {
        $cerita = PengalamanPKL::findOrFail($id);
        if ($cerita->file_laporan) {
            Storage::disk('public')->delete($cerita->file_laporan);
        }
        $cerita->delete();

        return redirect()->route('admin.cerita')->with('success', 'Data cerita PKL berhasil dihapus!');
    }
}
