<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\PengalamanPKL;

class HomeController extends Controller
{
    public function index()
    {
        $topMitra   = Industri::orderBy('jumlah_siswa_pkl', 'desc')->paginate(3, ['*'], 'top_page');
        $semuaMitra = Industri::paginate(6, ['*'], 'page');
        $cerita     = PengalamanPKL::latest()->take(6)->get();

        return view('home', compact('topMitra', 'semuaMitra', 'cerita'));
    }
}