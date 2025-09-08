<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Kritik dan Saran K3L & Keamanan UP2WVI</title>
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
            KRITIK DAN SARAN K3L & KEAMANAN
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
                KRITIK DAN SARAN K3L & KEAMANAN
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
        <a href="{{ route('welcome') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
            ←
        </a>
    </div>

    <!-- Tabel Saran -->
    <div class="max-w-6xl mx-auto px-4 mt-6">
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3 w-1/12">No</th>
                        <th class="px-4 py-3 w-2/12">Tanggal</th>
                        <th class="px-4 py-3 w-7/12">Kritik/Saran</th>
                        <th class="px-4 py-3 w-2/12 text-center">Aksi</th>                        
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($sarans as $index => $saran)
                        <tr>
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($saran->created_at)->timezone('Asia/Jakarta')->translatedFormat('j M Y H:i') }}
                            </td>                            
                            <td class="px-4 py-3 break-words whitespace-normal" style="max-width: 200px;">{{ $saran->saran }}</td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                <button class="edit-btn bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded"
                                data-id="{{ $saran->id }}" 
                                data-saran="{{ htmlspecialchars($saran->saran, ENT_QUOTES) }}">
                            Edit
                        </button>
                                    <form action="{{ route('saran.destroy', $saran->id) }}" method="POST" class="inline" onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeleteAJAX({{ $saran->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">
                                            Hapus
                                        </button>                                        
                                    </form>                                    
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada data saran yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <br>
        <br>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white p-6 rounded-lg w-full max-w-xl max-h-[90vh] overflow-y-auto relative">
                <button onclick="closeEditModal()" class="absolute top-2 right-2 text-xl rounded-full w-8 h-8 flex items-center justify-center">
                    &times;
                </button>
                <h2 class="text-lg font-bold text-center text-primary mb-4">Edit Saran</h2>
                <form id="editForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <textarea id="editSaranText" name="saran" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-2" required></textarea>
                    <div class="text-center space-x-2">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-lg">
                            Simpan
                        </button>
                        <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
                            Batal
                        </button>
                    </div>
                </form>            
            </div>
        </div>
    </div>

    <a href="{{ route('saran.create') }}" class="fixed bottom-4 right-4 bg-gray-200 hover:bg-gray-300 text-primary rounded-full p-2 shadow-lg sm:p-3">
        + Tambahkan Saran
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
// JavaScript dengan penanganan error auth yang baik

let currentEditId = null;

function openEditModal(id, saranText) {
    console.log('Opening modal for ID:', id);
    currentEditId = id;
    document.getElementById('editSaranText').value = saranText;
    
    // FIXED: Use style.display instead of classList
    const modal = document.getElementById('editModal');
    modal.style.display = 'block';
}

function closeEditModal() {
    console.log('Closing modal');
    currentEditId = null;
    document.getElementById('editForm').reset();
    
    // FIXED: Use style.display instead of classList  
    const modal = document.getElementById('editModal');
    modal.style.display = 'none';
}

// Event listener untuk form submit
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!currentEditId) {
                Swal.fire('Error', 'ID saran tidak ditemukan', 'error');
                return;
            }

            const saranValue = document.getElementById('editSaranText').value.trim();
            if (!saranValue) {
                Swal.fire('Error', 'Saran tidak boleh kosong', 'error');
                return;
            }

            // Ambil CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                Swal.fire('Error', 'CSRF token tidak ditemukan', 'error');
                return;
            }

            // Tampilkan loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang menyimpan perubahan',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim request
            fetch(`/inspeksi/saran/${currentEditId}`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
        'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({ saran: saranValue })
})

            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response URL:', response.url);
                console.log('Response headers:', [...response.headers.entries()]);
                
                // Cek apakah response adalah redirect ke login
                if (response.url.includes('/login') || response.status === 302) {
                    throw new Error('AUTHENTICATION_REQUIRED');
                }
                
                // Cek apakah response bukan JSON (kemungkinan HTML redirect)
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    console.log('Non-JSON response received');
                    throw new Error('AUTHENTICATION_REDIRECT');
                }

                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || `HTTP ${response.status}: ${response.statusText}`);
                    }).catch(() => {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    });
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Success response:', data);
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message || 'Data saran berhasil diperbarui',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        closeEditModal();
                        location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Gagal update saran');
                }
            })
            .catch(error => {
                console.error('Error details:', error);
                
                let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                
                if (error.message === 'AUTHENTICATION_REQUIRED' || error.message === 'AUTHENTICATION_REDIRECT') {
                    errorMessage = 'Anda harus login sebagai admin untuk melakukan aksi ini';
                    
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Diperlukan!',
                        text: errorMessage,
                        showCancelButton: true,
                        confirmButtonText: 'Login Sekarang',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect ke halaman login
                            window.location.href = '/login';
                        }
                    });
                    return;
                } else if (error.message.includes('401')) {
                    errorMessage = 'Anda harus login terlebih dahulu';
                } else if (error.message.includes('403')) {
                    errorMessage = 'Anda tidak memiliki izin untuk melakukan aksi ini';
                } else if (error.message.includes('404')) {
                    errorMessage = 'Data saran tidak ditemukan';
                } else if (error.message.includes('422')) {
                    errorMessage = 'Data yang dimasukkan tidak valid';
                } else if (error.message.includes('500')) {
                    errorMessage = 'Kesalahan server internal';
                } else if (error.message) {
                    errorMessage = error.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
            });
        });
    }
});

function confirmDeleteAJAX(id) {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Saran akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/inspeksi/saran/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message || 'Saran berhasil dihapus',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Reload halaman supaya tabel terupdate
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'Gagal menghapus saran', 'error');
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Terjadi kesalahan saat menghapus data', 'error');
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Event delegation untuk tombol edit
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-btn')) {
            const id = e.target.getAttribute('data-id');
            const saran = e.target.getAttribute('data-saran');
            openEditModal(id, saran);
        }
    });
});

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
