<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - P3K</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
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

.info-table tr:first-child td,
.info-table tr:first-child th {
  border-top: none !important;
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
    margin-top: 10px;
}

.catatan-section {
flex: 1;
padding-right: 20px;
font-size: 11px;
line-height: 1.5;
margin-top: 0;
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
    margin-bottom: -20px; 
    z-index: 1;
    position: relative;
}

.signature-section p,
.signature-section span {
    margin: 0 0 3px 0;    /* Atas-Kanan-Bawah-Kiri */
    font-size: 11px;
    font-weight: 600;     /* Bold */
    line-height: 1.3;     /* Biar rapat */
    position: relative;
    z-index: 0;
}

        /* Edit Modal Styles */
        #editModal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        #editModal .modal-content {
            background: white;
            border-radius: 8px;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            max-height: 90vh;
            overflow-y: auto;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #374151;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            font-size: 12px;
            padding: 8px 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #196275;
            box-shadow: 0 0 0 2px rgba(25, 98, 117, 0.1);
        }

        .items-section {
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
            margin-top: 20px;
        }

        .item-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            gap: 15px;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-bottom: 15px;
            background: #f9fafb;
        }

        .item-header {
            font-weight: 600;
            color: #196275;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #196275;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #196275;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #134e5a;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
            ←
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 mt-6">
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Data Pemeriksaan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php 
                        $no = 1; 
                        $filteredPemeriksaan = $pemeriksaans->filter(function($item) {
                            return !empty($item->petugas) && $item->petugas !== null;
                        });
                        
                        $groupedPemeriksaan = $filteredPemeriksaan->groupBy(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('Y-m-d');
                        })->sortKeysDesc();
                    @endphp

                    @forelse ($groupedPemeriksaan as $date => $dateData)
                        @php
                            $firstItem = $dateData->first();
                            $dateFormatted = \Carbon\Carbon::parse($firstItem->tanggal_pemeriksaan)->translatedFormat('d F Y');

                            $modalData = [
                                'id' => $firstItem->id,
                                'id_p3k' => $firstItem->id_p3k,
                                'tanggal_pemeriksaan' => $firstItem->tanggal_pemeriksaan,
                                'petugas' => $firstItem->petugas,
                                'tanggal_formatted' => $dateFormatted,
                                'items' => [
                                    ['no' => 1, 'nama' => 'Kasa Steril Terbungkus', 'satuan' => 'Bh', 'standar' => '20', 'kondisi' => $firstItem->kasa, 'kadaluarsa' => $firstItem->kadaluarsa_kasa, 'catatan' => $firstItem->catatan_kasa],
                                    ['no' => 2, 'nama' => 'Perban (lebar 5 cm)', 'satuan' => 'Bh', 'standar' => '2', 'kondisi' => $firstItem->perban5cm, 'kadaluarsa' => $firstItem->kadaluarsa_perban5cm, 'catatan' => $firstItem->catatan_perban5cm],
                                    ['no' => 3, 'nama' => 'Perban (lebar 10 cm)', 'satuan' => 'Bh', 'standar' => '2', 'kondisi' => $firstItem->perban10cm, 'kadaluarsa' => $firstItem->kadaluarsa_perban10cm, 'catatan' => $firstItem->catatan_perban10cm],
                                    ['no' => 4, 'nama' => 'Plester (lebar 1,25 cm)', 'satuan' => 'Bh', 'standar' => '2', 'kondisi' => $firstItem->plester125cm, 'kadaluarsa' => $firstItem->kadaluarsa_plester125cm, 'catatan' => $firstItem->catatan_plester125cm],
                                    ['no' => 5, 'nama' => 'Plester Cepat', 'satuan' => 'Bh', 'standar' => '10', 'kondisi' => $firstItem->plester, 'kadaluarsa' => $firstItem->kadaluarsa_plester, 'catatan' => $firstItem->catatan_plester],
                                    ['no' => 6, 'nama' => 'Kapas (25 gram)', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->kapas, 'kadaluarsa' => $firstItem->kadaluarsa_kapas, 'catatan' => $firstItem->catatan_kapas],
                                    ['no' => 7, 'nama' => 'Kain segitiga/mittela', 'satuan' => 'Bh', 'standar' => '2', 'kondisi' => $firstItem->mittela, 'kadaluarsa' => $firstItem->kadaluarsa_mittela, 'catatan' => $firstItem->catatan_mittela],
                                    ['no' => 8, 'nama' => 'Gunting', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->gunting, 'kadaluarsa' => $firstItem->kadaluarsa_gunting, 'catatan' => $firstItem->catatan_gunting],
                                    ['no' => 9, 'nama' => 'Peniti', 'satuan' => 'Bh', 'standar' => '12', 'kondisi' => $firstItem->peniti, 'kadaluarsa' => $firstItem->kadaluarsa_peniti, 'catatan' => $firstItem->catatan_peniti],
                                    ['no' => 10, 'nama' => 'Sarung tangan sekali pakai', 'satuan' => 'Bh', 'standar' => '2', 'kondisi' => $firstItem->sarung_tangan, 'kadaluarsa' => $firstItem->kadaluarsa_sarung_tangan, 'catatan' => $firstItem->catatan_sarung_tangan],
                                    ['no' => 11, 'nama' => '(pasangan)', 'satuan' => 'Bh', 'standar' => '2', 'kondisi' => $firstItem->pasangan, 'kadaluarsa' => $firstItem->kadaluarsa_pasangan, 'catatan' => $firstItem->catatan_pasangan],
                                    ['no' => 12, 'nama' => 'Masker', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->masker, 'kadaluarsa' => $firstItem->kadaluarsa_masker, 'catatan' => $firstItem->catatan_masker],
                                    ['no' => 13, 'nama' => 'Pinset', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->pinset, 'kadaluarsa' => $firstItem->kadaluarsa_pinset, 'catatan' => $firstItem->catatan_pinset],
                                    ['no' => 14, 'nama' => 'Lampu senter', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->senter, 'kadaluarsa' => $firstItem->kadaluarsa_senter, 'catatan' => $firstItem->catatan_senter],
                                    ['no' => 15, 'nama' => 'Gelas untuk cuci mata', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->gelas, 'kadaluarsa' => $firstItem->kadaluarsa_gelas, 'catatan' => $firstItem->catatan_gelas],
                                    ['no' => 16, 'nama' => 'Kantong plastik bersih', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->plastik, 'kadaluarsa' => $firstItem->kadaluarsa_plastik, 'catatan' => $firstItem->catatan_plastik],
                                    ['no' => 17, 'nama' => 'Aquades (100 ml lar. Saline)', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->aquades, 'kadaluarsa' => $firstItem->kadaluarsa_aquades, 'catatan' => $firstItem->catatan_aquades],
                                    ['no' => 18, 'nama' => 'Povidon Iodin (60 ml)', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->povidon, 'kadaluarsa' => $firstItem->kadaluarsa_povidon, 'catatan' => $firstItem->catatan_povidon],
                                    ['no' => 19, 'nama' => 'Alkohol 70%', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->alkohol, 'kadaluarsa' => $firstItem->kadaluarsa_alkohol, 'catatan' => $firstItem->catatan_alkohol],
                                    ['no' => 20, 'nama' => 'Buku panduan P3K di tempat kerja', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->panduanp3k, 'kadaluarsa' => $firstItem->kadaluarsa_panduanp3k, 'catatan' => $firstItem->catatan_panduanp3k],
                                    ['no' => 21, 'nama' => 'Buku catatan Daftar isi kotak P3K', 'satuan' => 'Bh', 'standar' => '1', 'kondisi' => $firstItem->daftarisi, 'kadaluarsa' => $firstItem->kadaluarsa_daftarisi, 'catatan' => $firstItem->catatan_daftarisi]
                                ]
                            ];
                        @endphp
                        
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $no++ }}</td>
                            <td class="px-4 py-3">
                                Pemeriksaan P3K {{ $firstItem->id_p3k }} Bulan
                                {{ \Carbon\Carbon::parse($firstItem->tanggal_pemeriksaan)->translatedFormat('F Y') }}
                            </td>
                            
                            <td class="px-4 py-3 text-center space-x-2">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <button onclick="showDetail({{ $firstItem->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded transition"
                                        title="ID: {{ $firstItem->id }}">
                                    Detail
                                </button>

                                    @auth
                                    @if(Auth::user()->role === 'admin')
                                        <button onclick="openEditModal({{ $firstItem->id }})"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded transition">
                                            Edit
                                        </button>
                                        <button onclick="confirmDelete({{ $firstItem->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded transition">
                                            Hapus
                                        </button>
                                        <form id="delete-form-{{ $firstItem->id }}"
                                            action="{{ route('pemeriksaan-p3k.destroy', $firstItem->id) }}"
                                              method="POST" class="hidden">
                                            @csrf @method('DELETE')
                                        </form>
                                    @endif
                                    @endauth
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-medium">Tidak ada data pemeriksaan yang tersedia</p>
                                    <p class="text-sm mt-1">Belum ada pemeriksaan P3K yang tercatat dengan petugas</p>
                                </div>
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
                            <h1>FORM PEMERIKSAAN ALAT P3K</h1>
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
                margin-top: 0px;
                table-layout: fixed;
                border-top: none;">      
        <tr>
            <td style="border: 1px solid black; padding: 3px; width: 9.8px;">Unit Kerja / Lokasi</td>
            <td style="border: 1px solid black; padding: 3px; width: 41px;">: <span>{{ $id_p3k }}</span></td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 3px;">Tanggal Pemeriksaan</td>
            <td style="border: 1px solid black; padding: 3px;">: <span id="detailtanggal">-</span></td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 3px;">Petugas Pemeriksaan</td>
            <td style="border: 1px solid black; padding: 3px;">: <span id="detail-petugas">-</span></td>
        </tr>
    </table>
    
        <!-- Tabel pemeriksaan -->
        <table class="inspection-table">
            <thead>
                <tr>
                    <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 40px;">NO</th>
                    <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 280px;">NAMA BARANG*)</th>
                    <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 50px;">SATUAN</th>
                    <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 50px;">JUMLAH</th>
                    <th colspan="3" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold;">JENIS PEMERIKSAAN</th>
                    <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 100px;">NAMA PETUGAS</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 90px;">FISIK / VISUAL**)</th>
                    <th style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 110px;">TANGGAL KADALUARSA</th>
                    <th style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 4px; font-weight: bold; width: 150px;">CATATAN</th>
                </tr>
            </thead>
            <tbody id="detail-pemeriksaan-table">
                <!-- akan diisi lewat JS -->
            </tbody>
        </table>

        <!-- Footer section -->
        <div class="footer-section">
            <div class="catatan-section">
                <span>*) : Sesuai Standar Permenakertrans No.PER.15/MEN/VIII/2008</span><br>
                <span>**) : - "Baik" jika sesuai standar.</span><br>
                <span>      -"Angka" jika jumlah kurang dari standar.</span><br>
                <span>      - Saat pemeriksaan bulanan diisi sesuai dengan standar.</span>
            </div>
            <div class="signature-section">
                <span class="!font-normal" id="tanggal-bawah">-</span>
                <p>Team Leader K3L & Kam</p>
                <img src="https://ik.imagekit.io/pln/ttd.png?updatedAt=1752822909227" alt="Tanda Tangan">
                <p>KUKUH TRI UTOMO</p>
            </div>
        </div>
    </div>
    <br>
</div>
</div>



    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-primary">Edit Pemeriksaan P3K</h2>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold rounded-full w-8 h-8 flex items-center justify-center transition">&times;</button>
            </div>
            <div id="editFormContainer" class="space-y-4 text-sm text-gray-800">
                <div class="text-center text-gray-500 py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-4"></div>
                    <p>Memuat data...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Button -->
    <a href="{{ route('p3k.inspeksi', ['id_p3k' => $id_p3k]) }}"
        class="fixed bottom-4 right-4 bg-gray-200 hover:bg-gray-300 text-primary rounded-full p-2 shadow-lg sm:p-3">
          + Tambah Pemeriksaan
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
function tanggalbawah(tanggalStr) {
    if (!tanggalStr) return '-';
    return tanggalStr.trim();
}

function showDetail(id) {
    console.log('showDetail dipanggil dengan ID:', id);
    
    // Show loading state di modal
    document.getElementById('detail-pemeriksaan-table').innerHTML = `
        <tr>
            <td colspan="8" class="text-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-4"></div>
                <p class="text-gray-500">Memuat data pemeriksaan...</p>
            </td>
        </tr>
    `;
    
    // Show modal immediately
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailModal').classList.add('flex');
    
    try {
        // Check CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            throw new Error('CSRF token tidak ditemukan');
        }
        
        // FIXED: Corrected URL to match your route definition
        const url = `/inspeksi/pemeriksaan-p3k/${id}/detail`;
        
        console.log('Fetching detail from URL:', url);
        
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response URL:', response.url);
            
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Response error:', text);
                    throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
                });
            }
            return response.json();
        })
        .then(result => {
            console.log('Received detail data:', result);
            
            if (result.success) {
                const data = result.data;
                
                // Set tahun dari tanggal pemeriksaan
                const tanggal = data.tanggal_pemeriksaan 
    ? new Date(data.tanggal_pemeriksaan).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) 
    : '-';

document.getElementById('detail-petugas').innerText = data.petugas || '-';
console.log("Raw tanggal dari server:", data.tanggal_pemeriksaan);
document.getElementById('detailtanggal').innerText = formatTanggalLengkap(data);

function formatTanggalLengkap(data) {
    if (data.tanggal_pemeriksaan) {
        const [tahun, bulan, hari] = data.tanggal_pemeriksaan.split("-");
        const tgl = new Date(tahun, bulan - 1, hari);

        return new Intl.DateTimeFormat("id-ID", {
            day: "numeric",
            month: "long",
            year: "numeric"
        }).format(tgl); 
    }

    if (data.bulan && data.tahun) {
        const dateString = `1 ${data.bulan} ${data.tahun}`;
        const tgl = new Date(dateString);
        return new Intl.DateTimeFormat("id-ID", {
            day: "numeric",
            month: "long",
            year: "numeric"
        }).format(tgl); 
    }

    return '-';
}

// pemakaian
const tglFormatted = formatTanggalLengkap(data);
document.getElementById('tanggal-bawah').innerText = `Surabaya, ${tglFormatted}`;


                document.getElementById('detail-tanggal').dataset.tanggal = data.tanggal_pemeriksaan || '';
                const tahunMatch = data.tanggal_pemeriksaan?.match(/\d{4}/);
                const tahun = tahunMatch ? tahunMatch[0] : '2025';

                // Format tanggal untuk kadaluarsa
                function formatTanggal(tanggalString) {
                    if (!tanggalString || tanggalString === '' || tanggalString === null) return '-';
                    try {
                        const tanggal = new Date(tanggalString);
                        if (isNaN(tanggal.getTime())) return '-';
                        const hari = String(tanggal.getDate()).padStart(2, '0');
                        const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');
                        const tahun = tanggal.getFullYear();
                        return `${hari}/${bulan}/${tahun}`;
                    } catch (e) {
                        return '-';
                    }
                }

                // Format kondisi 
                function formatKondisi(kondisi) {
                    if (!kondisi) return '-';
                    if (kondisi === 'Baik' || kondisi === 'baik') {
                        return 'Baik';
                    }
                    return kondisi;
                }

                // Populate table dengan data dari database
                const tableBody = document.getElementById('detail-pemeriksaan-table');
                tableBody.innerHTML = `
                    <tr>
                        <td>1</td>
                        <td class="nama-col !text-left">Kasa Steril Terbungkus</td>
                        <td>Bh</td>
                        <td>20</td>
                        <td>${formatKondisi(data.kasa)}</td>
                        <td>${formatTanggal(data.kadaluarsa_kasa)}</td>
                        <td class="catatan-col">${data.catatan_kasa || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="nama-col !text-left">Perban (lebar 5 cm)</td>
                        <td>Bh</td>
                        <td>2</td>
                        <td>${formatKondisi(data.perban_5)}</td>
                        <td>${formatTanggal(data.kadaluarsa_perban_5)}</td>
                        <td class="catatan-col">${data.catatan_perban_5 || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="nama-col !text-left">Perban (lebar 10 cm)</td>
                        <td>Bh</td>
                        <td>2</td>
                        <td>${formatKondisi(data.perban_10)}</td>
                        <td>${formatTanggal(data.kadaluarsa_perban_10)}</td>
                        <td class="catatan-col">${data.catatan_perban_10 || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="nama-col !text-left">Plester (lebar 1,25 cm)</td>
                        <td>Bh</td>
                        <td>2</td>
                        <td>${formatKondisi(data.plester_125)}</td>
                        <td>${formatTanggal(data.kadaluarsa_plester_125)}</td>
                        <td class="catatan-col">${data.catatan_plester_125 || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="nama-col !text-left">Plester Cepat</td>
                        <td>Bh</td>
                        <td>10</td>
                        <td>${formatKondisi(data.plester_cepat)}</td>
                        <td>${formatTanggal(data.kadaluarsa_plester_cepat)}</td>
                        <td class="catatan-col">${data.catatan_plester_cepat || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="nama-col !text-left">Kapas (25 gram)</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.kapas)}</td>
                        <td>${formatTanggal(data.kadaluarsa_kapas)}</td>
                        <td class="catatan-col">${data.catatan_kapas || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="nama-col !text-left">Kain segitiga/mittela</td>
                        <td>Bh</td>
                        <td>2</td>
                        <td>${formatKondisi(data.mittela)}</td>
                        <td>${formatTanggal(data.kadaluarsa_mittela)}</td>
                        <td class="catatan-col">${data.catatan_mittela || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="nama-col !text-left">Gunting</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.gunting)}</td>
                        <td>${formatTanggal(data.kadaluarsa_gunting)}</td>
                        <td class="catatan-col">${data.catatan_gunting || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td class="nama-col !text-left">Peniti</td>
                        <td>Bh</td>
                        <td>12</td>
                        <td>${formatKondisi(data.peniti)}</td>
                        <td>${formatTanggal(data.kadaluarsa_peniti)}</td>
                        <td class="catatan-col">${data.catatan_peniti || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td class="nama-col !text-left">Sarung tangan sekali pakai</td>
                        <td>Bh</td>
                        <td>2</td>
                        <td>${formatKondisi(data.sarung_tangan)}</td>
                        <td>${formatTanggal(data.kadaluarsa_sarung_tangan)}</td>
                        <td class="catatan-col">${data.catatan_sarung_tangan || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td class="nama-col !text-left">(pasangan)</td>
                        <td>Bh</td>
                        <td>2</td>
                        <td>${formatKondisi(data.sarung_tangan)}</td>
                        <td>${formatTanggal(data.kadaluarsa_sarung_tangan)}</td>
                        <td class="catatan-col">${data.catatan_sarung_tangan || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td class="nama-col !text-left">Masker</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.masker)}</td>
                        <td>${formatTanggal(data.kadaluarsa_masker)}</td>
                        <td class="catatan-col">${data.catatan_masker || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td class="nama-col !text-left">Pinset</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.pinset)}</td>
                        <td>${formatTanggal(data.kadaluarsa_pinset)}</td>
                        <td class="catatan-col">${data.catatan_pinset || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td class="nama-col !text-left">Lampu senter</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.senter)}</td>
                        <td>${formatTanggal(data.kadaluarsa_senter)}</td>
                        <td class="catatan-col">${data.catatan_senter || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td class="nama-col !text-left">Gelas untuk cuci mata</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.gelas)}</td>
                        <td>${formatTanggal(data.kadaluarsa_gelas)}</td>
                        <td class="catatan-col">${data.catatan_gelas || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td class="nama-col !text-left">Kantong plastik bersih</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.plastik)}</td>
                        <td>${formatTanggal(data.kadaluarsa_plastik)}</td>
                        <td class="catatan-col">${data.catatan_plastik || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td class="nama-col !text-left">Aquades (100 ml lar. Saline)</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.aquades)}</td>
                        <td>${formatTanggal(data.kadaluarsa_aquades)}</td>
                        <td class="catatan-col">${data.catatan_aquades || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td class="nama-col !text-left">Povidon Iodin (60 ml)</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.povidon)}</td>
                        <td>${formatTanggal(data.kadaluarsa_povidon)}</td>
                        <td class="catatan-col">${data.catatan_povidon || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td class="nama-col !text-left">Alkohol 70 %</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.alkohol)}</td>
                        <td>${formatTanggal(data.kadaluarsa_alkohol)}</td>
                        <td class="catatan-col">${data.catatan_alkohol || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td class="nama-col !text-left">Buku panduan P3K di tempat kerja</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.panduan)}</td>
                        <td>${formatTanggal(data.kadaluarsa_panduan)}</td>
                        <td class="catatan-col">${data.catatan_panduan || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td class="nama-col !text-left">Buku catatan Daftar isi kotak P3K</td>
                        <td>Bh</td>
                        <td>1</td>
                        <td>${formatKondisi(data.daftar_isi)}</td>
                        <td>${formatTanggal(data.kadaluarsa_daftar_isi)}</td>
                        <td class="catatan-col">${data.catatan_daftar_isi || '-'}</td>
                        <td>${data.petugas || ''}</td>
                    </tr>
                `;
                
            } else {
                throw new Error(result.message || 'Gagal memuat detail pemeriksaan');
            }
        })
        .catch(error => {
            console.error('Error dalam showDetail:', error);
            
            document.getElementById('detail-pemeriksaan-table').innerHTML = `
                <tr>
                    <td colspan="8" class="text-center py-8 text-red-500">
                        <div class="text-4xl mb-4">⚠️</div>
                        <p class="font-medium">Gagal memuat data pemeriksaan</p>
                        <p class="text-sm mt-2">${error.message}</p>
                        <button onclick="showDetail(${id})" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Coba Lagi
                        </button>
                    </td>
                </tr>
            `;
            
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Gagal memuat detail pemeriksaan: ' + error.message,
                timer: 3000,
                showConfirmButton: false
            });
        });
        
    } catch (error) {
        console.error('Error dalam showDetail:', error);
        
        document.getElementById('detail-pemeriksaan-table').innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-8 text-red-500">
                    <p>Terjadi kesalahan: ${error.message}</p>
                </td>
            </tr>
        `;
        
        alert('Terjadi kesalahan saat menampilkan detail: ' + error.message);
    }
}

        function closeModal() {
            document.getElementById('detailModal').classList.remove('flex');
            document.getElementById('detailModal').classList.add('hidden');
        }

        function downloadPDF() {
    const element = document.getElementById('printArea');
    const tanggalRaw = document.getElementById('detail-tanggal').dataset.tanggal;

    const date = tanggalRaw ? new Date(tanggalRaw) : new Date();
    const tahun = date.getFullYear();
    const bulan = date.toLocaleDateString('id-ID', { month: 'long' });

    let filename = `Kartu_Kendali_Kotak_P3K_${tahun}_${bulan}.pdf`;

    const opt = {
        margin: 0.3,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().from(element).set(opt).save();
}


        function openEditModal(id) {
            console.log('Opening edit modal for ID:', id);
            
            // Show loading state
            document.getElementById('editFormContainer').innerHTML = `
                <div class="text-center text-gray-500 py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-4"></div>
                    <p>Memuat data...</p>
                </div>
            `;
            document.getElementById('editModal').classList.remove('hidden');
            
            // Fetch edit form via AJAX
            fetch(`/inspeksi/pemeriksaan-p3k/${id}/edit-form`, {
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
                document.getElementById('editFormContainer').innerHTML = `
                    <div class="text-center text-red-500 py-8">
                        <div class="text-4xl mb-4">⚠️</div>
                        <p class="font-medium">Gagal memuat form edit</p>
                        <p class="text-sm mt-2">${error.message}</p>
                    </div>
                `;
                
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
            document.getElementById('editFormContainer').innerHTML = `
                <div class="text-center text-gray-500 py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-4"></div>
                    <p>Memuat data...</p>
                </div>
            `;
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data pemeriksaan yang dihapus tidak bisa dikembalikan!',
                icon: 'warning', 
                showCancelButton: true,
                confirmButtonColor: '#e3342f', 
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!', 
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(r => { 
                if(r.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang menghapus data pemeriksaan',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    document.getElementById('delete-form-'+id).submit();
                }
            });
        }

        // Validation function
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

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission in edit modal
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
                            confirmButtonColor: '#196275'
                        });
                        return;
                    }
                    
                    const formData = new FormData(form);
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    
                    // Show loading state
                    submitBtn.innerHTML = `
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2 inline-block"></div>
                        Menyimpan...
                    `;
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
                                text: 'Data pemeriksaan berhasil diupdate',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
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

            // Close modal when clicking outside
            document.getElementById('detailModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            document.getElementById('editModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeEditModal();
                }
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (!document.getElementById('detailModal').classList.contains('hidden')) {
                        closeModal();
                    }
                    if (!document.getElementById('editModal').classList.contains('hidden')) {
                        closeEditModal();
                    }
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
                    timer:2500, 
                    showConfirmButton:false 
                });
            })
        </script>
    @endif

    @if(session('error'))
        <script> 
            document.addEventListener('DOMContentLoaded', ()=> {
                Swal.fire({ 
                    icon:'error', 
                    title:'Error!', 
                    text:'{{ session('error') }}', 
                    timer:3000, 
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