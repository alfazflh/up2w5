<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanApat;
use App\Models\Apat;
use Illuminate\Http\Request;

class PemeriksaanApatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_apat' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'kondisi_fisik' => 'required|string',
            'drum' => 'required|string',
            'aduk_pasir' => 'required|string',
            'sekop' => 'required|string',
            'fire_blanket' => 'required|string',
            'ember' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);

        $apat = Apat::where('id_apat', $request->id_apat)->latest('updated_at')->first();

        if (!$apat) {
            return back()->with('error', 'Data APAT tidak ditemukan.');
        }

        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        PemeriksaanApat::create([
            'id_apat' => $request->id_apat,
            'lokasi' => $apat->lokasi,
            'catatan' => $apat->catatan,
            'kondisi_fisik' => $transform($request->kondisi_fisik),
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'drum' => $transform($request->drum),
            'aduk_pasir' => $transform($request->aduk_pasir),
            'sekop' => $transform($request->sekop),
            'fire_blanket' => $transform($request->fire_blanket),
            'ember' => $transform($request->ember),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->route('apat.hasil', ['id_apat' => $request->id_apat])
            ->with('success', 'Pemeriksaan APAT berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanApat::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->back()->with('success', 'Data pemeriksaan APAT berhasil dihapus.');
    }

    public function editForm($id)
    {
        $p = PemeriksaanApat::findOrFail($id);
        $options = ['baik', 'tidak_baik'];

        return response()->json([
            'html' => '
                <form method="POST" action="'.route('pemeriksaan-apat.update', $p->id).'" class="space-y-4 text-sm">
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

                    <div class="bg-blue-100 p-3 rounded-lg border-l-4 border-primary">
                        <h2 class="text-sm font-bold text-primary mb-1">Kondisi APAT</h2>
                        <p class="text-xs text-gray-700">Kondisi diisi sesuai keadaan di lapangan</p>
                    </div>

                    '.collect([
                        'kondisi_fisik' => 'Kondisi Fisik',
                        'drum' => 'Drum',
                        'aduk_pasir' => 'Aduk Pasir',
                        'sekop' => 'Sekop',
                        'fire_blanket' => 'Fire Blanket',
                        'ember' => 'Ember',
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
            'kondisi_fisik' => 'required|string',
            'drum' => 'required|string',
            'aduk_pasir' => 'required|string',
            'sekop' => 'required|string',
            'fire_blanket' => 'required|string',
            'ember' => 'required|string',
            'catatan' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);

        $p = PemeriksaanApat::findOrFail($id);
        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        $p->update([
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'catatan' => $request->catatan,
            'kondisi_fisik' => $transform($request->kondisi_fisik),
            'drum' => $transform($request->drum),
            'aduk_pasir' => $transform($request->aduk_pasir),
            'sekop' => $transform($request->sekop),
            'fire_blanket' => $transform($request->fire_blanket),
            'ember' => $transform($request->ember),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->back()->with('success', 'Pemeriksaan berhasil diupdate.');
    }
}
