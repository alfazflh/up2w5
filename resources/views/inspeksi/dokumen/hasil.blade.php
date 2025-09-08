<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Dokumen IKA UP2WVI</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }
        #spacer { padding-top: 100px; }
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

    <div id="spacer"></div>

    <!-- Tombol Back -->
    <div class="fixed max-w-6xl mx-auto px-4 mt-6">
        <a href="{{ route('welcome') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
            ←
        </a>
    </div>

    <!-- Tabel Dokumen -->
    <div class="max-w-6xl mx-auto px-4 mt-6">
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3 w-1/12">No</th>
                        <th class="px-4 py-3 w-3/12">Nama Dokumen</th>
                        <th class="px-4 py-3 w-4/12 text-center">Aksi</th>                        
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($dokumen as $index => $item)
                        <tr>
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->nama_dokumen }}</td>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-wrap gap-2 justify-center">
                                    <a href="{{ asset('storage/dokumen_ika/'.$item->file_dokumen) }}" target="_blank"
                                        class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                                        Lihat Dokumen
                                    </a>
                            
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <button type="button" onclick="openModal({{ $item->id }}, '{{ $item->nama_dokumen }}')"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">
                                            Edit
                                        </button>
                            
                                        <form action="{{ route('inspeksi.dokumen.destroy', $item->id) }}" method="POST" 
                                            onsubmit="return confirmDelete(this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada dokumen yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <br><br>
    </div>
    
    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-lg font-bold mb-4">Edit Dokumen</h2>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" id="edit_nama" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Upload File Baru (Opsional)</label>
                    <input type="file" name="file_dokumen" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tambah Dokumen -->
    <a href="{{ route('inspeksi.dokumen.create') }}" class="fixed bottom-4 right-4 bg-gray-200 hover:bg-gray-300 text-primary rounded-full p-3 shadow-lg">
        + Tambah Dokumen
    </a>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            showConfirmButton: false,
            timer: 2000 // dalam milidetik (2 detik)
        });
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

    function openModal(id, nama) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');

        // set value
        document.getElementById('edit_nama').value = nama;

        // set action form
        const form = document.getElementById('editForm');
        form.action = "/inspeksi/dokumen/" + id; // sesuai resource route
    }

    function closeModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
    }

    function confirmDelete(form) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Dokumen akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
    </script>

</body>
</html>
