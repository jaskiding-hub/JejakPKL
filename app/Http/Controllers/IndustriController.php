<?php

namespace App\Http\Controllers;

use App\Models\Industri;

class IndustriController extends Controller
{
    public function detail($id)
    {
        $mitra = Industri::with('detail')->findOrFail($id);
        return view('industri-detail', compact('mitra'));
    }
}