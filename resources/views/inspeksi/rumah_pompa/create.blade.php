<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - RUMAH POMPA</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    @vite('resources/css/app.css')
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .border-primary { border-color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }
    </style>
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
            MONITORING RUMAH POMPA
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
            MONITORING RUMAH POMPA
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
    <a href="{{ route('rumah_pompa.hasil', ['id_rumah' => $rumah->id_rumah]) }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
        ←
    </a>
</div>

<div class="px-5 sm:px-6 md:px-8 lg:px-10">
    <form id="form-inspeksi" action="{{ route('pemeriksaan-rumahpompa.store') }}" method="POST"
          class="max-w-3xl mx-auto py-6 mt-8 mb-10 bg-gray-100 rounded-xl shadow-lg space-y-6 px-6 sm:px-8">
        @csrf

        <input type="hidden" name="id_rumah" value="{{ $rumah->id_rumah }}">
        <input type="hidden" name="catatan" value="{{ $rumah->catatan }}">

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Petugas</label>
            <input type="text" name="petugas" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Pengawas</label>
            <input type="text" name="pengawas" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        @php
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
                    'selector' => 'Cek posisi selector pada posisi Automatic pada panel kontrol (Electric, Jockey, dan Disesel).',
                    'fungsi' => 'Cek Fungsi Pompa dengan membuka pilar (minimal 3 orang): Jocky pada tekanan 7 Bar, Electric Pump pada tekanan 6 Bar',
                    'kesimpulan' => 'KESIMPULAN',
                ]
            ];
        @endphp

        @foreach ($sections as $section => $items)
            <div class="bg-blue-100 p-4 rounded-lg border-l-4 border-primary">
                <h2 class="text-lg font-bold text-primary mb-1">{{ $section }}</h2>
            </div>

            @foreach ($items as $key => $label)
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <label class="block font-semibold mb-2">{{ $label }} <span class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-4">
                        @foreach (['✓ Baik', 'X Tidak Baik'] as $val)
                        <label class="inline-flex items-center space-x-1 mr-3">
                            <input type="radio" name="{{ $key }}" value="{{ $val }}" required>
                            <span>{{ $val }}</span>
                        </label>
                    @endforeach
                    
                    </div>
                </div>
            @endforeach
        @endforeach

        <div class="text-center">
            <button type="submit" id="submit-btn"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-lg shadow">
                Simpan Inspeksi
            </button>
        </div>
    </form>
</div>

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

    document.getElementById('submit-btn').addEventListener('click', function (e) {
    e.preventDefault();
    const form = document.getElementById('form-inspeksi');
    const idRumah = document.querySelector('input[name="id_rumah"]').value;
    const formData = new FormData(form);

    // 1. Tampilkan loading
    Swal.fire({
        title: 'Mengirim pemeriksaan...',
        text: 'Harap tunggu sebentar',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // 2. Kirim form ke server
    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error("Gagal mengirim data!");
        return response.text();
    })
    .then(() => {
        // 3. Jika berhasil
        Swal.fire({
            icon: 'success',
            title: 'Pemeriksaan berhasil dikirim!',
            showConfirmButton: false,
            timer: 1500
        });

        // 4. Redirect setelah notifikasi
        setTimeout(() => {
            window.location.href = `/inspeksi/rumah-pompa/${idRumah}/hasil`;
        }, 1600);
    })
    .catch(error => {
        // 5. Jika gagal
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.message,
            confirmButtonColor: '#d33'
        });
    });
});
</script>

</body>
</html>
