<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use App\Models\DetailIndustri;
use Illuminate\Http\Request;

class AdminIndustriController extends Controller
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

        $query = Industri::latest();
        if ($jurusan !== 'Semua Jurusan') {
            $query->where('kategori', $jurusan);
        }

        $industri = $query->get();
        $total = $industri->count();

        return view('admin.industri', compact('industri', 'total', 'jurusans', 'jurusan'));
    }

    public function create()
    {
        return view('admin.industri-form');
    }

    public function store(Request $request)
    {
        $gambar = 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&q=80';

        if ($request->hasFile('logo')) {
            $gambar = $request->file('logo')->store('industri', 'public');
            $gambar = asset('storage/' . $gambar);
        }

        $industri = Industri::create([
            'nama_industri' => $request->nama_industri,
            'kategori' => $request->kategori,
            'kontak' => $request->kontak,
            'instagram' => $request->instagram,
            'email_perusahaan' => $request->email_perusahaan,
            'lokasi' => $request->alamat,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude ?: null,
            'longitude' => $request->longitude ?: null,
            'jumlah_siswa_pkl' => $request->jumlah_siswa_pkl,
            'gambar' => $gambar,
        ]);

        DetailIndustri::create([
            'id_industri' => $industri->id_industri,
            'deskripsi' => $request->deskripsi,
            'posisi_magang' => $request->posisi_magang,
        ]);

        return redirect()->route('admin.industri')->with('success', 'Data industri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $mitra = Industri::findOrFail($id);

        $gambar = $mitra->gambar;
        if ($request->hasFile('logo')) {
            $gambar = $request->file('logo')->store('industri', 'public');
            $gambar = asset('storage/' . $gambar);
        }

        $mitra->update([
            'nama_industri' => $request->nama_industri,
            'kategori' => $request->kategori,
            'lokasi' => $request->alamat,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'instagram' => $request->instagram,
            'email_perusahaan' => $request->email_perusahaan,
            'latitude' => $request->latitude ?: null,
            'longitude' => $request->longitude ?: null,
            'jumlah_siswa_pkl' => $request->jumlah_siswa_pkl,
            'gambar' => $gambar,
        ]);

        if ($mitra->detail) {
            $mitra->detail->update([
                'deskripsi' => $request->deskripsi,
                'posisi_magang' => $request->posisi_magang,
            ]);
        } else {
            DetailIndustri::create([
                'id_industri' => $mitra->id_industri,
                'deskripsi' => $request->deskripsi,
                'posisi_magang' => $request->posisi_magang,
            ]);
        }

        return redirect()->route('admin.industri')->with('success', 'Data berhasil diupdate!');
    }

    public function edit($id)
    {
        $mitra = Industri::with('detail')->findOrFail($id);
        return view('admin.industri-form', compact('mitra'));
    }

    public function destroy($id)
    {
        Industri::findOrFail($id)->delete();
        return redirect()->route('admin.industri')->with('success', 'Data industri berhasil dihapus!');
    }
}