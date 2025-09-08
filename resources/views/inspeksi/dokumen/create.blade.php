<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokumen IK UP2WVI</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    @vite('resources/css/app.css')
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="main-body" class="bg-white text-gray-800">

    <!-- HEADER -->
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
            DOKUMEN IK
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
                DOKUMEN IK
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

    <!-- TOMBOL BACK -->
    <div class="fixed max-w-6xl mx-auto px-4 mt-6">
        <a href="{{ route('inspeksi.dokumen.hasil') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
            ←
        </a>
    </div>

    <!-- FORM UPLOAD DOKUMEN -->
    <div class="px-5 sm:px-6 md:px-8 lg:px-10">
        <form id="form-dokumen" action="{{ route('inspeksi.dokumen.store') }}" method="POST" enctype="multipart/form-data"
              class="max-w-3xl mx-auto py-6 mt-8 mb-10 bg-gray-100 rounded-xl shadow-lg space-y-6 px-6 sm:px-8">
            @csrf

            <div class="bg-white p-4 rounded-lg shadow-sm">
                <label class="block font-semibold mb-1">Nama Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="nama_dokumen" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm">
                <label class="block font-semibold mb-1">Upload File Dokumen <span class="text-red-500">*</span></label>
                <input type="file" name="file_dokumen" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                <p class="text-sm text-gray-500 mt-1">Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG</p>
            </div>

            <div class="text-center">
                <button type="submit" id="submit-btn"
                        class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-lg shadow">
                    Simpan Dokumen
                </button>
            </div>
        </form>
    </div>

    <!-- JS FIX HEADER -->
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

    <!-- SweetAlert sukses -->
    <script>
        document.getElementById('form-dokumen').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
        
            // 1. Tampilkan loading
            Swal.fire({
                title: 'Menyimpan dokumen...',
                text: 'Harap tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        
            // 2. Kirim data ke server
            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Gagal menyimpan dokumen!");
                }
                return response.text(); // kalau server balas JSON bisa pakai .json()
            })
            .then(() => {
                // 3. Kalau sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Dokumen berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                });
        
                // 4. Redirect setelah delay 1.6 detik
                setTimeout(() => {
                    window.location.href = "/inspeksi/dokumen/hasil/"; // ganti sesuai tujuanmu
                }, 1600);
            })
            .catch(error => {
                // 5. Kalau gagal
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
