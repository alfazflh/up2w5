<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanP3k;
use App\Models\P3k;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemakaianP3kController extends Controller
{
    // Method existing yang sudah ada...
    public function storePemakaian(Request $request)
    {
        $request->validate([
            'id_p3k' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'nama' => 'required|string',
            'item' => 'required|string',
            'jumlah' => 'required|string',
            'keperluan' => 'required|string',
        ]);
    
        $p3k = P3k::where('id_p3k', $request->id_p3k)->latest('updated_at')->first();
    
        if (!$p3k) {
            return back()->with('error', 'Data pemakaian P3K tidak ditemukan.');
        }
    
        $transform = fn($val) => ucfirst(strtolower($val));
    
        PemeriksaanP3k::create([
            'id_p3k' => $request->id_p3k,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'nama' => $transform($request->nama),
            'item' => $transform($request->item),
            'jumlah' => $transform($request->jumlah),
            'keperluan' => $transform($request->keperluan),
        ]);
    
        return redirect()->route('p3k.hasilpemakaian', ['id_p3k' => $request->id_p3k])
            ->with('success', 'Pemakaian berhasil disimpan.');
    }

    // METOD BARU: Edit Sequential/Step by Step Data berdasarkan bulan
    public function editSequentialForm(Request $request)
    {
        $id_p3k = $request->input('id_p3k');
        $bulan = $request->input('bulan'); // Format: YYYY-MM
        $currentStep = (int) $request->input('step', 1);
        
        if (!$id_p3k || !$bulan) {
            return response()->json([
                'success' => false,
                'message' => 'ID P3K dan bulan harus diisi.'
            ], 400);
        }

        try {
            // Ambil semua data berdasarkan bulan yang dipilih, HANYA yang memiliki nama
            $pemeriksaans = PemeriksaanP3k::where('id_p3k', $id_p3k)
                ->whereRaw('DATE_FORMAT(tanggal_pemeriksaan, "%Y-%m") = ?', [$bulan])
                ->whereNotNull('nama')
                ->where('nama', '!=', '')
                ->where('nama', '!=', '-')
                ->orderBy('tanggal_pemeriksaan')
                ->orderBy('id')
                ->get();

            $totalData = $pemeriksaans->count();

            if ($totalData === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data pemakaian dengan nama yang valid pada bulan yang dipilih.'
                ], 404);
            }

            // Validasi step
            if ($currentStep < 1 || $currentStep > $totalData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Step tidak valid.'
                ], 400);
            }

            $currentData = $pemeriksaans[$currentStep - 1]; // Index dimulai dari 0
            
            $html = $this->generateStepEditForm($currentData, $currentStep, $totalData, $bulan);

            return response()->json([
                'success' => true,
                'html' => $html,
                'current_step' => $currentStep,
                'total_steps' => $totalData,
                'data_id' => $currentData->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function generateStepEditForm($data, $currentStep, $totalSteps, $bulan)
    {
        $prevDisabled = $currentStep <= 1 ? 'disabled' : '';
        $nextDisabled = $currentStep >= $totalSteps ? 'disabled' : '';
        
        return '
        <div class="space-y-4 text-sm">
            <!-- Progress Bar -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-blue-700">Edit Data Pemakaian</span>
                    <span class="text-sm text-gray-500">Data ' . $currentStep . ' dari ' . $totalSteps . '</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: ' . (($currentStep / $totalSteps) * 100) . '%"></div>
                </div>
                <div class="text-xs text-gray-600 mt-1">Progress: ' . round(($currentStep / $totalSteps) * 100) . '%</div>
            </div>

            <!-- Form Edit -->
            <form id="stepEditForm" method="POST" action="/inspeksi/pemakaian-p3k/' . $data->id . '/update-step" class="space-y-4">
                ' . csrf_field() . method_field('PUT') . '
                
                <input type="hidden" name="id_p3k" value="' . htmlspecialchars($data->id_p3k) . '">
                <input type="hidden" name="bulan" value="' . htmlspecialchars($bulan) . '">
                <input type="hidden" name="current_step" value="' . $currentStep . '">
                <input type="hidden" name="total_steps" value="' . $totalSteps . '">

                <div class="bg-blue-50 p-3 rounded-lg mb-4">
                    <h4 class="font-bold text-blue-800 mb-1">Edit Data ke-' . $currentStep . '</h4>
                    <p class="text-blue-600 text-xs">ID Data: #' . $data->id . ' | Tanggal Asli: ' . date('d/m/Y', strtotime($data->tanggal_pemeriksaan)) . '</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Tanggal Pemakaian <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pemeriksaan" value="' . $data->tanggal_pemeriksaan . '" 
                               class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="' . htmlspecialchars($data->nama) . '" 
                               class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Item <span class="text-red-500">*</span></label>
                        <input type="text" name="item" value="' . htmlspecialchars($data->item) . '" 
                               class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Jumlah <span class="text-red-500">*</span></label>
                        <input type="text" name="jumlah" value="' . htmlspecialchars($data->jumlah) . '" 
                               class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Keperluan Pemakaian <span class="text-red-500">*</span></label>
                    <textarea name="keperluan" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" required>' . htmlspecialchars($data->keperluan) . '</textarea>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center pt-4 border-t">
                    <div class="flex space-x-2">
                        <button type="button" onclick="navigateStep(' . ($currentStep - 1) . ')" 
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200 ' . ($prevDisabled ? 'opacity-50 cursor-not-allowed' : '') . '" 
                                ' . $prevDisabled . '>
                            ← Sebelumnya
                        </button>
                        
                        <button type="button" onclick="navigateStep(' . ($currentStep + 1) . ')" 
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200 ' . ($nextDisabled ? 'opacity-50 cursor-not-allowed' : '') . '" 
                                ' . $nextDisabled . '>
                            Selanjutnya →
                        </button>
                    </div>

                    <div class="flex space-x-2">
                        <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                            Tutup
                        </button>
                        <button type="button" onclick="saveAndNext()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
                            Simpan & Lanjut
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition duration-200">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Quick Jump -->
            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium">Lompat ke data:</span>
                    <select onchange="jumpToStep(this.value)" class="text-sm border border-gray-300 rounded px-2 py-1">
                        <option value="">-- Pilih --</option>';
                        
        for ($i = 1; $i <= $totalSteps; $i++) {
            $selected = $i == $currentStep ? 'selected' : '';
            $html .= '<option value="' . $i . '" ' . $selected . '>Data ke-' . $i . '</option>';
        }
        
        $html .= '
                    </select>
                    <span class="text-xs text-gray-500">Total: ' . $totalSteps . ' data</span>
                </div>
            </div>
        </div>';

        return $html;
    }

    // METOD BARU: Update Step dengan navigasi
    public function updateStep(Request $request, $id)
    {
        // Validasi data yang akan diupdate harus memiliki nama yang tidak null/kosong
        $pemeriksaan = PemeriksaanP3k::where('id', $id)
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->where('nama', '!=', '-')
            ->first();

        if (!$pemeriksaan) {
            return redirect()->back()->with('error', 'Data tidak dapat diedit karena kolom nama kosong atau tidak valid.');
        }

        $request->validate([
            'id_p3k' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'nama' => 'required|string',
            'item' => 'required|string',
            'jumlah' => 'required|string',
            'keperluan' => 'required|string',
            'bulan' => 'required|string',
            'current_step' => 'required|integer',
            'total_steps' => 'required|integer',
        ]);

        try {
            $transform = fn($val) => ucfirst(strtolower($val));

            $pemeriksaan->update([
                'id_p3k' => $request->id_p3k,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'nama' => $transform($request->nama),
                'item' => $transform($request->item),
                'jumlah' => $transform($request->jumlah),
                'keperluan' => $transform($request->keperluan),
            ]);

            $nextStep = $request->input('next_step');
            
            if ($nextStep && $nextStep <= $request->total_steps) {
                // Jika ada next_step, redirect ke step berikutnya
                return redirect()->route('p3k.edit.step', [
                    'id_p3k' => $request->id_p3k,
                    'bulan' => $request->bulan,
                    'step' => $nextStep
                ])->with('success', 'Data ke-' . $request->current_step . ' berhasil disimpan.');
            }

            // Jika tidak ada next_step, kembali ke halaman hasil
            return redirect()->route('p3k.hasilpemakaian', ['id_p3k' => $request->id_p3k])
                ->with('success', 'Data ke-' . $request->current_step . ' berhasil diupdate.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    // METOD BARU: Ambil data bulan yang tersedia untuk dropdown
    public function getAvailableMonths($id_p3k)
    {
        try {
            // Hanya ambil bulan dari data yang memiliki nama yang valid
            $months = PemeriksaanP3k::where('id_p3k', $id_p3k)
                ->whereNotNull('nama')
                ->where('nama', '!=', '')
                ->where('nama', '!=', '-')
                ->selectRaw('DATE_FORMAT(tanggal_pemeriksaan, "%Y-%m") as bulan, 
                           DATE_FORMAT(tanggal_pemeriksaan, "%M %Y") as bulan_nama,
                           COUNT(*) as total_data')
                ->groupBy('bulan', 'bulan_nama')
                ->orderBy('bulan', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'months' => $months
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data bulan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method destroy - hanya bisa hapus data yang memiliki nama valid
    public function destroy($id)
    {
        try {
            // Cek apakah data memiliki nama yang valid sebelum hapus
            $pemeriksaan = PemeriksaanP3k::where('id', $id)
                ->whereNotNull('nama')
                ->where('nama', '!=', '')
                ->where('nama', '!=', '-')
                ->first();

            if (!$pemeriksaan) {
                return redirect()->back()->with('error', 'Data tidak dapat dihapus karena kolom nama kosong atau tidak valid.');
            }

            $id_p3k = $pemeriksaan->id_p3k;
            $pemeriksaan->delete();

            return redirect()->route('p3k.hasilpemakaian', ['id_p3k' => $id_p3k])
                ->with('success', 'Data pemakaian berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data pemakaian: ' . $e->getMessage());
        }
    }

    public function editForm($id)
    {
        try {
            // Pastikan data memiliki nama yang valid sebelum edit
            $p = PemeriksaanP3k::where('id', $id)
                ->whereNotNull('nama')
                ->where('nama', '!=', '')
                ->where('nama', '!=', '-')
                ->first();

            if (!$p) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak dapat diedit karena kolom nama kosong atau tidak valid.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'html' => '
                <form method="POST" action="/inspeksi/pemakaian-p3k/'.$p->id.'/update" class="space-y-4 text-sm">
                    '.csrf_field().method_field('PUT').'
                    
                    <input type="hidden" name="id_p3k" value="'.htmlspecialchars($p->id_p3k).'">

                    <div>
                        <label class="block font-semibold mb-1">Tanggal Pemakaian <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pemeriksaan" value="'.$p->tanggal_pemeriksaan.'" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="'.htmlspecialchars($p->nama).'" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Item <span class="text-red-500">*</span></label>
                        <input type="text" name="item" value="'.htmlspecialchars($p->item).'" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Jumlah <span class="text-red-500">*</span></label>
                        <input type="text" name="jumlah" value="'.htmlspecialchars($p->jumlah).'" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Keperluan Pemakaian <span class="text-red-500">*</span></label>
                        <textarea name="keperluan" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" required>'.htmlspecialchars($p->keperluan).'</textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button 
                            type="button" 
                            onclick="closeEditModal()" 
                            class="px-4 py-2 rounded transition duration-200 focus:outline-none"
                            style="background-color: #6b7280; color: #ffffff;">
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2 rounded transition duration-200 focus:outline-none"
                            style="background-color: #2563eb; color: #ffffff;">
                            Simpan
                        </button>
                    </div>
                </form>'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan atau terjadi kesalahan: ' . $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Pastikan data memiliki nama yang valid sebelum update
        $pemeriksaan = PemeriksaanP3k::where('id', $id)
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->where('nama', '!=', '-')
            ->first();

        if (!$pemeriksaan) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak dapat diedit karena kolom nama kosong atau tidak valid.',
                ], 403);
            }
            return redirect()->back()->with('error', 'Data tidak dapat diedit karena kolom nama kosong atau tidak valid.');
        }

        $request->validate([
            'id_p3k' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'nama' => 'required|string',
            'item' => 'required|string',
            'jumlah' => 'required|string',
            'keperluan' => 'required|string',
        ]);
    
        try {
            $transform = fn($val) => ucfirst(strtolower($val));
    
            $pemeriksaan->update([
                'id_p3k' => $request->id_p3k,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'nama' => $transform($request->nama),
                'item' => $transform($request->item),
                'jumlah' => $transform($request->jumlah),
                'keperluan' => $transform($request->keperluan),
            ]);
    
            // Kalau request dari AJAX (fetch), balikin JSON untuk SweetAlert
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pemakaian berhasil diupdate.',
                ]);
            }
    
            // Fallback biasa
            return redirect()->route('p3k.hasilpemakaian', ['id_p3k' => $request->id_p3k])
                ->with('success', 'Pemakaian berhasil diupdate.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengupdate data pemakaian: ' . $e->getMessage(),
                ], 500);
            }
    
            return redirect()->back()->with('error', 'Gagal mengupdate data pemakaian: ' . $e->getMessage());
        }
    }
}