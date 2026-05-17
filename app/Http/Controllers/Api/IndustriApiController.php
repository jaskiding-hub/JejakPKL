<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Industri::with('detail');

        if ($request->search) {
            $query->where('nama_industri', 'like', "%{$request->search}%")
                  ->orWhere('kategori', 'like', "%{$request->search}%");
        }

        if ($request->jurusan && $request->jurusan !== 'Semua Jurusan') {
            $query->where('kategori', $request->jurusan);
        }

        return response()->json($query->paginate(6));
    }

    public function show($id)
    {
        $mitra = Industri::with('detail')->findOrFail($id);
        return response()->json($mitra);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_industri'    => 'required|string',
            'kategori'         => 'required|string',
            'lokasi'           => 'required|string',
            'jumlah_siswa_pkl' => 'required|integer',
        ]);

        $industri = Industri::create($request->all());
        return response()->json($industri, 201);
    }

    public function update(Request $request, $id)
    {
        $industri = Industri::findOrFail($id);
        $industri->update($request->all());
        return response()->json($industri);
    }

    public function destroy($id)
    {
        Industri::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}