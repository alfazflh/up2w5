<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanRumahPompa;
use App\Models\RumahPompa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemeriksaanRumahPompaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_rumah' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
            'pengawas' => 'required|string|max:255',
            'pipa' => 'required|string',
            'valve' => 'required|string',
            'oli' => 'required|string',
            'bbm' => 'required|string',
            'air' => 'required|string',
            'tegangan' => 'required|string',
            'filter_oli' => 'required|string',
            'filter_bbm' => 'required|string',
            'filter_udara' => 'required|string',
            'kekencangan' => 'required|string',
            'terminal' => 'required|string',
            'panel' => 'required|string',
            'pemanasan' => 'required|string',
            'indikator' => 'required|string',
            'matikan' => 'required|string',
            'kondisi' => 'required|string',
            'ruangan' => 'required|string',
            'elektrik' => 'required|string',
            'jocky' => 'required|string',
            'selector' => 'required|string',
            'fungsi' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);
    
        $rumahpompa = RumahPompa::where('id_rumah', $request->id_rumah)->latest('updated_at')->first();
    
        if (!$rumahpompa) {
            return back()->with('error', 'Data RUMAH POMPA tidak ditemukan.');
        }
    
        // Fungsi bantu untuk ubah format input
        $transform = fn($val) => ucwords(str_replace('_', ' ', $val));
    
        PemeriksaanRumahPompa::create([
            'id_rumah' => $request->id_rumah,
            'catatan' => $rumahpompa->catatan,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'pipa' => $transform($request->pipa),
            'valve' => $transform($request->valve),
            'oli' => $transform($request->oli),
            'bbm' => $transform($request->bbm),
            'air' => $transform($request->air),
            'tegangan' => $transform($request->tegangan),
            'filter_oli' => $transform($request->filter_oli),
            'filter_bbm' => $transform($request->filter_bbm),
            'filter_udara' => $transform($request->filter_udara),
            'kekencangan' => $transform($request->kekencangan),
            'terminal' => $transform($request->terminal),
            'panel' => $transform($request->panel),
            'pemanasan' => $transform($request->pemanasan),
            'indikator' => $transform($request->indikator),
            'matikan' => $transform($request->matikan),
            'kondisi' => $transform($request->kondisi),
            'ruangan' => $transform($request->ruangan),
            'elektrik' => $transform($request->elektrik),
            'jocky' => $transform($request->jocky),
            'selector' => $transform($request->selector),
            'fungsi' => $transform($request->fungsi),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);
    
        return redirect()->route('rumah_pompa.hasil', ['id_rumah' => $request->id_rumah])
            ->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanRumahPompa::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->back()->with('success', 'Data pemeriksaan berhasil dihapus.');
    }

    public function editForm($id)
    {
        $p = PemeriksaanRumahPompa::findOrFail($id);
    
        $options = ['✓ Baik', 'X Tidak Baik'];
    
        $sections = [
            'PEMIPAAN DAN VALVE' => [
                'pipa' => 'Tidak ada kebocoran di pipa suction dan discharge pompa Electric, Diesel, dan Jockey (Tekanan Stanby di 8 Bar)',
                'valve' => 'Semua valve pada pipa suction dan discharge pompa Electric, Diesel, dan Jockey dalam kondisi Buka/Open.'
            ],
            'MESIN DIESEL' => [
                'oli' => 'Cek Level oli mesin (tambah bila kurang)',
                'bbm' => 'Cek level BBM mesin (tambah bila kurang)',
                'air' => 'Cek level air radiator (tambah bila kurang)',
                'tegangan' => 'Cek tegangan battery',
                'filter_oli' => 'Pastikan filter oli dalam kondisi baik',
                'filter_bbm' => 'Pastikan filter bbm dan clarifier dalam kondisi baik',
                'filter_udara' => 'Pastikan filter udara dalam kondisi baik',
                'kekencangan' => 'Pastikan Kekencangan Vanbelt',
                'terminal' => 'Pastikan terminal kabel battery dalam kondisi baik',
                'panel' => 'Pastikan panel kontrol mesin dalam kondisi baik',
                'pemanasan' => 'Hidupkan mesin selama ± 20 menit untuk pemanasan',
                'indikator' => 'Cek semua Indikator pada display berfungsi dengan baik',
                'matikan' => 'Matikan mesin / stop engine setelah selesai',
                'kondisi' => 'Pastikan kondisi mesin dan sekitarnya bersih dan aman',
                'ruangan' => 'Pastikan ruangan mesin dan sekitarnya bersih dan aman'
            ],
            'PANEL DAN POMPA' => [
                'elektrik' => 'Cek Fisik Panel Elektric Pump dan Indikator-indikatornya',
                'jocky' => 'Cek Fisik Panel Jocky Pump dan Indikator-indikatornya',
                'selector' => 'Cek posisi selector pada posisi Automatic pada panel kontrol (Electric, Jockey, dan Diesel)',
                'fungsi' => 'Cek Fungsi Pompa dengan membuka pilar (minimal 3 orang): Jocky pada tekanan 7 Bar, Electric Pump pada tekanan 6 Bar',
                'kesimpulan' => 'KESIMPULAN'
            ]
        ];
    
        $formHtml = '
        <form method="POST" action="'.route('pemeriksaan-rumahpompa.update', $p->id).'" class="space-y-4 text-sm">
            '.csrf_field().method_field('PUT').'
    
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <label class="block font-semibold mb-1">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_pemeriksaan" value="'.$p->tanggal_pemeriksaan.'" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
    
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <label class="block font-semibold mb-1">Petugas</label>
                <input type="text" name="petugas" value="'.$p->petugas.'" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
    
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <label class="block font-semibold mb-1">Pengawas</label>
                <input type="text" name="pengawas" value="'.$p->pengawas.'" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>';
    
        foreach ($sections as $sectionName => $items) {
            $formHtml .= '
            <div class="bg-blue-100 p-4 rounded-lg border-l-4 border-primary">
                <h2 class="text-lg font-bold text-primary mb-1">'.$sectionName.'</h2>
            </div>';
    
            foreach ($items as $field => $label) {
                $current = $p->$field;
                $radios = '';
    
                foreach ($options as $val) {
                    $checked = strtolower($current) === strtolower($val) ? 'checked' : '';
                    $radios .= '
                        <label class="inline-flex items-center space-x-1 mr-3">
                            <input type="radio" name="'.$field.'" value="'.$val.'" '.$checked.' required>
                            <span>'.$val.'</span>
                        </label>
                    ';
                }                
    
                $formHtml .= '
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <label class="block font-semibold mb-2">'.$label.' <span class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-4">'.$radios.'</div>
                </div>';
            }
        }
    
        $formHtml .= '
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <label class="block font-semibold mb-1">Catatan</label>
                <input type="text" name="catatan" value="'.($p->catatan ?? '').'" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
    
            <div class="flex justify-end">
            <button type="submit"
                style="background-color: #2563eb; color: white;"
                class="px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 hover:text-white transition">
                Simpan Perubahan
            </button>
        </div>
        
        </form>';
    
        return response()->json([
            'html' => $formHtml
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string',
            'pengawas' => 'required|string',
            'pipa' => 'required|string',
            'valve' => 'required|string',
            'oli' => 'required|string',
            'bbm' => 'required|string',
            'air' => 'required|string',
            'tegangan' => 'required|string',
            'filter_oli' => 'required|string',
            'filter_bbm' => 'required|string',
            'filter_udara' => 'required|string',
            'kekencangan' => 'required|string',
            'terminal' => 'required|string',
            'panel' => 'required|string',
            'pemanasan' => 'required|string',
            'indikator' => 'required|string',
            'matikan' => 'required|string',
            'kondisi' => 'required|string',
            'ruangan' => 'required|string',
            'elektrik' => 'required|string',
            'jocky' => 'required|string',
            'selector' => 'required|string',
            'fungsi' => 'required|string',
            'kesimpulan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $pemeriksaan = PemeriksaanRumahPompa::findOrFail($id);

        // Fungsi bantu untuk ubah format ke kapital awal kata
        $transform = fn($val) => ucwords(str_replace('_', ' ', strtolower($val)));

        $pemeriksaan->update([
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'petugas' => $request->petugas,
            'pengawas' => $request->pengawas,
            'catatan' => $request->catatan,
            'pipa' => $transform($request->pipa),
            'valve' => $transform($request->valve),
            'oli' => $transform($request->oli),
            'bbm' => $transform($request->bbm),
            'air' => $transform($request->air),
            'tegangan' => $transform($request->tegangan),
            'filter_oli' => $transform($request->filter_oli),
            'filter_bbm' => $transform($request->filter_bbm),
            'filter_udara' => $transform($request->filter_udara),
            'kekencangan' => $transform($request->kekencangan),
            'terminal' => $transform($request->terminal),
            'panel' => $transform($request->panel),
            'pemanasan' => $transform($request->pemanasan),
            'indikator' => $transform($request->indikator),
            'matikan' => $transform($request->matikan),
            'kondisi' => $transform($request->kondisi),
            'ruangan' => $transform($request->ruangan),
            'elektrik' => $transform($request->elektrik),
            'jocky' => $transform($request->jocky),
            'selector' => $transform($request->selector),
            'fungsi' => $transform($request->fungsi),
            'kesimpulan' => $transform($request->kesimpulan),
        ]);

        return redirect()->back()->with('success', 'Pemeriksaan berhasil diupdate.');
    }
}