<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - P3K</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    @vite('resources/css/app.css')
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }

        #detailModal {
    position: fixed;
    inset: 0;
    display: none;
    align-items: flex-start;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    overflow-y: auto;
    padding: 40px 16px;
}

#detailModal.flex {
    display: flex;
}

#printArea {
    background: white;
    border: 1px solid black;
    width: 100%;
    max-width: 700px;
    padding: 24px;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
}

.modal-buttons {
    position: absolute;
    top: 16px;
    right: 16px;
    display: flex;
    gap: 10px;
    z-index: 10;
}

.save-pdf-btn,
.close-btn {
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.save-pdf-btn {
    background: #196275;
    color: white;
    width: 140px;
    height: 30px;
}

.close-btn {
    width: 30px;
    height: 30px;
    font-size: 28px;
    font-weight: bold;
    line-height: 30px;
    text-align: center;
    background: white;
    color: black;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    top: -2px; 
}

.modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 8px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-left img {
            width: 50px;
            height: 60px;
        }

        .header-left h2 {
            font-size: 11px;
            font-weight: bold;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .header-right {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
            gap: 10px;
        }

        .iso-logo {
            width: 200px;
            height: auto;
        }

        .header-table {
    border-collapse: collapse;
    width: calc(100% + 50px);
    margin-left: -25px;
    margin-right: -25px;
    margin-top: -10px !important;
    table-layout: fixed;
}

    .header-table td {
    border: 1px solid black;
    vertical-align: middle;
    padding: 0;
}

    .title-section {
        text-align: center;
        padding: 2px;
    }

    .title-section h1 {
    font-size: 25px;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
}

.title-section h2 {
    font-size: 15px;
    font-weight: 700;
    margin: 2px 0 0 0;
    line-height: 1.2;
}

    .title-section p {
        font-size: 14px;
        font-weight: 700;
        margin: 0;
    }

    .info-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 11px;
        height: 100%;
    }

    .info-table td {
        border: 1px solid black;
        padding: 1px 3px;
        height: 18px;
    }

    .right-cell {
    border: none;
    padding: 0;
}

.right-cell .info-table {
    border-collapse: collapse;
    width: 100%;
}

.right-cell .info-table td {
    border: 1px solid black;
}

.right-cell .info-table tr:first-child td {
    border-top: none;
}

.right-cell .info-table tr:last-child td {
    border-bottom: none;
}

.right-cell .info-table td:first-child {
    border-left: none;
}

.right-cell .info-table td:last-child {
    border-right: none;
}

    .label {
        width: 65px;
        white-space: nowrap;
    }


    .info-section {
    display: grid;
    grid-template-columns: auto auto auto auto; /* 4 kolom */
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 15px;
    font-weight: 600;
}

.info-section div {
    border: 1px solid black;
    padding: 2px 6px;
}


.inspection-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    font-size: 11px;
    position: relative;
    top: -1px;
    border-collapse: collapse;
    width: calc(100% + 50px);
    margin-left: -25px; 
    margin-right: -25px;
}

.inspection-table th {
    background-color: white;
    color: black;
    padding: 4px 6px; 
    text-align: center;
    font-weight: 600;
    border: 1px solid black;
}

.inspection-table td {
    padding: 4px 6px;
    border: 1px solid black;
    text-align: center;
}

.inspection-table .info-row {
    background-color: white;
    color: black;
}



.footer-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-top: 20px;
}

.catatan-section {
    flex: 1;
    font-size: 11px;
    font-weight: normal;
    max-width: 300px;     
    word-wrap: break-word; 
    white-space: normal;   
}


.signature-section {
    text-align: center;
    min-width: 240px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.signature-section img {
    height: 100px;
    margin: 0;
    margin-bottom: -25px; 
    z-index: 1;
    position: relative;
}

.signature-section p,span {
    margin: 0;
    z-index: 0;
    position: relative;
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 6px;
}

        .empty-row td {
            height: 25px;
            border-bottom: 1px solid #000;
        }

        /* Modal Edit Sequential Styles */
        #editSequentialModal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        #editSequentialModal .modal-content {
            background: white;
            border-radius: 8px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body id="main-body" class="bg-white text-gray-800">
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 bg-primary border-b shadow px-4 py-3">
        <div class="relative flex items-center justify-between">

        <div class="flex items-center gap-4">
            <a href="{{ route('welcome') }}" class="relative z-10">
            <img src="https://www.danantaraindonesia.com/images/v3/danantara-logo-black-v3.png" 
                alt="Logo Danantara" 
                class="h-14 w-32 md:h-14 md:w-38 object-contain" />
            </a>

            <div class="flex md:hidden gap-3">
            <a href="{{ route('welcome') }}" class="relative z-10">
                    <img src="https://cdn-b.heylink.me/media/users/og_image/56edc2ef0edd4e75b3784913f6dac9e8.webp" 
                        alt="Logo HSSE" 
                        class="h-12 w-12 object-contain" />
                </a>
            <a href="{{ route('welcome') }}" class="relative z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/97/Logo_PLN.png/960px-Logo_PLN.png" 
                    alt="Logo PLN" 
                    class="h-12 w-12 object-contain" />
            </a>
            </div>
        </div>

        <div class="flex flex-col text-center md:hidden">
            <h1 class="font-bold text-white leading-tight text-sm sm:text-lg">
            MONITORING P3K
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
                MONITORING P3K
            </h1>
            <h2 class="text-sm sm:text-base md:text-xl text-white font-semibold mt-1">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="hidden md:flex items-center gap-5">
            <a href="{{ route('welcome') }}" class="relative z-10">
                <img src="https://cdn-b.heylink.me/media/users/og_image/56edc2ef0edd4e75b3784913f6dac9e8.webp" 
                    alt="Logo HSSE" 
                    class="h-16 w-16 md:h-18 md:w-18 object-contain" />
                </a>
            <a href="{{ route('welcome') }}" class="relative z-10">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/97/Logo_PLN.png/960px-Logo_PLN.png" 
                alt="Logo PLN" 
                class="h-16 w-16 md:h-18 md:w-18 object-contain" />
            </a>
        </div>
        </div>
    </header>
    <div id="spacer" class="pt-32"></div>

    <div class="fixed max-w-6xl mx-auto px-4 mt-6">
        <a href="{{ route('p3k.show', ['id_p3k' => $id_p3k]) }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
            ←
        </a>
    </div>

    <div class="max-w-6xl mx-auto px-4 mt-6">
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Data Pemakaian</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php 
                        $no = 1; 
                        // Group pemeriksaan by month and year, filter hanya yang memiliki data dengan nama valid
                        $groupedPemeriksaan = $pemeriksaans->filter(function($item) {
                            return !empty($item->tanggal_pemeriksaan) && 
                                   !empty($item->nama) && 
                                   trim($item->nama) !== '' && 
                                   $item->nama !== '-';
                        })->groupBy(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('Y-m');
                        })->sortKeysDesc();
                    @endphp

                    @forelse ($groupedPemeriksaan as $monthYear => $monthData)
                        @php
                            $firstItem = $monthData->first();
                            $monthName = \Carbon\Carbon::parse($firstItem->tanggal_pemeriksaan)->translatedFormat('F Y');
                            
                            // Filter data yang memiliki nama valid untuk edit/hapus
                            $editableData = $monthData->filter(function($item) {
                                return !empty($item->nama) && 
                                       trim($item->nama) !== '' && 
                                       $item->nama !== '-';
                            });

                            // Prepare data for modal - hanya ambil data yang memiliki nama valid
                            $validDataForMonth = $monthData->filter(function($item) {
                                return !empty($item->nama) && 
                                       trim($item->nama) !== '' && 
                                       $item->nama !== '-';
                            })->map(function($item) {
                                return [
                                    'id' => $item->id,
                                    'nama' => $item->nama,
                                    'item' => $item->item,
                                    'jumlah' => $item->jumlah,
                                    'keperluan' => $item->keperluan,
                                    'tanggal_pemeriksaan' => $item->tanggal_pemeriksaan,
                                    'tanggal_formatted' => \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y')
                                ];
                            });

                            $modalData = [
                                'id_p3k' => $firstItem->id_p3k,
                                'bulan' => \Carbon\Carbon::parse($firstItem->tanggal_pemeriksaan)->translatedFormat('F'),
                                'tahun' => \Carbon\Carbon::parse($firstItem->tanggal_pemeriksaan)->format('Y'),
                                'nomor' => $firstItem->id_p3k ?? '10',
                                'lokasi' => $firstItem->id_p3k,
                                'items' => $validDataForMonth
                            ];
                        @endphp
                        
                        {{-- Hanya tampilkan baris jika ada data dengan nama valid --}}
                        @if($editableData->count() > 0)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $no++ }}</td>
                            <td class="px-4 py-3">
                                Pemakaian P3K {{ $firstItem->id_p3k }} Bulan {{ $monthName }}
                                <span class="text-gray-500 text-xs">({{ $editableData->count() }} item)</span>
                            </td>
                            
                            <td class="px-4 py-3 text-center space-x-2">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <button onclick='showDetail(@json($modalData))'
                                            class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                                        Detail
                                    </button>

                                    @auth
                                    @if(Auth::user()->role === 'admin')
                                        {{-- Edit Sequential Button untuk data dengan nama valid --}}
                                        <button onclick="openEditSequentialModal('{{ $firstItem->id_p3k }}', '{{ $monthYear }}')"
                                                class="hidden bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
                                            Edit Batch
                                        </button>
                                        
                                        {{-- Edit Single untuk data pertama yang valid --}}
                                        @php
                                            $firstEditableItem = $editableData->first();
                                        @endphp
                                        @if($firstEditableItem)
                                        <button onclick="openEditModal({{ $firstEditableItem->id }})"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">
                                            Edit
                                        </button>
                                        <button onclick="confirmDelete({{ $firstEditableItem->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">
                                            Hapus
                                        </button>
                                        <form id="delete-form-{{ $firstEditableItem->id }}"
                                            action="{{ route('pemakaian-p3k.destroy', $firstEditableItem->id) }}"
                                              method="POST" class="hidden">
                                            @csrf @method('DELETE')
                                        </form>
                                        @endif
                                    @endif
                                @endauth
                                </div>
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">
                                Tidak ada data pemakaian yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal Detail Pemeriksaan -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
    <div class="bg-white relative" style="border-radius: 8px; width: 750px">
        <!-- Tombol di pojok kanan atas -->
        <div class="modal-buttons">
            <button onclick="downloadPDF()" class="save-pdf-btn">Save As PDF</button>
            <button onclick="closeModal()" class="close-btn">&times;</button>
        </div><br><br><br>
        <div id="printArea" style="justify-content: center; margin: 0 auto;">
            <div class="modal-header">
                <div class="header-left">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" alt="PLN Logo">
                    <img src="https://ik.imagekit.io/pln/pt?updatedAt=1754287380671" alt="teks logo"
                    style="width: 200px; height: auto; display: block; margin: 0 auto;">                   
                </div>
                <div class="header-right">
                    <img class="iso-logo" src="https://ik.imagekit.io/pln/iso.png?updatedAt=1754449539965" alt="ISO Logo">
                </div>                    
            </div>

            <table class="header-table">
                <tr>
                    <!-- Kiri -->
                    <td style="width: 68%; height: 100%; border-left: none; border-right: none; border-top: 1px solid black; border-bottom: 1px solid black;">
                        <div class="title-section">
                            <h1>FORM PEMAKAIAN ALAT P3K</h1>
                            <span id="detail-tanggal" class="hidden"></span>
                        </div>
                    </td>                    
        
                    <!-- Kanan -->
                    <td class="right-cell" style="width: 32%;">
                        <table class="info-table">
                            <tr>
                                <td class="label">No. Dokumen</td>
                                <td>: FR.04-PT.20.K3L</td>
                            </tr>
                            <tr>
                                <td class="label">Revisi</td>
                                <td>: 05</td>
                            </tr>
                            <tr>
                                <td class="label">Tanggal</td>
                                <td>: 24 Januari 2025</td>
                            </tr>
                            <tr>
                                <td class="label">Halaman</td>
                                <td>: 1 dari 1 halaman</td>
                            </tr>
                        </table>
                    </td>                    
                </tr>
            </table>

        <!-- Info section dengan 4 kolom -->
        <table class="info-table" 
        style="border-collapse: collapse;
            width: calc(100% + 50px);
            margin-left: -25px; 
            margin-right: -25px;
            font-size: 11px; 
            margin-top: 15px;
            table-layout: fixed;">
        <tr>
            <td style="border: 1px solid black; padding: 3px; width: 9.8px;">Waktu Pemakaian</td>
            <td style="border: 1px solid black; padding: 3px; width: 41px;">: <span id="detail-bulan">-</span></td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 3px;">Lokasi</td>
            <td style="border: 1px solid black; padding: 3px;">: <span id="detail-lokasi">-</span></td>
        </tr>
    </table>
    
        <!-- Tabel pemeriksaan -->
        <table class="inspection-table">
            <thead>
                <tr><td class="bg-white" colspan="7" style="border: 1px solid black; height: 15px;"></td></tr>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-nama">NAMA</th>                            
                    <th class="col-item">ITEM</th>                            
                    <th class="col-jumlah">JUMLAH</th>                            
                    <th class="col-keperluan">KEPERLUAN PEMAKAIAN</th>                            
                    <th class="col-tanggal">TANGGAL</th>                            
                    <th class="hidden col-paraf">PARAF</th> 
                </tr>
            </thead>
            <tbody id="detail-table-body">
                <!-- akan diisi lewat JS -->
            </tbody>
        </table>

        <!-- Footer section -->
        <div class="footer-section">
            <div class="catatan-section">
                <span class="font-normal" id="detail-catatan"></span>
            </div>
            <div class="signature-section">
                <span class="font-normal" id="tanggal-bawah">-</span>
                <p>Team Leader K3L & Kam</p>
                <img src="https://ik.imagekit.io/pln/ttd.png?updatedAt=1752822909227" alt="Tanda Tangan">
                <p>KUKUH TRI UTOMO</p>
            </div>
        </div>
    </div>
    <br>
</div>
</div>

    <!-- Modal Edit Single -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-xl max-h-[90vh] overflow-y-auto relative">
            <button onclick="closeEditModal()" class="absolute top-2 right-2 text-xl font-bold rounded-full w-8 h-8 flex items-center justify-center">&times;</button>
            <h2 class="text-lg font-bold text-center text-primary mb-4">Edit Pemakaian</h2>
            <div id="editFormContainer" class="space-y-4 text-sm text-gray-800">
                <div class="text-center text-gray-500">Memuat...</div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Sequential -->
    <div id="editSequentialModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-primary">Edit Sequential - Pilih Bulan</h2>
                <button onclick="closeEditSequentialModal()" class="text-xl font-bold rounded-full w-8 h-8 flex items-center justify-center">&times;</button>
            </div>
            
            <div id="sequentialEditContainer">
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Pilih Bulan untuk Edit:</label>
                    <select id="monthSelector" class="w-full border border-gray-300 px-3 py-2 rounded-lg">
                        <option value="">-- Pilih Bulan --</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-2">
                    <button onclick="closeEditSequentialModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    <button onclick="startSequentialEdit()" class="bg-blue-600 text-white px-4 py-2 rounded">Mulai Edit</button>
                </div>
            </div>
            
            <div id="stepEditContainer" class="hidden">
                <!-- Step edit form akan dimuat di sini -->
            </div>
        </div>
    </div>

    <a href="{{ route('p3k.pemakaian', ['id_p3k' => $id_p3k]) }}"
        class="fixed bottom-4 right-4 bg-gray-200 hover:bg-gray-300 text-primary rounded-full p-2 shadow-lg sm:p-3">
         + Tambahkan Pemakaian
     </a>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
let currentEditData = {
    id_p3k: '',
    selectedMonth: ''
};

function showDetail(data) {
    console.log('showDetail dipanggil dengan data:', data);

    try {
        // Set info headers
        document.getElementById('detail-bulan').innerText = data.bulan || '-';
        document.getElementById('detail-lokasi').innerText = data.lokasi || '-';
        document.getElementById('detail-tanggal').innerText = data.tanggal_pemeriksaan || '-';

        function formatTanggalLengkap(data) {
  if (!data || typeof data !== "object") return "-";

  // 1) Jika ada tanggal_pemeriksaan (YYYY-MM-DD)
  if (data.tanggal_pemeriksaan) {
    const [tahun, bulan, hari] = String(data.tanggal_pemeriksaan).split("-");
    const tgl = new Date(+tahun, +bulan - 1, +hari);
    if (!isNaN(tgl)) {
      return new Intl.DateTimeFormat("id-ID", { day: "numeric", month: "long", year: "numeric" }).format(tgl);
    }
  }

  // Helpers
  const bulanToIndex = (b) => {
    if (b === null || b === undefined) return null;
    const s = String(b).trim();

    // angka "08" / "8" / 8
    if (/^\d+$/.test(s)) {
      const n = parseInt(s, 10);
      if (n >= 1 && n <= 12) return n - 1;
      return null;
    }

    // nama bulan Indonesia (case-insensitive)
    const map = {
      januari: 0, februari: 1, pebruari: 1, maret: 2, april: 3, mei: 4,
      juni: 5, juli: 6, agustus: 7, september: 8, oktober: 9,
      november: 10, nopember: 10, desember: 11
    };
    const key = s.toLowerCase();
    return key in map ? map[key] : null;
  };

  // 2) Pecahan tanggal/bulan/tahun
  const tahun = data.tahun != null ? parseInt(String(data.tahun).trim(), 10) : null;
  const bulanIdx = bulanToIndex(data.bulan);
  let hari = (data.tanggal != null && String(data.tanggal).trim() !== "")
    ? parseInt(String(data.tanggal).trim(), 10)
    : null;

  if (tahun && bulanIdx !== null) {
    // Kalau tidak ada 'tanggal', pakai hari terakhir pada bulan tsb
    if (!hari || isNaN(hari)) {
      hari = new Date(tahun, bulanIdx + 1, 0).getDate();
    }
    const tgl = new Date(tahun, bulanIdx, hari);
    if (!isNaN(tgl)) {
      return new Intl.DateTimeFormat("id-ID", { day: "numeric", month: "long", year: "numeric" }).format(tgl);
    }
  }

  return "-";
}

// Pemakaian
const tglFormatted = formatTanggalLengkap(data);
document.getElementById("tanggal-bawah").innerText = `Surabaya, ${tglFormatted}`;


        // Format tanggal helper
        function formatTanggal(tanggalString) {
            if (!tanggalString) return '-';
            const tanggal = new Date(tanggalString);
            const hari = String(tanggal.getDate()).padStart(2, '0');
            const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');
            const tahun = tanggal.getFullYear();
            return `${hari}-${bulan}-${tahun}`;
        }

        // Filter data yang memiliki nama valid (tidak null/kosong/dash), lalu urutkan berdasarkan tanggal_pemeriksaan
        const filteredAndSortedItems = data.items
            .filter(item => {
                return item.nama && 
                       item.nama.trim() !== '' && 
                       item.nama !== '-' && 
                       item.nama !== null;
            })
            .sort((a, b) => {
                const dateA = new Date(a.tanggal_pemeriksaan || '2100-01-01');
                const dateB = new Date(b.tanggal_pemeriksaan || '2100-01-01');
                return dateA - dateB;
            });

        // Generate table rows hanya untuk data yang valid
        const tableBody = document.getElementById('detail-table-body');
        let tableHTML = '';

        // Jika tidak ada data valid, tampilkan pesan
        if (filteredAndSortedItems.length === 0) {
            tableHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">
                        Tidak ada data pemakaian yang valid untuk ditampilkan
                    </td>
                </tr>
            `;
        } else {
            // Tampilkan data yang valid
            filteredAndSortedItems.forEach((item, index) => {
                tableHTML += `
                    <tr>
                        <td class="col-no">${index + 1}</td>
                        <td class="col-nama">${item.nama || '-'}</td>
                        <td class="col-item">${item.item || '-'}</td>
                        <td class="col-jumlah">${item.jumlah || '-'}</td>
                        <td class="col-keperluan">${item.keperluan || '-'}</td>
                        <td class="col-tanggal">${formatTanggal(item.tanggal_pemeriksaan)}</td>
                        <td class="hidden col-paraf"></td>
                    </tr>
                `;
            });

            // Tambahkan baris kosong sampai total 10 (hanya jika ada data valid)
            const totalRows = 10;
            const emptyRowsNeeded = Math.max(0, totalRows - filteredAndSortedItems.length);
            for (let i = 0; i < emptyRowsNeeded; i++) {
                const rowNum = filteredAndSortedItems.length + i + 1;
                tableHTML += `
                    <tr class="empty-row">
                        <td class="col-no">${rowNum}</td>
                        <td class="col-nama"></td>
                        <td class="col-item"></td>
                        <td class="col-jumlah"></td>
                        <td class="col-keperluan"></td>
                        <td class="col-tanggal"></td>
                        <td class="hidden col-paraf"></td>
                    </tr>
                `;
            }
        }

        // Masukkan HTML ke tabel
        tableBody.innerHTML = tableHTML;

        // Tampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('detailModal').classList.add('flex');

    } catch (error) {
        console.error('Error dalam showDetail:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat menampilkan detail: ' + error.message,
            timer: 3000,
            showConfirmButton: false
        });
    }
}

function closeModal() {
    document.getElementById('detailModal').classList.remove('flex');
    document.getElementById('detailModal').classList.add('hidden');
}

function downloadPDF() {
    console.log("Tombol diklik"); // Cek tombol kepencet

    const element = document.getElementById('printArea');
    if (!element) {
        console.error("Elemen printArea tidak ditemukan");
        return;
    }

    const bulan = document.getElementById('detail-bulan')?.innerText || 'Unknown';
    const nomor = document.getElementById('detail-nomor')?.innerText || '10';
    const lokasi = document.getElementById('detail-lokasi')?.innerText || 'CNC';

    console.log("Bulan:", bulan, "Nomor:", nomor, "Lokasi:", lokasi);

    const filename = `Form_Pemakaian_P3K_${lokasi}_${bulan}.pdf`;
    console.log("Nama file:", filename);

    if (typeof html2pdf === "undefined") {
        console.error("html2pdf tidak terload");
        return;
    }

    const opt = {
        margin: 0.3,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    
    html2pdf().from(element).set(opt).save();
}

// Fungsi untuk validasi form sebelum submit
function validateForm(form) {
    const requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');
    const emptyFields = [];
    
    requiredFields.forEach(field => {
        const fieldName = field.getAttribute('name') || field.id;
        const fieldLabel = field.closest('.form-group')?.querySelector('label')?.textContent || 
                          field.getAttribute('placeholder') || 
                          fieldName;
        
        if (!field.value || field.value.trim() === '') {
            emptyFields.push(fieldLabel.replace('*', '').trim());
        }
    });
    
    return emptyFields;
}

// Fungsi untuk membuka modal edit single
function openEditModal(id) {
    console.log('Opening edit modal for ID:', id);
    
    // Show loading state
    document.getElementById('editFormContainer').innerHTML = '<div class="text-center text-gray-500">Memuat...</div>';
    document.getElementById('editModal').classList.remove('hidden');
    
    // Fetch edit form via AJAX
    fetch(`/inspeksi/pemakaian-p3k/${id}/edit-form`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('editFormContainer').innerHTML = data.html;
        } else {
            throw new Error(data.message || 'Gagal memuat form edit');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('editFormContainer').innerHTML = 
            '<div class="text-center text-red-500">Gagal memuat form edit: ' + error.message + '</div>';
        
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal memuat form edit: ' + error.message,
            timer: 3000,
            showConfirmButton: false
        });
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editFormContainer').innerHTML = '<div class="text-center text-gray-500">Memuat...</div>';
}

// Fungsi untuk Sequential Edit
function openEditSequentialModal(id_p3k, defaultMonth) {
    currentEditData.id_p3k = id_p3k;
    
    // Show modal
    document.getElementById('editSequentialModal').classList.remove('hidden');
    document.getElementById('sequentialEditContainer').classList.remove('hidden');
    document.getElementById('stepEditContainer').classList.add('hidden');
    
    // Load available months
    loadAvailableMonths(id_p3k, defaultMonth);
}

function closeEditSequentialModal() {
    document.getElementById('editSequentialModal').classList.add('hidden');
    document.getElementById('sequentialEditContainer').classList.remove('hidden');
    document.getElementById('stepEditContainer').classList.add('hidden');
    currentEditData = { id_p3k: '', selectedMonth: '' };
}

function loadAvailableMonths(id_p3k, defaultMonth = '') {
    fetch(`/inspeksi/pemakaian-p3k/${id_p3k}/available-months`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const selector = document.getElementById('monthSelector');
            selector.innerHTML = '<option value="">-- Pilih Bulan --</option>';
            
            data.months.forEach(month => {
                const selected = month.bulan === defaultMonth ? 'selected' : '';
                selector.innerHTML += `<option value="${month.bulan}" ${selected}>${month.bulan_nama} (${month.total_data} data)</option>`;
            });
            
            if (defaultMonth) {
                currentEditData.selectedMonth = defaultMonth;
            }
        } else {
            throw new Error(data.message || 'Gagal memuat data bulan');
        }
    })
    .catch(error => {
        console.error('Error loading months:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal memuat data bulan: ' + error.message,
            timer: 3000,
            showConfirmButton: false
        });
    });
}

function startSequentialEdit() {
    const selectedMonth = document.getElementById('monthSelector').value;
    
    if (!selectedMonth) {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih Bulan!',
            text: 'Mohon pilih bulan yang akan diedit.',
            timer: 3000,
            showConfirmButton: false
        });
        return;
    }
    
    currentEditData.selectedMonth = selectedMonth;
    
    // Hide month selector, show step editor
    document.getElementById('sequentialEditContainer').classList.add('hidden');
    document.getElementById('stepEditContainer').classList.remove('hidden');
    
    // Load first step
    loadEditStep(1);
}

function loadEditStep(step) {
    const container = document.getElementById('stepEditContainer');
    container.innerHTML = '<div class="text-center text-gray-500">Memuat data...</div>';
    
    const params = new URLSearchParams({
        id_p3k: currentEditData.id_p3k,
        bulan: currentEditData.selectedMonth,
        step: step
    });
    
    fetch(`/inspeksi/pemakaian-p3k/edit-sequential?${params}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            container.innerHTML = data.html;
        } else {
            throw new Error(data.message || 'Gagal memuat form edit');
        }
    })
    .catch(error => {
        console.error('Error loading edit step:', error);
        container.innerHTML = '<div class="text-center text-red-500">Error: ' + error.message + '</div>';
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal memuat form edit: ' + error.message,
            timer: 3000,
            showConfirmButton: false
        });
    });
}

// Navigation functions untuk sequential edit
function navigateStep(step) {
    loadEditStep(step);
}

function jumpToStep(step) {
    if (step) {
        loadEditStep(parseInt(step));
    }
}

function saveAndNext() {
    const form = document.getElementById('stepEditForm');
    if (!form) return;
    
    // Add next_step hidden input
    const currentStep = parseInt(form.querySelector('input[name="current_step"]').value);
    const totalSteps = parseInt(form.querySelector('input[name="total_steps"]').value);
    
    if (currentStep < totalSteps) {
        const nextStepInput = document.createElement('input');
        nextStepInput.type = 'hidden';
        nextStepInput.name = 'next_step';
        nextStepInput.value = currentStep + 1;
        form.appendChild(nextStepInput);
    }
    
    // Submit form
    form.submit();
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#e3342f', 
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus', 
        cancelButtonText: 'Batal'
    }).then(r => { 
        if(r.isConfirmed) {
            document.getElementById('delete-form-'+id).submit();
        }
    });
}

// Event listener untuk form submission
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission in edit modal (single edit)
    document.addEventListener('submit', function(e) {
        if (e.target.closest('#editModal form')) {
            e.preventDefault();
            
            const form = e.target;
            
            // Validasi form sebelum submit
            const emptyFields = validateForm(form);
            if (emptyFields.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap!',
                    html: `Mohon lengkapi field berikut:<br><br><strong>${emptyFields.join('<br>')}</strong>`,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Show loading state
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': formData.get('_token')
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    closeEditModal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil diupdate',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Refresh halaman untuk melihat perubahan
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    timer: 3000,
                    showConfirmButton: false
                });
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        }
        
        // Handle sequential edit form submission
        if (e.target.closest('#stepEditForm')) {
            e.preventDefault();
            
            const form = e.target;
            
            // Validasi form sebelum submit
            const emptyFields = validateForm(form);
            if (emptyFields.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap!',
                    html: `Mohon lengkapi field berikut:<br><br><strong>${emptyFields.join('<br>')}</strong>`,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Show loading state
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': formData.get('_token')
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil diupdate',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Check if there's next step or close modal
                        const currentStep = parseInt(form.querySelector('input[name="current_step"]').value);
                        const totalSteps = parseInt(form.querySelector('input[name="total_steps"]').value);
                        
                        if (currentStep >= totalSteps) {
                            closeEditSequentialModal();
                            location.reload();
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    timer: 3000,
                    showConfirmButton: false
                });
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        }
    });
});
    </script>

    

    @if(session('success'))
        <script> 
            document.addEventListener('DOMContentLoaded', ()=> {
                Swal.fire({ 
                    icon:'success', 
                    title:'Berhasil!', 
                    text:'{{ session('success') }}', 
                    timer:2000, 
                    showConfirmButton:false 
                });
            })
        </script>
    @endif

    <script>
        function setBodyPadding() {
        const header = document.getElementById('main-header');
        const spacer = document.getElementById('spacer');
        if (header && spacer) {
            const headerHeight = header.offsetHeight;
            spacer.style.paddingTop = `${headerHeight + 3}px`; 
        }
    }

    window.addEventListener('load', setBodyPadding);
    window.addEventListener('resize', setBodyPadding);
</script>
</body>
</html>