<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RumahPompa;
use App\Models\PemeriksaanRumahPompa;

class RumahPompaController extends Controller
{
    public function index()
    {
        $rumahpompas = Rumahpompa::latest()->get();
        return view('inspeksi.rumah_pompa.index', compact('rumahpompas')); 
    }  

    public function create($id_rumah)
    {
        $rumah = RumahPompa::where('id_rumah', $id_rumah)->firstOrFail();
        return view('inspeksi.rumah_pompa.create', compact('rumah'));
    }

    public function show($id_rumah)
    {
        $rumah = RumahPompa::where('id_rumah', $id_rumah)->firstOrFail();
        return view('inspeksi.rumah_pompa.show', compact('rumah'));
    }
    

    public function hasil($id_rumah)
    {
        $rumah = RumahPompa::where('id_rumah', $id_rumah)->firstOrFail();
        $pemeriksaans = PemeriksaanRumahPompa::with('rumahPompa')
                            ->where('id_rumah', $id_rumah)
                            ->orderBy('tanggal_pemeriksaan', 'desc')
                            ->get();

        return view('inspeksi.rumah_pompa.hasil', compact('rumah', 'pemeriksaans'));
    }

    public function detail($id)
    {
        $pemeriksaan = PemeriksaanRumahPompa::with('rumahPompa')->findOrFail($id);
        return view('rumah_pompa.detail', compact('pemeriksaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_rumah' => 'required|string|max:255|unique:rumah_pompa,id_rumah',
            'catatan' => 'nullable|string|max:255',
        ]);
    
        RumahPompa::create([
            'id_rumah' => $request->id_rumah,
            'catatan' => $request->catatan,
        ]);
    
        return redirect()->route('rumah_pompa.index')->with('success', 'Rumah Pompa baru berhasil ditambahkan.');
    }
    
}
