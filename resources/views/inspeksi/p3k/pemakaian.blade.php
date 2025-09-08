<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - P3K</title>
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
    <a href="{{ route('p3k.hasilpemakaian', ['id_p3k' => $id_p3k]) }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
        ←
    </a>
</div>

<div class="px-5 sm:px-6 md:px-8 lg:px-10">
    <form id="form-inspeksi" action="{{ route('pemakaian-p3k.store') }}" method="POST"
          class="max-w-3xl mx-auto py-6 mt-8 mb-10 bg-gray-100 rounded-xl shadow-lg space-y-6 px-6 sm:px-8">
        @csrf

        <input type="hidden" name="id_p3k" value="{{ $id_p3k }}">

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Tanggal Pemakaian</label>
            <input type="date" name="tanggal_pemeriksaan" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm relative w-200">
            <label class="block font-semibold mb-1">Item</label>
            <input type="text" id="itemInput" name="item" class="w-full border border-gray-300 rounded-lg px-4 py-2" autocomplete="off">
            <div id="suggestions" class="border border-gray-300 rounded-lg mt-1 max-h-40 overflow-auto hidden bg-white absolute z-10 w-full"></div>
        </div>
        
        <script>
        const items = [
            "Kasa Steril Terbungkus",
            "Perban (lebar 5 cm)",
            "Perban (lebar 10 cm)",
            "Plester (lebar 1,25 cm)",
            "Plester Cepat",
            "Kapas (25 gram)",
            "Kain segitiga/mittela",
            "Gunting",
            "Peniti",
            "Sarung tangan sekali pakai (pasangan)",
            "Masker",
            "Pinset",
            "Lampu Senter",
            "Gelas untuk cuci mata",
            "Kantong plastik bersih",
            "Aquades (100 ml lar. Saline)",
            "Povidon Iodin (60 ml)",
            "Alkohol 70%",
            "Buku Panduan P3K di tempat kerja",
            "Buku Catatan Daftar isi kotak P3K"
        ];
        
        const input = document.getElementById('itemInput');
        const suggestions = document.getElementById('suggestions');
        
        input.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            suggestions.innerHTML = '';
            if (!value) {
                suggestions.classList.add('hidden');
                return;
            }
        
            const filtered = items.filter(item => item.toLowerCase().includes(value));
            if (filtered.length === 0) {
                suggestions.classList.add('hidden');
                return;
            }
        
            filtered.forEach(item => {
                const div = document.createElement('div');
                div.textContent = item;
                div.classList.add('px-4', 'py-2', 'hover:bg-gray-100', 'cursor-pointer');
                div.addEventListener('click', () => {
                    input.value = item;
                    suggestions.classList.add('hidden');
                });
                suggestions.appendChild(div);
            });
        
            suggestions.classList.remove('hidden');
        });
        
        // sembunyikan saran saat klik di luar
        document.addEventListener('click', e => {
            if (!input.contains(e.target) && !suggestions.contains(e.target)) {
                suggestions.classList.add('hidden');
            }
        });
        </script>
        

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Jumlah</label>
            <input type="text" name="jumlah" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm">
            <label class="block font-semibold mb-1">Keperluan Pemakaian</label>
            <input type="text" name="keperluan" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>



        <div class="text-center">
            <button type="submit" id="submit-btn"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-lg shadow">
                Simpan Pemakaian
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
    const idp3k = document.querySelector('input[name="id_p3k"]').value;
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
            window.location.href = `/inspeksi/kotak-p3k/${idp3k}/hasilpemakaian`;
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
