<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - APAT</title>
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
<body class="bg-white text-gray-800">

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
    <a href="{{ route('apat.hasil', ['id_apat' => $apat->id_apat]) }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
        ←
    </a>
</div>

<div class="px-5 sm:px-6 md:px-8 lg:px-10">
    <form id="form-inspeksi" action="{{ route('pemeriksaan-apat.store') }}" method="POST" 
          class="max-w-3xl mx-auto py-6 mt-8 mb-10 bg-gray-100 rounded-xl shadow-lg space-y-6 px-6 sm:px-8">
        @csrf

        <input type="hidden" name="id_apat" value="{{ $apat->id_apat }}">
        <input type="hidden" name="lokasi" value="{{ $apat->lokasi }}">
        <input type="hidden" name="catatan" value="{{ $apat->catatan }}">

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

        <div class="bg-blue-100 p-4 rounded-lg border-l-4 border-primary">
            <h2 class="text-lg font-bold text-primary mb-1">Kondisi APAT</h2>
            <p class="text-sm text-gray-700">Isi sesuai dengan kondisi alat di lapangan</p>
        </div>

        <div class="space-y-4">
            @php
                $items = [
                    'kondisi_fisik' => 'Kondisi Fisik',
                    'drum' => 'Drum',
                    'aduk_pasir' => 'Aduk Pasir',
                    'sekop' => 'Sekop',
                    'fire_blanket' => 'Fire Blanket',
                    'ember' => 'Ember',
                    'kesimpulan' => 'Kesimpulan',
                ];
            @endphp

            @foreach ($items as $key => $label)
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <label class="block font-semibold mb-2">{{ $label }} <span class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-4">
                        @foreach (['baik', 'tidak_baik'] as $val)
                            <label class="inline-flex items-center space-x-1">
                                <input type="radio" name="{{ $key }}" value="{{ $val }}" required>
                                <span>{{ ucfirst(str_replace('_', ' ', $val)) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

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
</script>

<script>
    document.getElementById('submit-btn').addEventListener('click', function (e) {
        e.preventDefault(); // cegah submit default biar bisa kasih loading dulu
    
        const form = document.getElementById('form-inspeksi');
        const idApat = document.querySelector('input[name="id_apat"]').value;
    
        // 1. Tampilkan loading
        Swal.fire({
            title: 'Mengirim data...',
            text: 'Harap tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    
        // 2. Submit form setelah delay singkat
        setTimeout(() => {
            form.submit();
    
            // 3. Setelah submit, ganti alert jadi sukses
            Swal.fire({
                icon: 'success',
                title: 'Pemeriksaan berhasil dikirim!',
                showConfirmButton: false,
                timer: 1500
            });
    
            // 4. Redirect manual
            setTimeout(() => {
                window.location.href = `/inspeksi/apat/${idApat}/hasil`;
            }, 1600);
        }, 800); // kasih jeda biar loading keliatan
    });
    </script>
    

</body>
</html>
