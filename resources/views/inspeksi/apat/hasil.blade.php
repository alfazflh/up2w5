<!-- resources/views/apat/hasil.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - APAT</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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


.option {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-right: 20px;
    margin-left: 10px;
    font-size: 12px;
    line-height: 1;
}

.checkbox {
    width: 12px;
    height: 12px;
    border: 1px solid black;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
    margin-top: 5px; 
}

.checkbox.baik::after {
    content: "✓";
    font-size: 10px;
    color: black;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.checkbox.tidak-baik::after {
    content: "X";
    font-size: 10px;
    color: black;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
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
            MONITORING ALAT PEMADAM API TRADISIONAL
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
                MONITORING ALAT PEMADAM API TRADISIONAL
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
        <a href="{{ route('apat.index', ['id_apat' => $apat->id_apat]) }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
            ←
        </a>
    </div>

    <div class="max-w-6xl mx-auto px-4 mt-6">
        @php $no = 1; @endphp
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
                    @foreach ($pemeriksaans as $pemeriksaan)
                        @if (!empty($pemeriksaan->tanggal_pemeriksaan))
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $no++ }}</td>
                                <td class="px-4 py-3">
                                    APAT {{ $pemeriksaan->id_apat }} Bulan
                                    {{ \Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->translatedFormat('F Y') }}
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    @php
                                    $data = [
                                        'id_apat' => $pemeriksaan->id_apat,
                                        'tanggal' => \Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->locale('id')->translatedFormat('d F Y'),
                                        'lokasi' => $pemeriksaan->lokasi,
                                        'kondisi_fisik' => $pemeriksaan->kondisi_fisik,
                                        'drum' => $pemeriksaan->drum,
                                        'aduk_pasir' => $pemeriksaan->aduk_pasir,
                                        'sekop' => $pemeriksaan->sekop,
                                        'fire_blanket' => $pemeriksaan->fire_blanket,
                                        'ember' => $pemeriksaan->ember,
                                        'petugas' => $pemeriksaan->petugas,
                                        'pengawas' => $pemeriksaan->pengawas,
                                        'catatan' => $pemeriksaan->catatan,
                                        'kesimpulan' => $pemeriksaan->kesimpulan,
                                    ];
                                    @endphp

                                    <div class="flex flex-wrap justify-center gap-2">
                                        <button onclick='showDetail(@json($data))'
                                                class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                                            Detail
                                        </button>

                                        @auth
                                            @if(Auth::user()->role === 'admin')
                                            <button onclick="openEditModal({{ $pemeriksaan->id }})"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">
                                                Edit
                                            </button>
                                            <button onclick="confirmDelete({{ $pemeriksaan->id }})"
                                                    class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">
                                                Hapus
                                            </button>
                                            <form id="delete-form-{{ $pemeriksaan->id }}"
                                                  action="{{ route('pemeriksaan-apat.destroy', $pemeriksaan->id) }}"
                                                  method="POST" class="hidden">
                                                @csrf @method('DELETE')
                                            </form>
                                            @endif
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            @if($pemeriksaans->whereNotNull('tanggal_pemeriksaan')->count() === 0)
                <div class="p-4 text-center text-gray-500">Tidak ada data pemeriksaan yang tersedia.</div>
            @endif
        </div>
    </div>

    <!-- Modal Detail -->
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
                                <h1>KARTU KENDALI</h1>
                                <h2>ALAT PEMADAM API TRADISIONAL (APAT)</h2>
                                <p>TAHUN <span id="detail-tahun" class="text-sm">-</span></p>
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
                <td style="border: 1px solid black; padding: 3px; width: 9%;">LOKASI</td>
                <td style="border: 1px solid black; padding: 3px; width: 41%;">: <span id="detail-lokasi">-</span></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px;">NOMOR</td>
                <td style="border: 1px solid black; padding: 3px;">: <span id="detail-nomor">-</span></td>
            </tr>
        </table>
    
        <!-- Tabel pemeriksaan -->
        <table class="inspection-table">
            <thead>
                <tr><td class="bg-[#d9d9d9]" colspan="2" style="border: 1px solid black; height: 15px;"></td></tr>
                <tr>
                    <th style="width: 40%;"">PEMERIKSAAN</th>
                    <th style="width: 70%;"">KONDISI</th>
                </tr>
            </thead>
            <tbody id="detail-pemeriksaan-table">
                <!-- akan diisi lewat JS -->
            </tbody>
        </table>

        <!-- Footer section -->
        <div class="footer-section">
            <div class="catatan-section">
                Catatan : <span class="font-normal" id="detail-catatan">-</span>
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

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-xl max-h-[90vh] overflow-y-auto relative">
            <button onclick="closeEditModal()" class="absolute top-2 right-2 text-xl">&times;</button>
            <h2 class="text-lg font-bold text-center text-primary mb-4">Edit Pemeriksaan</h2>
            <div id="editFormContainer" class="space-y-4 text-sm text-gray-800">
                <div class="text-center text-gray-500">Memuat...</div>
            </div>
        </div>
    </div>

    <!-- Floating Add Button -->
    <a href="{{ route('apat.inspeksi', ['id_apat' => $apat->id_apat]) }}"
       class="fixed bottom-4 right-4 bg-gray-200 hover:bg-gray-300 text-primary rounded-full p-2 shadow-lg sm:p-3">
        + Tambahkan Inspeksi
    </a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function formatTanggalToDDMMYYYY(tanggalStr) {
    const bulanMap = {
        'Januari': '01', 'Februari': '02', 'Maret': '03',
        'April': '04', 'Mei': '05', 'Juni': '06',
        'Juli': '07', 'Agustus': '08', 'September': '09',
        'Oktober': '10', 'November': '11', 'Desember': '12'
    };

    const parts = tanggalStr.split(' ');
    if (parts.length !== 3) return tanggalStr;

    const dd = parts[0].padStart(2, '0');
    const mm = bulanMap[parts[1]] || '00';
    const yyyy = parts[2];

    return `${dd}/${mm}/${yyyy}`;
}

function tanggalbawah(tanggalStr) {
    if (!tanggalStr) return '-';
    return tanggalStr.trim();
}

function showDetail(data) {
    console.log('showDetail dipanggil dengan data:', data); // untuk debugging
    
    try {
        document.getElementById('detail-lokasi').innerText = data.lokasi || '-';
        document.getElementById('detail-nomor').innerText = data.id_apat || '-';
        document.getElementById('detail-tanggal').innerText = data.tanggal || '-';
        document.getElementById('detail-catatan').innerText = data.catatan || '-';
        const tglFormatted = tanggalbawah(data.tanggal);
        document.getElementById('tanggal-bawah').innerText = `Surabaya, ${tglFormatted}`;

        const tanggalPemeriksaan = data.tanggal || '';
        const tahunMatch = tanggalPemeriksaan.match(/\d{4}/);
        const tahun = tahunMatch ? tahunMatch[0] : '2025';
        document.getElementById('detail-tahun').innerText = tahun;

        const tableBody = document.getElementById('detail-pemeriksaan-table');
        tableBody.innerHTML = `
        <tr>
        <td>Kondisi Fisik</td>
        <td class="checkbox-group">
        <label class="option">
            <span class="checkbox ${ (data.kondisi_fisik || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
            Baik
        </label>
        <label class="option">
            <span class="checkbox ${ (data.kondisi_fisik || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
            Tidak Baik
        </label>
        </td>
        </tr>

        <tr>
        <td>Drum</td>
        <td class="checkbox-group">
        <label class="option">
            <span class="checkbox ${ (data.drum || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
            Baik
        </label>
        <label class="option">
            <span class="checkbox ${ (data.drum || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
            Tidak Baik
        </label>
        </td>
        </tr>

        <tr>
        <td>Aduk Pasir</td>
        <td class="checkbox-group">
        <label class="option">
            <span class="checkbox ${ (data.aduk_pasir || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
            Baik
        </label>
        <label class="option">
            <span class="checkbox ${ (data.aduk_pasir || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
            Tidak Baik
        </label>
        </td>
        </tr>

        <tr>
        <td>Sekop</td>
        <td class="checkbox-group">
        <label class="option">
            <span class="checkbox ${ (data.sekop || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
            Baik
        </label>
        <label class="option">
            <span class="checkbox ${ (data.sekop || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
            Tidak Baik
        </label>
        </td>
        </tr>

        <tr>
        <td>Fire Blanket</td>
        <td class="checkbox-group">
        <label class="option">
            <span class="checkbox ${ (data.fire_blanket || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
            Baik
        </label>
        <label class="option">
            <span class="checkbox ${ (data.fire_blanket || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
            Tidak Baik
        </label>
        </td>
        </tr>

        <tr>
        <td>Ember</td>
        <td class="checkbox-group">
        <label class="option">
            <span class="checkbox ${ (data.ember || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
            Baik
        </label>
        <label class="option">
            <span class="checkbox ${ (data.ember || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
            Tidak Baik
        </label>
        </td>
        </tr>

            <tr><td class="bg-[#d9d9d9]" colspan="2" style="border: 1px solid black; height: 20px;"></td></tr>
            <tr>
                <td class="font-semibold">KESIMPULAN</td>
                <td class="checkbox-group">
                <label class="option">
                <span class="checkbox ${ (data.kesimpulan || '').toLowerCase() === 'baik' ? 'checked baik' : '' }"></span>
                Baik
                </label>
                <label class="option">
                <span class="checkbox ${ (data.kesimpulan || '').toLowerCase() === 'tidak baik' ? 'checked tidak-baik' : '' }"></span>
                Tidak Baik
                </label>
                </td>
            </tr>
            <tr class="info-row"><td>Tanggal Pemeriksaan</td><td class="bg-white text-black font-normal">${formatTanggalToDDMMYYYY(data.tanggal) || '-'}</td></tr>
            <tr class="info-row"><td>Petugas</td><td class="bg-white text-black font-normal">${data.petugas || '-'}</td></tr>
            <tr class="info-row"><td>Pengawas</td><td class="bg-white text-black font-normal">${data.pengawas || '-'}</td></tr>
        `;

        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('detailModal').classList.add('flex');
        
        console.log('Modal berhasil ditampilkan'); // untuk debugging
    } catch (error) {
        console.error('Error dalam showDetail:', error);
        alert('Terjadi kesalahan saat menampilkan detail: ' + error.message);
    }
}

    function closeModal() {
        document.getElementById('detailModal').classList.remove('flex');
        document.getElementById('detailModal').classList.add('hidden');
    }

    function downloadPDF() {
    const element = document.getElementById('printArea');
    const tanggalText = document.getElementById('detail-tanggal').innerText || 'Pemeriksaan';
    let bulanTahun = 'Pemeriksaan';

    const dateObj = new Date(tanggalText);
    if (!isNaN(dateObj)) {
    const options = { month: 'long', year: 'numeric' };
    bulanTahun = dateObj.toLocaleDateString('id-ID', options);
}
    const filename = 'Kartu Kendali APAT ' + bulanTahun.replace(/\s+/g, ' ') + '.pdf';


    const opt = {
        margin: 0.3,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().from(element).set(opt).save();
}

    function openEditModal(id){
        const modal = document.getElementById('editModal');
        const c = document.getElementById('editFormContainer');
        modal.classList.remove('hidden');
        fetch(`/inspeksi/apat/${id}/edit-form`)
            .then(res=>res.json())
            .then(d=> c.innerHTML = d.html)
            .catch(e=> c.innerHTML = `<p class="text-red-500 text-center">Error: ${e.message}</p>`);
    }
    function closeEditModal(){ document.getElementById('editModal').classList.add('hidden'); }
    function confirmDelete(id){
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#e3342f', cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus', cancelButtonText: 'Batal'
        }).then(r => { if(r.isConfirmed) document.getElementById('delete-form-'+id).submit() });
    }
</script>

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script> document.addEventListener('DOMContentLoaded', ()=> {
        Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}', timer:2000, showConfirmButton:false });
    })</script>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
