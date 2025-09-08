<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FireAlarm;
use App\Models\PemeriksaanFireAlarm;

class PemeriksaanFireAlarmController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_firealarm' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'kondisi_fisik' => 'required|string',
            'fungsi' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);

        $firealarm = FireAlarm::where('id_firealarm', $request->id_firealarm)->latest('updated_at')->first();

        if (!$firealarm) {
            return back()->with('error', 'Data fire alarm tidak ditemukan.');
        }

        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        PemeriksaanFireAlarm::create([
            'id_firealarm' => $request->id_firealarm,
            'lokasi' => $firealarm->lokasi,
            'nama' => $firealarm->nama,
            'catatan' => $firealarm->catatan,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'kondisi_fisik' => $transform($request->kondisi_fisik),
            'fungsi' => $transform($request->fungsi),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->route('fire_alarm.hasil', ['id_firealarm' => $request->id_firealarm])
            ->with('success', 'Pemeriksaan fire alarm berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanFireAlarm::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->back()->with('success', 'Data pemeriksaan Fire Alarm berhasil dihapus.');
    }


    public function editForm($id)
    {
        $p = PemeriksaanFireAlarm::findOrFail($id);
        $options = ['baik', 'tidak_baik'];

        return response()->json([
            'html' => '
                <form method="POST" action="'.route('pemeriksaan-fire_alarm.update', $p->id).'" class="space-y-4 text-sm">
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
                        <h2 class="text-sm font-bold text-primary mb-1">Kondisi Fire Alarm</h2>
                        <p class="text-xs text-gray-700">Kondisi diisi sesuai keadaan di lapangan</p>
                    </div>

                    '.collect([
                        'kondisi_fisik' => 'Kondisi Fisik',
                        'fungsi' => 'Fungsi',
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
            'fungsi' => 'required|string',
            'kesimpulan' => 'required|string',
            'catatan' => 'required|string',
        ]);

        $p = PemeriksaanFireAlarm::findOrFail($id);
        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        $p->update([
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'catatan' => $request->catatan,
            'kondisi_fisik' => $transform($request->kondisi_fisik),
            'fungsi' => $transform($request->fungsi),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->back()->with('success', 'Pemeriksaan berhasil diupdate.');
    }
}
