<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaranController extends Controller
{
    /**
     * User masuk ke form create, Admin ke hasil
     */
    public function redirect()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('saran.hasil');
        }
        return redirect()->route('saran.create');
    }    

    /**
     * Halaman form input saran (user)
     */
    public function create()
    {
        return view('inspeksi.saran.create');
    }

    /**
     * Simpan ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'saran' => 'required|string|max:1000',
        ]);
    
        Saran::create([
            'saran' => $request->saran,
        ]);
    
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('saran.hasil')->with('success', 'Saran berhasil disimpan!');
        }
    
        return redirect()->route('saran.create')->with('success', 'Terima kasih atas sarannya!');
    }
    

    /**
     * Halaman hasil (khusus admin)
     */
    public function hasil()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $sarans = Saran::latest()->get();
            return view('inspeksi.saran.hasil', compact('sarans'));
        }
    
        abort(403, 'Anda tidak punya akses');
    }
    
    
    
    
// Di SaranController.php
public function update(Request $request, $id)
{
    $request->validate([
        'saran' => 'required|string',
    ]);

    $saran = Saran::find($id);
    if (!$saran) {
        return response()->json([
            'success' => false,
            'message' => 'Data saran tidak ditemukan'
        ], 404);
    }

    $saran->saran = $request->saran;
    $saran->save();

    return response()->json([
        'success' => true,
        'message' => 'Saran berhasil diperbarui'
    ]);
}




    
    
public function destroy($id)
{
    if (Auth::check() && Auth::user()->role === 'admin') {
        $saran = Saran::findOrFail($id);
        $saran->delete();

        if(request()->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Saran berhasil dihapus'
            ]);
        }

        return redirect()->route('saran.hasil')->with('success', 'Data berhasil dihapus');
    }

    abort(403, 'Anda tidak punya akses');
}

    
    
}
