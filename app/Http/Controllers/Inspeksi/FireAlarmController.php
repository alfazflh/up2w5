<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FireAlarm; 
use Illuminate\Support\Facades\Auth;

class FireAlarmController extends Controller
{
    public function index()
    {
        $firealarms = FireAlarm::latest()->get(); // ambil semua data fire alarm dari DB
        return view('inspeksi.fire_alarm.index', compact('firealarms')); // kirim ke view
    }

    public function create($id_firealarm)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['admin', 'superadmin'])) {
            return redirect()->route('fire_alarm.hasil', ['id_firealarm' => $id_firealarm]);
        }
        
        $firealarm = FireAlarm::where('id_firealarm', $id_firealarm)->firstOrFail();
        return view('inspeksi.fire_alarm.create', compact('firealarm'));
    }
    

    public function show($id_firealarm)
    {
        $firealarm = FireAlarm::where('id_firealarm', $id_firealarm)->firstOrFail(); // ambil data dari DB
        return view('inspeksi.fire_alarm.show', compact('firealarm')); // kirim ke view
    }
    

    public function store(Request $request)
{
    // validasi input
    $request->validate([
        'id_firealarm' => 'required|string|max:255',
        'lokasi' => 'required|string',
        'catatan' => 'required|string',
    ]);

    // simpan data baru
    FireAlarm::create([
        'id_firealarm' => $request->id_firealarm,
        'lokasi' => $request->lokasi,
        'catatan' => $request->catatan,
    ]);

    return redirect()->route('fire_alarm.index')->with('success', 'Data fire alarm berhasil ditambahkan.');
}

public function hasil($id_firealarm)
{
    $firealarm = FireAlarm::where('id_firealarm', $id_firealarm)->firstOrFail(); // pasti ada, kalau gak 404

    $pemeriksaans = \App\Models\PemeriksaanFireAlarm::where('id_firealarm', $id_firealarm)
    ->orderBy('tanggal_pemeriksaan', 'desc') // urutkan dari terbaru ke terlama
    ->get();


    return view('inspeksi.fire_alarm.hasil', compact('pemeriksaans', 'firealarm'));
}



}
