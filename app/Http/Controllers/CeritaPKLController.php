<?php

namespace App\Http\Controllers;

use App\Models\PengalamanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CeritaPKLController extends Controller
{
    public function create()
    {
        return view('cerita-pkl-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa'   => 'required|string|max:100',
            'angkatan'     => 'required|digits:4',
            'jurusan'      => 'required|string',
            'nama_industri'=> 'required|string|max:100',
            'cerita'       => 'required|string',
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file_laporan')) {
            $filePath = $request->file('file_laporan')->store('laporan', 'public');
        }

        PengalamanPKL::create([
            'nama_siswa'    => $request->nama_siswa,
            'angkatan'      => $request->angkatan,
            'jurusan'       => $request->jurusan,
            'nama_industri' => $request->nama_industri,
            'cerita'        => $request->cerita,
            'file_laporan'  => $filePath,
        ]);

        return redirect()->route('home')->with('success', 'Pengalaman PKL berhasil dibagikan!');
    }
}