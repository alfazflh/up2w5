<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Peralatan Tanggap Darurat UP2WV - APAR</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }
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
            MONITORING ALAT PEMADAM API RINGAN
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W V
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
                MONITORING ALAT PEMADAM API RINGAN
            </h1>
            <h2 class="text-sm sm:text-base md:text-xl text-white font-semibold mt-1">
            PLN PUSHARLIS UP2W V
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
        <a href="{{ route('welcome') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
            ←
        </a>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($apars->unique('id_apar') as $apar)
                <a href="{{ route('apar.hasil', $apar->id_apar) }}"
                   class="block bg-primary hover:bg-primary-dark text-white text-center font-semibold py-6 rounded-xl shadow transition duration-300">
                    APAR {{ $apar->id_apar }}
                </a>
            @endforeach
        </div>
    </div>

    <button onclick="openModal()" 
    class="fixed bottom-4 right-4 bg-gray-200 hover:bg-gray-300 text-primary rounded-full 
           p-2 text-sm shadow-lg z-50 
           sm:p-3 sm:text-lg">
    + APAR Baru
</button>


<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <h2 class="text-xl font-bold mb-4">Tambah APAR Baru</h2>
        <form action="{{ route('apar.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">ID APAR</label>
                <input type="text" name="id_apar" required class="w-full px-3 py-2 border rounded" placeholder="cth: A1.01">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Isi Apar</label>
                <input type="text" name="isi_apar" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Kapasitas (Kg)</label>
                <input 
                    type="text" 
                    name="kapasitas" 
                    required 
                    class="w-full px-3 py-2 border rounded"
                    placeholder="cth: 2,5"
                    oninput="this.value = this.value.replace(/[^0-9.,]/g, '')"
                    >
                </div>                                      
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Masa Berlaku</label>
                <input type="date" name="masa_berlaku" required class="w-full px-3 py-2 border rounded">
            </div>
            <input type="hidden" name="catatan" value="{{ $apar->catatan }}">
            
            
            
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark">
                    Simpan
                </button>
            </div>
        </form>
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">
            &times;
        </button>
    </div>
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


        function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
    </script>

</body>
</html>
