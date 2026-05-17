<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengalamanPKL;
use Illuminate\Http\Request;

class PengalamanApiController extends Controller
{
    public function index()
    {
        return response()->json(PengalamanPKL::latest()->paginate(6));
    }

    public function show($id)
    {
        return response()->json(PengalamanPKL::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa'    => 'required|string',
            'angkatan'      => 'required|digits:4',
            'jurusan'       => 'required|string',
            'nama_industri' => 'required|string',
            'cerita'        => 'required|string',
        ]);

        $pengalaman = PengalamanPKL::create($request->all());
        return response()->json($pengalaman, 201);
    }

    public function update(Request $request, $id)
    {
        $pengalaman = PengalamanPKL::findOrFail($id);
        $pengalaman->update($request->all());
        return response()->json($pengalaman);
    }

    public function destroy($id)
    {
        PengalamanPKL::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}