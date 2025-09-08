<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanBoxHydrant;
use App\Models\BoxHydrant;
use Illuminate\Http\Request;

class PemeriksaanBoxHydrantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_boxhydrant' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'pilar_hydrant' => 'required|string',
            'box_hydrant' => 'required|string',
            'noozle' => 'required|string',
            'selang' => 'required|string',
            'uji_fungsi' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);

        $boxhydrant = BoxHydrant::where('id_boxhydrant', $request->id_boxhydrant)->latest('updated_at')->first();

        if (!$boxhydrant) {
            return back()->with('error', 'Data BOX HYDRANT tidak ditemukan.');
        }

        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        PemeriksaanBoxHydrant::create([
            'id_boxhydrant' => $request->id_boxhydrant,
            'lokasi' => $boxhydrant->lokasi,
            'catatan' => $boxhydrant->catatan,
            'nama' => $boxhydrant->nama,
            'pilar_hydrant' => $transform($request->pilar_hydrant),
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'box_hydrant' => $transform($request->box_hydrant),
            'noozle' => $transform($request->noozle),
            'selang' => $transform($request->selang),
            'uji_fungsi' => $transform($request->uji_fungsi),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->route('boxhydrant.hasil', ['id_boxhydrant' => $request->id_boxhydrant])
            ->with('success', 'Pemeriksaan BOX HYDRANT berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanBoxHydrant::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->back()->with('success', 'Data pemeriksaan BOX HYDRANT berhasil dihapus.');
    }

    public function editForm($id)
    {
        $p = PemeriksaanBoxHydrant::findOrFail($id);
        $options = ['baik', 'tidak_baik'];

        return response()->json([
            'html' => '
                <form method="POST" action="'.route('pemeriksaan-box-hydrant.update', $p->id).'" class="space-y-4 text-sm">
                    '.csrf_field().method_field('PUT').'

                    <div>
                        <label class="block font-semibold mb-1">Tanggal Inspeksi</label>
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

                    <div class="hidden">
                        <label class="block font-semibold mb-1">Nama</label>
                        <input type="text" name="nama" value="'.$p->nama.'" class="w-full border px-3 py-2 rounded-lg" required>
                    </div>

                    <div class="bg-blue-100 p-3 rounded-lg border-l-4 border-primary">
                        <h2 class="text-sm font-bold text-primary mb-1">Kondisi BOX HYDRANT</h2>
                        <p class="text-xs text-gray-700">Kondisi diisi sesuai keadaan di lapangan</p>
                    </div>

                    '.collect([
                        'pilar_hydrant' => 'Pilar Hydrant',
                        'box_hydrant' => 'Box Hydrant',
                        'noozle' => 'Noozle',
                        'selang' => 'Selang',
                        'uji_fungsi' => 'Uji Fungsi',
                        'kesimpulan' => 'Kesimpulan',
                    ])->map(function($label, $field) use ($p, $options) {
                        $current = strtolower(str_replace(' ', '_', $p->$field));
                        $radios = '';
                        foreach ($options as $val) {
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
            'pilar_hydrant' => 'required|string',
            'box_hydrant' => 'required|string',
            'noozle' => 'required|string',
            'selang' => 'required|string',
            'uji_fungsi' => 'required|string',
            'catatan' => 'required|string',
            'nama' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);

        $p = PemeriksaanBoxHydrant::findOrFail($id);
        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        $p->update([
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'catatan' => $request->catatan,
            'nama' => $request->nama,
            'pilar_hydrant' => $transform($request->pilar_hydrant),
            'box_hydrant' => $transform($request->box_hydrant),
            'noozle' => $transform($request->noozle),
            'selang' => $transform($request->selang),
            'uji_fungsi' => $transform($request->uji_fungsi),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->back()->with('success', 'Pemeriksaan berhasil diupdate.');
    }
}
