<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\Apat;
use Illuminate\Http\Request;

class ApatController extends Controller
{
    public function index()
    {
        $apats = Apat::all();
        return view('inspeksi.apat.index', compact('apats'));
    }

    public function create($id_apat)
    {
        $apat = \App\Models\Apat::where('id_apat', $id_apat)->firstOrFail();
        return view('inspeksi.apat.create', compact('apat'));
    }    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_apat' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'catatan' => 'required|string|max:255',
        ]);

        Apat::create($validated);

        return redirect()->route('apat.index')->with('success', 'Data APAT berhasil ditambahkan');
    }
    public function show($id_apat)
    {
        $apat = Apat::where('id_apat', $id_apat)->firstOrFail(); // ambil data dari DB
        return view('inspeksi.apat.show', compact('apat')); // kirim ke view
    }

    public function hasil($id_apat)
    {
        $pemeriksaans = \App\Models\PemeriksaanApat::where('id_apat', $id_apat)->get();
        $apat = \App\Models\Apat::where('id_apat', $id_apat)->first();
    
        return view('inspeksi.apat.hasil', compact('pemeriksaans', 'id_apat', 'apat'));
    }
    
    

}
