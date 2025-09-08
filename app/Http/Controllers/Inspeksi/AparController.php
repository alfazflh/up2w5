<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\Apar;
use Illuminate\Http\Request;
use App\Models\PemeriksaanApar;


class AparController extends Controller
{
    public function index()
    {
        $apars = Apar::all(); 
        return view('inspeksi.apar.index', compact('apars'));
    }

    public function create($id_apar)
    {
        $apar = Apar::where('id_apar', $id_apar)->firstOrFail();
    
        return view('inspeksi.apar.create', compact('apar'));
    }
    

    public function show($id_apar)
    {
        $apar = Apar::where('id_apar', $id_apar)->firstOrFail();
        return view('inspeksi.apar.show', compact('apar'));
    }    
    
    

    public function hasil($id_apar)
    {
        $apar = Apar::where('id_apar', $id_apar)->firstOrFail();
    
        $pemeriksaans = PemeriksaanApar::with('apar') // penting!
                            ->where('id_apar', $id_apar)
                            ->orderBy('tanggal_pemeriksaan', 'desc')
                            ->get();
    
        return view('inspeksi.apar.hasil', compact('apar', 'pemeriksaans'));
    }
    

    public function detail($id)
    {
        $pemeriksaan = PemeriksaanApar::with('apar')->findOrFail($id);
        return view('apar.detail', compact('pemeriksaan'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_apar' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'isi_apar' => 'required|string|max:255',
        'kapasitas' => 'required|string|max:255',
        'catatan' => 'required|string|max:255',
        'masa_berlaku' => 'required|date',
    ]);

    Apar::create([
        'id_apar' => $request->id_apar,
        'lokasi' => $request->lokasi,
        'isi_apar' => $request->isi_apar,
        'kapasitas' => $request->kapasitas,
        'masa_berlaku' => $request->masa_berlaku,
        'catatan' => $request->catatan,
    ]);
    

    return redirect()->route('apar.index')->with('success', 'APAR berhasil ditambahkan.');
}
}
