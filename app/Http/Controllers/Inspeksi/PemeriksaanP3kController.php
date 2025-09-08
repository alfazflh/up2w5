<?php

namespace App\Http\Controllers\Inspeksi;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanP3k;
use App\Models\P3k;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PemeriksaanP3kController extends Controller
{
    public function getDetail($id)
    {
        try {
            Log::info("getDetail called with ID: {$id}");
            
            // Find the pemeriksaan record
            $pemeriksaan = PemeriksaanP3k::findOrFail($id);
            
            Log::info("Found pemeriksaan:", $pemeriksaan->toArray());
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $pemeriksaan->id,
                    'id_p3k' => $pemeriksaan->id_p3k,
                    'tanggal_pemeriksaan' => $pemeriksaan->tanggal_pemeriksaan,
                    'petugas' => $pemeriksaan->petugas,
                    
                    // Item pemeriksaan dengan nama field yang sesuai database
                    'kasa' => $pemeriksaan->kasa,
                    'kadaluarsa_kasa' => $pemeriksaan->kadaluarsa_kasa,
                    'catatan_kasa' => $pemeriksaan->catatan_kasa,
                    
                    'perban_5' => $pemeriksaan->perban5cm,
                    'kadaluarsa_perban_5' => $pemeriksaan->kadaluarsa_perban5cm,
                    'catatan_perban_5' => $pemeriksaan->catatan_perban5cm,
                    
                    'perban_10' => $pemeriksaan->perban10cm,
                    'kadaluarsa_perban_10' => $pemeriksaan->kadaluarsa_perban10cm,
                    'catatan_perban_10' => $pemeriksaan->catatan_perban10cm,
                    
                    'plester_125' => $pemeriksaan->plester125cm,
                    'kadaluarsa_plester_125' => $pemeriksaan->kadaluarsa_plester125cm,
                    'catatan_plester_125' => $pemeriksaan->catatan_plester125cm,
                    
                    'plester_cepat' => $pemeriksaan->plester,
                    'kadaluarsa_plester_cepat' => $pemeriksaan->kadaluarsa_plester,
                    'catatan_plester_cepat' => $pemeriksaan->catatan_plester,
                    
                    'kapas' => $pemeriksaan->kapas,
                    'kadaluarsa_kapas' => $pemeriksaan->kadaluarsa_kapas,
                    'catatan_kapas' => $pemeriksaan->catatan_kapas,
                    
                    'mittela' => $pemeriksaan->mittela,
                    'kadaluarsa_mittela' => $pemeriksaan->kadaluarsa_mittela,
                    'catatan_mittela' => $pemeriksaan->catatan_mittela,
                    
                    'gunting' => $pemeriksaan->gunting,
                    'kadaluarsa_gunting' => $pemeriksaan->kadaluarsa_gunting,
                    'catatan_gunting' => $pemeriksaan->catatan_gunting,
                    
                    'peniti' => $pemeriksaan->peniti,
                    'kadaluarsa_peniti' => $pemeriksaan->kadaluarsa_peniti,
                    'catatan_peniti' => $pemeriksaan->catatan_peniti,
                    
                    'sarung_tangan' => $pemeriksaan->sarung_tangan,
                    'kadaluarsa_sarung_tangan' => $pemeriksaan->kadaluarsa_sarung_tangan,
                    'catatan_sarung_tangan' => $pemeriksaan->catatan_sarung_tangan,
                    
                    'masker' => $pemeriksaan->masker,
                    'kadaluarsa_masker' => $pemeriksaan->kadaluarsa_masker,
                    'catatan_masker' => $pemeriksaan->catatan_masker,
                    
                    'pinset' => $pemeriksaan->pinset,
                    'kadaluarsa_pinset' => $pemeriksaan->kadaluarsa_pinset,
                    'catatan_pinset' => $pemeriksaan->catatan_pinset,
                    
                    'senter' => $pemeriksaan->senter,
                    'kadaluarsa_senter' => $pemeriksaan->kadaluarsa_senter,
                    'catatan_senter' => $pemeriksaan->catatan_senter,
                    
                    'gelas' => $pemeriksaan->gelas,
                    'kadaluarsa_gelas' => $pemeriksaan->kadaluarsa_gelas,
                    'catatan_gelas' => $pemeriksaan->catatan_gelas,
                    
                    'plastik' => $pemeriksaan->plastik,
                    'kadaluarsa_plastik' => $pemeriksaan->kadaluarsa_plastik,
                    'catatan_plastik' => $pemeriksaan->catatan_plastik,
                    
                    'aquades' => $pemeriksaan->aquades,
                    'kadaluarsa_aquades' => $pemeriksaan->kadaluarsa_aquades,
                    'catatan_aquades' => $pemeriksaan->catatan_aquades,
                    
                    'povidon' => $pemeriksaan->povidon,
                    'kadaluarsa_povidon' => $pemeriksaan->kadaluarsa_povidon,
                    'catatan_povidon' => $pemeriksaan->catatan_povidon,
                    
                    'alkohol' => $pemeriksaan->alkohol,
                    'kadaluarsa_alkohol' => $pemeriksaan->kadaluarsa_alkohol,
                    'catatan_alkohol' => $pemeriksaan->catatan_alkohol,
                    
                    'panduan' => $pemeriksaan->panduanp3k,
                    'kadaluarsa_panduan' => $pemeriksaan->kadaluarsa_panduanp3k,
                    'catatan_panduan' => $pemeriksaan->catatan_panduanp3k,
                    
                    'daftar_isi' => $pemeriksaan->daftarisi,
                    'kadaluarsa_daftar_isi' => $pemeriksaan->kadaluarsa_daftarisi,
                    'catatan_daftar_isi' => $pemeriksaan->catatan_daftarisi,
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error("Error in getDetail: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }



    public function store(Request $request)
    {
        // Debug logging
        Log::info('=== P3K STORE REQUEST START ===');
        Log::info('Request Data:', $request->all());

        // Test database connection
        try {
            DB::connection()->getPdo();
            Log::info('Database connection: OK');
        } catch (\Exception $e) {
            Log::error('Database connection failed: ' . $e->getMessage());
            return back()->with('error', 'Database connection failed: ' . $e->getMessage());
        }

        // Validate required fields
        $request->validate([
            'id_p3k' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
        ]);

        // P3K Items list (complete and correct)
        $p3kItems = [
            'kasa', 'perban5cm', 'perban10cm', 'plester125cm', 'plester', 'kapas', 
            'mittela', 'gunting', 'peniti', 'sarung_tangan', 'pasangan', 'masker', 
            'pinset', 'senter', 'gelas', 'plastik', 'aquades', 'povidon', 'alkohol', 
            'panduanp3k', 'daftarisi'
        ];

        // Function to transform form values to database format
        $transformValue = function($kondisi, $jumlah) {
            // If number input has value and > 0, use that number
            if (!empty($jumlah) && is_numeric($jumlah) && $jumlah > 0) {
                return (string) $jumlah;
            }
            // Otherwise use radio button value
            if ($kondisi === 'baik') {
                return 'Baik';
            } elseif ($kondisi === 'tidak') {
                return 'Tidak Baik';
            }
            // Default fallback
            return 'Baik';
        };

        try {
            DB::beginTransaction();

            // Get P3K reference data
            $p3k = P3k::where('id_p3k', $request->id_p3k)->first();

            // Prepare base data
            $pemeriksaanData = [
                'id_p3k' => $request->id_p3k,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'petugas' => $request->petugas,
            ];

            // Process each P3K item
            foreach ($p3kItems as $item) {
                $kondisi = $request->input($item . '_kondisi');
                $jumlah = $request->input($item . '_jumlah');
                $kadaluarsa = $request->input('kadaluarsa_' . $item);
                $catatan = $request->input('catatan_' . $item);

                // Transform the main value
                $pemeriksaanData[$item] = $transformValue($kondisi, $jumlah);
                
                // Add expiry date and notes
                $pemeriksaanData['kadaluarsa_' . $item] = $kadaluarsa ?: null;
                $pemeriksaanData['catatan_' . $item] = $catatan;

                // Log individual item processing
                Log::info("Processing {$item}:", [
                    'kondisi' => $kondisi,
                    'jumlah' => $jumlah,
                    'final_value' => $pemeriksaanData[$item],
                    'kadaluarsa' => $kadaluarsa,
                    'catatan' => $catatan
                ]);
            }

            Log::info('Final data to be saved:', $pemeriksaanData);

            // Create the pemeriksaan record
            $pemeriksaan = PemeriksaanP3k::create($pemeriksaanData);
            
            DB::commit();

            Log::info('P3K inspection saved successfully with ID: ' . $pemeriksaan->id);

            return redirect()->route('p3k.hasil', ['id_p3k' => $request->id_p3k])
                ->with('success', 'Pemeriksaan P3K berhasil disimpan');
                
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Log::error('Database Query Error: ' . $e->getMessage());
            Log::error('SQL Error Code: ' . $e->getCode());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->with('error', 'Database error: ' . $e->getMessage())
                ->withInput();
                
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('General Error saving P3K inspection: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->with('error', 'Error saving data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('=== P3K UPDATE REQUEST START ===');
        Log::info('Update ID: ' . $id);
        Log::info('Request Data:', $request->all());

        // Validate basic fields
        $request->validate([
            'tanggal_pemeriksaan' => 'required|date',
            'petugas' => 'required|string|max:255',
        ]);

        try {
            $pemeriksaan = PemeriksaanP3k::findOrFail($id);

            // Function to transform value for update
            $transformValue = function($val) {
                if (is_null($val) || $val === '') {
                    return null;
                }
                
                if (is_numeric($val) && $val > 0) {
                    return (string) $val;
                }
                
                $val = strtolower(trim($val));
                if (in_array($val, ['baik', 'ada', 'lengkap', 'good'])) {
                    return 'Baik';
                } elseif (in_array($val, ['tidak baik', 'tidak', 'tidak ada', 'kurang', 'bad'])) {
                    return 'Tidak Baik';
                }
                
                return ucfirst($val);
            };

            // P3K items list
            $p3kItems = [
                'kasa', 'perban5cm', 'perban10cm', 'plester125cm', 'plester', 'kapas', 
                'mittela', 'gunting', 'peniti', 'sarung_tangan', 'pasangan', 'masker', 
                'pinset', 'senter', 'gelas', 'plastik', 'aquades', 'povidon', 'alkohol', 
                'panduanp3k', 'daftarisi'
            ];

            // Prepare update data
            $updateData = [
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'petugas' => $request->petugas,
            ];

            // Process each P3K item
            foreach ($p3kItems as $item) {
                $itemValue = $request->input($item);
                $kadaluarsaValue = $request->input('kadaluarsa_' . $item);
                $catatanValue = $request->input('catatan_' . $item);

                if ($itemValue !== null) {
                    $updateData[$item] = $transformValue($itemValue);
                }
                
                $updateData['kadaluarsa_' . $item] = $kadaluarsaValue ?: null;
                $updateData['catatan_' . $item] = $catatanValue;
                
                Log::info("Processing {$item} for update:", [
                    'original' => $itemValue,
                    'transformed' => $updateData[$item],
                    'kadaluarsa' => $kadaluarsaValue,
                    'catatan' => $catatanValue
                ]);
            }

            Log::info('Update data prepared:', $updateData);

            $pemeriksaan->update($updateData);
            
            Log::info('P3K inspection updated successfully: ID ' . $id);

            // Return JSON response for AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pemeriksaan P3K berhasil diupdate.',
                    'data' => $pemeriksaan->fresh()
                ]);
            }

            return redirect()->back()->with('success', 'Pemeriksaan P3K berhasil diupdate.');
            
        } catch (\Exception $e) {
            Log::error('Error updating P3K inspection: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pemeriksaan = PemeriksaanP3k::findOrFail($id);
            $id_p3k = $pemeriksaan->id_p3k; // Store for redirect
            $pemeriksaan->delete();

            Log::info('P3K inspection deleted successfully: ID ' . $id);

            return redirect()->back()->with('success', 'Data pemeriksaan P3K berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting P3K inspection: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Get edit form for AJAX request
     */
    public function getEditForm($id)
    {
        try {
            $pemeriksaan = PemeriksaanP3k::findOrFail($id);
            
            // P3K Items dengan nama yang user-friendly
            $p3kItems = [
                'kasa' => ['label' => 'Kasa Steril Terbungkus', 'standar' => '20'],
                'perban5cm' => ['label' => 'Perban (lebar 5 cm)', 'standar' => '2'],
                'perban10cm' => ['label' => 'Perban (lebar 10 cm)', 'standar' => '2'],
                'plester125cm' => ['label' => 'Plester (lebar 1,25 cm)', 'standar' => '2'],
                'plester' => ['label' => 'Plester Cepat', 'standar' => '10'],
                'kapas' => ['label' => 'Kapas (25 gram)', 'standar' => '1'],
                'mittela' => ['label' => 'Kain segitiga/mittela', 'standar' => '2'],
                'gunting' => ['label' => 'Gunting', 'standar' => '1'],
                'peniti' => ['label' => 'Peniti', 'standar' => '12'],
                'sarung_tangan' => ['label' => 'Sarung tangan sekali pakai', 'standar' => '2'],
                'pasangan' => ['label' => '(pasangan)', 'standar' => '2'],
                'masker' => ['label' => 'Masker', 'standar' => '1'],
                'pinset' => ['label' => 'Pinset', 'standar' => '1'],
                'senter' => ['label' => 'Lampu senter', 'standar' => '1'],
                'gelas' => ['label' => 'Gelas untuk cuci mata', 'standar' => '1'],
                'plastik' => ['label' => 'Kantong plastik bersih', 'standar' => '1'],
                'aquades' => ['label' => 'Aquades (100 ml lar. Saline)', 'standar' => '1'],
                'povidon' => ['label' => 'Povidon Iodin (60 ml)', 'standar' => '1'],
                'alkohol' => ['label' => 'Alkohol 70%', 'standar' => '1'],
                'panduanp3k' => ['label' => 'Buku panduan P3K di tempat kerja', 'standar' => '1'],
                'daftarisi' => ['label' => 'Buku catatan Daftar isi kotak P3K', 'standar' => '1']
            ];
    
            // Format tanggal untuk input date
            $tanggalFormatted = Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('Y-m-d');
            
            // Generate form HTML
            $html = '
            <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: 20px;" onclick="closeEditModal()">
                <div style="background: white; border-radius: 10px; width: 100%; max-width: 900px; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 30px rgba(0,0,0,0.3);" onclick="event.stopPropagation()">
                    
                    <!-- Header -->
                    <div style="padding: 20px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: center; align-items: center; position: relative;">
                    <h3 class="text-lg font-semibold" style="margin: 0; color:#196275;">Edit Pemeriksaan</h3>
                    <button type="button" onclick="closeEditModal()" style="position: absolute; right: 20px; background: none; border: none; color: #6b7280; font-size: 24px; cursor: pointer; padding: 0; width: 30px; height: 30px;">×</button>
                </div>
                    
                    <!-- Form Body -->
                    <div style="padding: 30px;">
                        <form action="' . route('pemeriksaan-p3k.update', $pemeriksaan->id) . '" method="POST">
                            ' . csrf_field() . '
                            ' . method_field('PUT') . '
                            
                            <!-- Basic Info -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 35px;">
                                <div style="display: flex; flex-direction: column;">
                                    <label style="font-weight: 600; margin-bottom: 8px; color: #374151; font-size: 0.95rem;">Tanggal Pemeriksaan *</label>
                                    <input type="date" name="tanggal_pemeriksaan" value="' . $tanggalFormatted . '" 
                                           style="padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 0.95rem; transition: border-color 0.2s;" 
                                           onfocus="this.style.borderColor=\'#196275\'" onblur="this.style.borderColor=\'#e5e7eb\'" required>
                                </div>
                                
                                <div style="display: flex; flex-direction: column;">
                                    <label style="font-weight: 600; margin-bottom: 8px; color: #374151; font-size: 0.95rem;">Petugas Pemeriksa *</label>
                                    <input type="text" name="petugas" value="' . htmlspecialchars($pemeriksaan->petugas) . '" 
                                           placeholder="Nama petugas pemeriksa"
                                           style="padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 0.95rem; transition: border-color 0.2s;" 
                                           onfocus="this.style.borderColor=\'#196275\'" onblur="this.style.borderColor=\'#e5e7eb\'" required>
                                </div>
                            </div>
    
                            <!-- Items Section -->
                            <div style="background: #f8fafc; padding: 25px; border-radius: 10px; margin-bottom: 25px; border: 1px solid #e5e7eb;">
                                <h4 style="margin: 0 0 25px 0; color: #1f2937; font-size: 1.1rem; font-weight: 600; border-bottom: 2px solid #196275; padding-bottom: 10px;">
                                    Daftar Item P3K
                                </h4>';
    
            foreach ($p3kItems as $key => $item) {
                $currentValue = $pemeriksaan->{$key} ?? '';
                $currentKadaluarsa = $pemeriksaan->{'kadaluarsa_' . $key} ?? '';
                $currentCatatan = $pemeriksaan->{'catatan_' . $key} ?? '';
                
                // Format tanggal kadaluarsa untuk input date
                $kadaluarsaFormatted = '';
                if ($currentKadaluarsa) {
                    try {
                        $kadaluarsaFormatted = Carbon::parse($currentKadaluarsa)->format('Y-m-d');
                    } catch (\Exception $e) {
                        $kadaluarsaFormatted = '';
                    }
                }
    
                $html .= '
                    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 18px; border: 1px solid #e5e7eb; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
                            <div style="display: flex; flex-direction: column;">
                                <label style="font-weight: 600; margin-bottom: 8px; color: #374151; font-size: 0.9rem;">' . $item['label'] . '</label>
                                <input type="text" name="' . $key . '" value="' . htmlspecialchars($currentValue) . '" 
                                       placeholder="Kondisi/Jumlah"
                                       style="padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor=\'#196275\'" onblur="this.style.borderColor=\'#d1d5db\'">
                                <small style="color: #6b7280; margin-top: 5px; font-size: 0.8rem;">Standar: ' . $item['standar'] . '</small>
                            </div>
                            
                            <div style="display: flex; flex-direction: column;">
                                <label style="font-weight: 600; margin-bottom: 8px; color: #374151; font-size: 0.9rem;">Tanggal Kadaluarsa</label>
                                <input type="date" name="kadaluarsa_' . $key . '" value="' . $kadaluarsaFormatted . '"
                                       style="padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor=\'#196275\'" onblur="this.style.borderColor=\'#d1d5db\'">
                            </div>
                            
                            <div style="display: flex; flex-direction: column;">
                                <label style="font-weight: 600; margin-bottom: 8px; color: #374151; font-size: 0.9rem;">Catatan</label>
                                <textarea name="catatan_' . $key . '" rows="2" placeholder="Catatan khusus"
                                          style="padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; resize: vertical; font-family: inherit; transition: border-color 0.2s;"
                                          onfocus="this.style.borderColor=\'#196275\'" onblur="this.style.borderColor=\'#d1d5db\'">' . htmlspecialchars($currentCatatan) . '</textarea>
                            </div>
                        </div>
                    </div>
                ';
            }
    
            $html .= '
                            </div>
    
                            <!-- Form Actions -->
                            <div style="display: flex; gap: 15px; justify-content: flex-end; padding-top: 25px; border-top: 1px solid #e5e7eb;">
                                <button type="button" onclick="closeEditModal()" 
                                        style="padding: 12px 24px; background: #6b7280; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; font-size: 0.95rem; transition: background-color 0.2s;"
                                        onmouseover="this.style.backgroundColor=\'#4b5563\'" onmouseout="this.style.backgroundColor=\'#6b7280\'">
                                    Batal
                                </button>
                                <button type="submit" 
                                        style="padding: 12px 24px; background: #196275; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; font-size: 0.95rem; transition: background-color 0.2s;"
                                        onmouseover="this.style.backgroundColor=\'#134e5e\'" onmouseout="this.style.backgroundColor=\'#196275\'">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
    
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error generating edit form: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat form edit: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show results page with filtering by petugas
     */
    public function showResults($id_p3k)
    {
        try {
            // Get P3K data
            $p3k = P3k::where('id_p3k', $id_p3k)->firstOrFail();
            
            // Get pemeriksaan data - hanya yang memiliki petugas
            $pemeriksaans = PemeriksaanP3k::where('id_p3k', $id_p3k)
                ->whereNotNull('petugas')
                ->where('petugas', '!=', '')
                ->orderBy('tanggal_pemeriksaan', 'desc')
                ->get();

            return view('p3k.hasil', compact('pemeriksaans', 'id_p3k', 'p3k'));

        } catch (\Exception $e) {
            Log::error('Error showing P3K results: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal memuat data hasil pemeriksaan: ' . $e->getMessage());
        }
    }

    /**
     * Test method untuk debugging database connection
     */
    public function testDb()
    {
        try {
            // Test basic connection
            $pdo = DB::connection()->getPdo();
            Log::info('Database connection test: SUCCESS');
            
            // Test table exists
            $tableExists = DB::select("SHOW TABLES LIKE 'pemeriksaan_p3k'");
            Log::info('Table pemeriksaan_p3k exists: ' . (count($tableExists) > 0 ? 'YES' : 'NO'));
            
            // Test simple select
            $testSelect = PemeriksaanP3k::take(1)->get();
            Log::info('Test select SUCCESS, records found: ' . $testSelect->count());
            
            // Test simple insert
            $testData = [
                'id_p3k' => 'TEST-' . now()->timestamp,
                'tanggal_pemeriksaan' => now(),
                'petugas' => 'Test User',
                'kasa' => 'Baik',
                'perban5cm' => 'Baik',
                'perban10cm' => 'Baik',
                'plester125cm' => 'Baik',
                'plester' => 'Baik',
                'kapas' => 'Baik',
                'mittela' => 'Baik',
                'gunting' => 'Baik',
                'peniti' => 'Baik',
                'sarung_tangan' => 'Baik',
                'pasangan' => 'Baik',
                'masker' => 'Baik',
                'pinset' => 'Baik',
                'senter' => 'Baik',
                'gelas' => 'Baik',
                'plastik' => 'Baik',
                'aquades' => 'Baik',
                'povidon' => 'Baik',
                'alkohol' => 'Baik',
                'panduanp3k' => 'Baik',
                'daftarisi' => 'Baik',
            ];
            
            $result = PemeriksaanP3k::create($testData);
            Log::info('Test insert SUCCESS, ID: ' . $result->id);
            
            // Clean up test data
            $result->delete();
            Log::info('Test data cleaned up successfully');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Database test completed successfully',
                'connection' => 'OK',
                'table_exists' => count($tableExists) > 0,
                'select_test' => 'OK',
                'insert_test' => 'OK',
                'cleanup_test' => 'OK'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Database test failed: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Database test failed: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Get summary statistics for dashboard
     */
    public function getSummaryStats($id_p3k = null)
    {
        try {
            $query = PemeriksaanP3k::whereNotNull('petugas')
                ->where('petugas', '!=', '');
            
            if ($id_p3k) {
                $query->where('id_p3k', $id_p3k);
            }
            
            $totalPemeriksaan = $query->count();
            $pemeriksaanBulanIni = $query->whereMonth('tanggal_pemeriksaan', now()->month)
                ->whereYear('tanggal_pemeriksaan', now()->year)
                ->count();
            
            $terakhirPemeriksaan = $query->latest('tanggal_pemeriksaan')->first();
            
            return [
                'total_pemeriksaan' => $totalPemeriksaan,
                'pemeriksaan_bulan_ini' => $pemeriksaanBulanIni,
                'terakhir_pemeriksaan' => $terakhirPemeriksaan ? 
                    Carbon::parse($terakhirPemeriksaan->tanggal_pemeriksaan)->diffForHumans() : 
                    'Belum ada data',
                'terakhir_petugas' => $terakhirPemeriksaan->petugas ?? 'N/A'
            ];
            
        } catch (\Exception $e) {
            Log::error('Error getting summary stats: ' . $e->getMessage());
            
            return [
                'total_pemeriksaan' => 0,
                'pemeriksaan_bulan_ini' => 0,
                'terakhir_pemeriksaan' => 'Error',
                'terakhir_petugas' => 'Error'
            ];
        }
    }

    /**
     * Get monthly inspection report
     */
    public function getMonthlyReport($id_p3k, $month = null, $year = null)
    {
        try {
            $month = $month ?? now()->month;
            $year = $year ?? now()->year;
            
            $inspections = PemeriksaanP3k::where('id_p3k', $id_p3k)
                ->whereMonth('tanggal_pemeriksaan', $month)
                ->whereYear('tanggal_pemeriksaan', $year)
                ->whereNotNull('petugas')
                ->where('petugas', '!=', '')
                ->orderBy('tanggal_pemeriksaan', 'desc')
                ->get();

            $monthName = Carbon::createFromDate($year, $month, 1)->format('F Y');

            return [
                'month' => $monthName,
                'total_inspections' => $inspections->count(),
                'inspections' => $inspections,
                'summary' => $this->generateInspectionSummary($inspections)
            ];

        } catch (\Exception $e) {
            Log::error('Error generating monthly report: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Generate inspection summary for reporting
     */
    private function generateInspectionSummary($inspections)
    {
        if ($inspections->isEmpty()) {
            return ['message' => 'Tidak ada data inspeksi'];
        }

        $p3kItems = [
            'kasa', 'perban5cm', 'perban10cm', 'plester125cm', 'plester', 'kapas', 
            'mittela', 'gunting', 'peniti', 'sarung_tangan', 'pasangan', 'masker', 
            'pinset', 'senter', 'gelas', 'plastik', 'aquades', 'povidon', 'alkohol', 
            'panduanp3k', 'daftarisi'
        ];

        $summary = [];
        foreach ($p3kItems as $item) {
            $goodCount = $inspections->where($item, 'Baik')->count();
            $totalCount = $inspections->count();
            $percentage = $totalCount > 0 ? round(($goodCount / $totalCount) * 100, 1) : 0;
            
            $summary[$item] = [
                'good_count' => $goodCount,
                'total_count' => $totalCount,
                'percentage' => $percentage,
                'status' => $percentage >= 80 ? 'good' : ($percentage >= 60 ? 'warning' : 'danger')
            ];
        }

        return $summary;
    }

    /**
     * Export data to Excel/CSV
     */
    public function exportData($id_p3k, $format = 'csv')
    {
        try {
            $inspections = PemeriksaanP3k::where('id_p3k', $id_p3k)
                ->whereNotNull('petugas')
                ->where('petugas', '!=', '')
                ->orderBy('tanggal_pemeriksaan', 'desc')
                ->get();

            if ($inspections->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data untuk diekspor');
            }

            // Here you would implement the actual export logic
            // For now, returning a simple response
            return response()->json([
                'success' => true,
                'message' => 'Export akan dimulai...',
                'data_count' => $inspections->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error exporting data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengekspor data: ' . $e->getMessage());
        }
    }
}