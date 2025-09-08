<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BoxHydrant;
use App\Models\PemeriksaanBoxHydrant;

class HydrantBoxController extends Controller
{
    public function index()
    {
        $boxhydrants = BoxHydrant::latest()->get();
        return view('inspeksi.hydrant_box.index', compact('boxhydrants'));
    }

    public function create($id_boxhydrant)
    {
        $boxhydrant = BoxHydrant::where('id_boxhydrant', $id_boxhydrant)->firstOrFail();
        return view('inspeksi.hydrant_box.create', compact('boxhydrant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_boxhydrant' => 'required|string|max:255|unique:box_hydrants,id_boxhydrant',
            'lokasi' => 'required|string',
            'nama' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        BoxHydrant::create([
            'id_boxhydrant' => $request->id_boxhydrant,
            'lokasi' => $request->lokasi,
            'nama' => $request->nama,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('boxhydrant.index')->with('success', 'Data Box Hydrant berhasil ditambahkan.');
    }

    public function show($id_boxhydrant)
    {
        $boxhydrant = BoxHydrant::where('id_boxhydrant', $id_boxhydrant)->firstOrFail();
        return view('inspeksi.hydrant_box.show', compact('boxhydrant'));
    }

    public function hasil($id_boxhydrant)
    {
        $boxhydrant = BoxHydrant::where('id_boxhydrant', $id_boxhydrant)->firstOrFail(); 
    
        $pemeriksaans = \App\Models\PemeriksaanBoxHydrant::where('id_boxhydrant', $id_boxhydrant)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();
    
        return view('inspeksi.hydrant_box.hasil', compact('pemeriksaans', 'boxhydrant'));
    }
    

}
