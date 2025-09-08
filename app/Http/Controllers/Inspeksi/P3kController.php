<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\P3k;

class P3kController extends Controller
{
    public function pemakaian($id_p3k)
    {
        $kotak = P3k::where('id_p3k', $id_p3k)->first();

        if (!$kotak) {
            abort(404, 'Kotak P3K tidak ditemukan');
        }

        return view('inspeksi.p3k.pemakaian', [
            'id_p3k' => $id_p3k,
        ]);
    }

    public function hasilpemakaian($id_p3k)
    {
        $pemakaians = P3k::where('id_p3k', $id_p3k)
            ->whereNotNull('tanggal_pemeriksaan') // asumsi kamu punya kolom ini
            ->orderByDesc('tanggal_pemeriksaan')
            ->get();

return view('inspeksi.p3k.hasilpemakaian', [
    'pemeriksaans' => $pemakaians, // biar di blade tetap pakai $pemeriksaans
    'id_p3k' => $id_p3k,
]);

    }

    public function hasil($id_p3k)
    {
        $pemeriksaans = P3k::where('id_p3k', $id_p3k)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();
    
        return view('inspeksi.p3k.hasil', compact('pemeriksaans', 'id_p3k'));
    }
    

    public function index()
    {
        $p3ks = P3k::orderBy('id_p3k')->get()->unique('id_p3k');
        return view('inspeksi.p3k.index', compact('p3ks'));
    }

    public function show($id_p3k)
    {
        // Ambil pemeriksaan terbaru untuk id_p3k yang dipilih
        $latestPemeriksaan = P3k::where('id_p3k', $id_p3k)
            ->orderByDesc('tanggal_pemeriksaan')
            ->first();
    
        // Ambil semua pemeriksaan untuk id_p3k (kalau memang mau ditampilkan daftar juga)
        $pemeriksaans = P3k::where('id_p3k', $id_p3k)
            ->orderByDesc('tanggal_pemeriksaan')
            ->get();
    
        return view('inspeksi.p3k.show', compact('pemeriksaans', 'latestPemeriksaan', 'id_p3k'));
    }
    

    public function detail($id)
    {
        $pemeriksaan = P3k::findOrFail($id);
        return view('inspeksi.p3k.detail', compact('pemeriksaan'));
    }

    public function create($id_p3k)
    {
        return view('inspeksi.p3k.create', compact('id_p3k'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_p3k' => 'required|string|max:255',
        ]);

        P3k::create([
            'id_p3k' => $request->id_p3k,
        ]);

        return redirect()->route('p3k.index')->with('success', 'Pemeriksaan P3K berhasil ditambahkan.');
    }
}
