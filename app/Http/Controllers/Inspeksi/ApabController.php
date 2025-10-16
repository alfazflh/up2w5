<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\Apab;
use Illuminate\Http\Request;
use App\Models\PemeriksaanApab;
use Illuminate\Support\Facades\Auth;


class ApabController extends Controller
{
    public function index()
    {
        $apabs = Apab::all(); 
        return view('inspeksi.apab.index', compact('apabs'));
    }

    public function create($id_apab)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['admin', 'superadmin'])) {
            return redirect()->route('apab.hasil', ['id_apab' => $id_apab]);
        }

        $apab = Apab::where('id_apab', $id_apab)->firstOrFail();
    
        return view('inspeksi.apab.create', compact('apab'));
    }
    

    public function show($id_apab)
    {
        $apab = Apab::where('id_apab', $id_apab)->firstOrFail();
        return view('inspeksi.apab.show', compact('apab'));
    }    
    
    

    public function hasil($id_apab)
    {
        $apab = Apab::where('id_apab', $id_apab)->firstOrFail();
    
        $pemeriksaans = PemeriksaanApab::with('apab') // penting!
                            ->where('id_apab', $id_apab)
                            ->orderBy('tanggal_pemeriksaan', 'desc')
                            ->get();
    
        return view('inspeksi.apab.hasil', compact('apab', 'pemeriksaans'));
    }
    

    public function detail($id)
    {
        $pemeriksaan = PemeriksaanApab::with('apab')->findOrFail($id);
        return view('apab.detail', compact('pemeriksaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_apab' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'isi_apab' => 'required|string|max:255',
            'kapasitas' => 'required|string|max:255', // tetap string
            'catatan' => 'required|string|max:255',
            'masa_berlaku' => 'required|date',
        ]);
    
        // ambil kapasitas dari request
        $kapasitas = $request->kapasitas;
    
        // normalisasi: ubah titik jadi koma
        $kapasitas = str_replace('.', ',', $kapasitas);
    
        Apab::create([
            'id_apab' => $request->id_apab,
            'lokasi' => $request->lokasi,
            'isi_apab' => $request->isi_apab,
            'kapasitas' => $kapasitas, // simpan hasil normalisasi
            'masa_berlaku' => $request->masa_berlaku,
            'catatan' => $request->catatan,
        ]);
    
        return redirect()->route('apab.index')->with('success', 'APAB berhasil ditambahkan.');
    }
    
}
