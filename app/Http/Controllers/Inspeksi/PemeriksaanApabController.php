<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanApab;
use App\Models\Apab;
use Illuminate\Http\Request;

class PemeriksaanApabController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_apab' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'kondisi_fisik' => 'required|string',
            'pressure_gauge' => 'required|string',
            'segel' => 'required|string',
            'selang' => 'required|string',
            'klem_selang' => 'required|string',
            'handle' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);
    
        $apab = Apab::where('id_apab', $request->id_apab)->latest('updated_at')->first();
    
        if (!$apab) {
            return back()->with('error', 'Data APAB tidak ditemukan.');
        }
    
        // Fungsi bantu untuk ubah format input
        $transform = fn($val) => ucwords(str_replace('_', ' ', $val));
    
        PemeriksaanApab::create([
            'id_apab' => $request->id_apab,
            'lokasi' => $apab->lokasi,
            'isi_apab' => $apab->isi_apab,
            'kapasitas' => $apab->kapasitas,
            'masa_berlaku' => $apab->masa_berlaku,
            'catatan' => $apab->catatan,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'kondisi_fisik' => $transform($request->kondisi_fisik),
            'pressure_gauge' => $transform($request->pressure_gauge),
            'segel' => $transform($request->segel),
            'selang' => $transform($request->selang),
            'klem_selang' => $transform($request->klem_selang),
            'handle' => $transform($request->handle),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);
    
        return redirect()->route('apab.hasil', ['id_apab' => $request->id_apab])
            ->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function destroy($id)
{
    $pemeriksaan = PemeriksaanApab::findOrFail($id);
    $pemeriksaan->delete();

    return redirect()->back()->with('success', 'Data pemeriksaan berhasil dihapus.');
}

public function editForm($id)
{
    $p = PemeriksaanApab::findOrFail($id);

    // data lama
    $segelOptions = ['baik', 'tidak_baik'];
    $options = ['baik', 'tidak_baik'];

    return response()->json([
        'html' => '
        <form method="POST" action="'.route('pemeriksaan-apab.update', $p->id).'" class="space-y-4 text-sm">
            '.csrf_field().method_field('PUT').'

            <div>
                <label class="block font-semibold mb-1">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_pemeriksaan" value="'.$p->tanggal_pemeriksaan.'" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Petugas</label>
                <input type="text" name="petugas" value="'.$p->petugas.'" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Pengawas</label>
                <input type="text" name="pengawas" value="'.$p->pengawas.'" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div class="bg-blue-100 p-3 rounded-lg border-l-4 border-primary">
                <h2 class="text-sm font-bold text-primary mb-1">Kondisi Alat Pemadam Api Ringan</h2>
                <p class="text-xs text-gray-700">Kondisi diisi sesuai keadaan di lapangan</p>
            </div>

            '.collect([
                'pressure_gauge' => 'Pressure Gauge',
                'segel' => 'Segel',
                'selang' => 'Selang',
                'klem_selang' => 'Klem Selang',
                'handle' => 'Handle',
                'kondisi_fisik' => 'Kondisi Fisik',
                'kesimpulan' => 'Kesimpulan'
            ])->map(function($label, $field) use ($p, $options, $segelOptions) {
                $current = strtolower(str_replace(' ', '_', $p->$field));
                $radios = '';

                $values = $field === 'segel' ? $segelOptions : $options;

                foreach ($values as $val) {
                    $checked = $current === $val ? 'checked' : '';
                    $labelVal = ucfirst(str_replace('_', ' ', $val));
                    $radios .= '
                        <label class="inline-flex items-center space-x-2">
                            <input type="radio" name="'.$field.'" value="'.$val.'" '.$checked.' required>
                            <span>'.$labelVal.'</span>
                        </label>
                    ';
                }

                return '
                    <div>
                        <label class="block font-semibold mb-1">'.$label.' <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-4">'.$radios.'</div>
                    </div>';
            })->implode('') . '

            <div>
            <label class="block font-semibold mb-1">Catatan</label>
            <input type="text" name="catatan" value="'.$p->catatan.'" class="w-full border px-3 py-2 rounded-lg" required>
        </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>'
    ]);
}


public function update(Request $request, $id)
{
    $request->validate([
        'tanggal_pemeriksaan' => 'required|date',
        'petugas' => 'required|string',
        'pengawas' => 'required|string',
        'kondisi_fisik' => 'required|string',
        'pressure_gauge' => 'required|string',
        'segel' => 'required|string',
        'selang' => 'required|string',
        'klem_selang' => 'required|string',
        'handle' => 'required|string',
        'catatan' => 'required|string',
        'kesimpulan' => 'required|string',
    ]);

    $pemeriksaan = PemeriksaanApab::findOrFail($id);

    // Optional: ubah format ke kapital awal kata
    $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

    $pemeriksaan->update([
        'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
        'petugas' => $request->petugas,
        'pengawas' => $request->pengawas,
        'catatan' => $request->catatan,
        'kondisi_fisik' => $transform($request->kondisi_fisik),
        'pressure_gauge' => $transform($request->pressure_gauge),
        'segel' => $transform($request->segel),
        'selang' => $transform($request->selang),
        'klem_selang' => $transform($request->klem_selang),
        'handle' => $transform($request->handle),
        'kesimpulan' => $transform($request->kesimpulan),
    ]);

    return redirect()->back()->with('success', 'Pemeriksaan berhasil diupdate.');
}



    
}
