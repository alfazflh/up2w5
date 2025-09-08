<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - P3K</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .border-primary { border-color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }
        .bg-safety-green { background-color: #196275; }
        .text-safety-green { color: #196275; }
        .step-inactive { opacity: 0.5; }
        .step-active { background-color: #196275; color: white; }
        .radio-group { display: flex; gap: 8px; align-items: center; }
        .radio-option { display: flex; align-items: center; gap: 4px; }
        .disabled-radio { opacity: 0.5; pointer-events: none; }
        .loading { opacity: 0.7; pointer-events: none; }
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
        <a href="{{ route('p3k.hasil', ['id_p3k' => $id_p3k]) }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
            ←
        </a>
    </div>

    <!-- Progress Steps -->
    <div class="max-w-4xl mx-auto px-4 md:px-6 mb-8 mt-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div id="step1-indicator" class="step-active w-6 h-6 md:w-8 md:h-8 rounded-full flex items-center justify-center text-xs md:text-sm font-bold mr-2">1</div>
                <span class="text-xs md:text-sm font-medium hidden sm:block">Data & Pemeriksaan</span>
                <span class="text-xs font-medium sm:hidden">Step 1</span>
            </div>
            <div class="flex-1 h-1 bg-gray-300 mx-2 md:mx-4"></div>
            <div class="flex items-center">
                <div id="step2-indicator" class="step-inactive w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs md:text-sm font-bold mr-2">2</div>
                <span class="text-xs md:text-sm font-medium hidden sm:block">Tanggal Kadaluarsa</span>
                <span class="text-xs font-medium sm:hidden">Step 2</span>
            </div>
            <div class="flex-1 h-1 bg-gray-300 mx-2 md:mx-4"></div>
            <div class="flex items-center">
                <div id="step3-indicator" class="step-inactive w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs md:text-sm font-bold mr-2">3</div>
                <span class="text-xs md:text-sm font-medium hidden sm:block">Catatan</span>
                <span class="text-xs font-medium sm:hidden">Step 3</span>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 md:px-8 lg:px-10">
        <form id="form-p3k" action="{{ route('pemeriksaan-p3k.store') }}" method="POST"
              class="max-w-6xl mx-auto py-6 mb-10 bg-white rounded-xl shadow-lg space-y-6 px-4 sm:px-6 md:px-8">
            @csrf
            <input type="hidden" name="id_p3k" value="{{ $id_p3k ?? 'P3K001' }}">

            <div id="step1" class="step-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block font-semibold mb-1 text-sm md:text-base">Tanggal Pemeriksaan *</label>
                        <input type="date" name="tanggal_pemeriksaan" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm md:text-base" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block font-semibold mb-1 text-sm md:text-base">Petugas *</label>
                        <input type="text" name="petugas" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm md:text-base" required placeholder="Nama petugas">
                    </div>
                </div>

                <!-- Header tabel untuk desktop -->
                <div class="hidden md:grid grid-cols-12 gap-3 bg-gray-100 p-3 rounded-lg font-semibold text-sm">
                    <div class="col-span-1">NO</div>
                    <div class="col-span-5">NAMA BARANG</div>
                    <div class="col-span-2">STANDAR</div>
                    <div class="col-span-4">KONDISI / JUMLAH</div>
                </div>

                <div class="space-y-4" id="items-container">
                    <!-- Items akan di-generate oleh JavaScript -->
                </div>

                <div class="text-right mt-6">
                    <button type="button" id="next-step1" class="bg-safety-green hover:bg-green-600 text-white font-semibold py-2 px-4 md:px-6 rounded-lg text-sm md:text-base">
                        Berikutnya →
                    </button>
                </div>
            </div>

            <!-- STEP 2: Tanggal Kadaluarsa -->
            <div id="step2" class="step-content hidden">
                <div class="bg-safety-green text-white p-4 rounded-lg mb-6">
                    <h2 class="text-lg md:text-xl font-bold">TANGGAL KADALUARSA</h2>
                </div>

                <div class="space-y-4" id="expiry-container">
                    <!-- Expiry dates akan di-generate oleh JavaScript -->
                </div>

                <div class="flex flex-col sm:flex-row justify-between mt-6 gap-3">
                    <button type="button" id="prev-step2" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 md:px-6 rounded-lg text-sm md:text-base">
                        ← Sebelumnya
                    </button>
                    <button type="button" id="next-step2" class="bg-safety-green hover:bg-green-600 text-white font-semibold py-2 px-4 md:px-6 rounded-lg text-sm md:text-base">
                        Berikutnya →
                    </button>
                </div>
            </div>

            <!-- STEP 3: Catatan -->
            <div id="step3" class="step-content hidden">
                <div class="bg-safety-green text-white p-4 rounded-lg mb-6">
                    <h2 class="text-lg md:text-xl font-bold">CATATAN</h2>
                </div>

                <div class="space-y-4" id="notes-container">
                    <!-- Notes akan di-generate oleh JavaScript -->
                </div>

                <div class="flex flex-col sm:flex-row justify-between mt-6 gap-3">
                    <button type="button" id="prev-step3" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 md:px-6 rounded-lg text-sm md:text-base">
                        ← Sebelumnya
                    </button>
                    <button type="submit" id="submit-btn" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 md:px-6 rounded-lg text-sm md:text-base">
                        Simpan Pemeriksaan P3K
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;
        let isSubmitting = false;

        // Data items P3K
        const p3kItems = [
            { field: 'kasa', name: 'Kasa Steril Terbungkus', standard: '20' },
            { field: 'perban5cm', name: 'Perban (lebar 5 cm)', standard: '2' },
            { field: 'perban10cm', name: 'Perban (lebar 10 cm)', standard: '2' },
            { field: 'plester125cm', name: 'Plester (lebar 1,25 cm)', standard: '2' },
            { field: 'plester', name: 'Plester Cepat', standard: '10' },
            { field: 'kapas', name: 'Kapas (25 gram)', standard: '1' },
            { field: 'mittela', name: 'Kain segitiga/mittela', standard: '2' },
            { field: 'gunting', name: 'Gunting', standard: '1' },
            { field: 'peniti', name: 'Peniti', standard: '12' },
            { field: 'sarung_tangan', name: 'Sarung tangan sekali pakai', standard: '2' },
            { field: 'pasangan', name: '(Pasangan)', standard: '2' },
            { field: 'masker', name: 'Masker', standard: '1' },
            { field: 'pinset', name: 'Pinset', standard: '1' },
            { field: 'senter', name: 'Lampu senter', standard: '1' },
            { field: 'gelas', name: 'Gelas untuk cuci mata', standard: '1' },
            { field: 'plastik', name: 'Kantong plastik bersih', standard: '1' },
            { field: 'aquades', name: 'Aquades (100 ml lar. Saline)', standard: '1' },
            { field: 'povidon', name: 'Povidon Iodin (60 ml)', standard: '1' },
            { field: 'alkohol', name: 'Alkohol 70%', standard: '1' },
            { field: 'panduanp3k', name: 'Buku panduan P3K di tempat kerja', standard: '1' },
            { field: 'daftarisi', name: 'Buku catatan Daftar isi kotak P3K', standard: '1' }
        ];

        // Generate items untuk Step 1
        function generateStep1Items() {
            const container = document.getElementById('items-container');
            container.innerHTML = '';

            p3kItems.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'border rounded-lg p-3 md:p-4';
                itemDiv.innerHTML = `
                    <!-- Mobile Layout -->
                    <div class="md:hidden space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-sm">${index + 1}. ${item.name}</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">Standar: ${item.standard}</span>
                        </div>
                        <div class="space-y-2">
                            <div class="radio-group text-sm" id="radio-${item.field}">
                                <div class="radio-option">
                                    <input type="radio" id="${item.field}_baik" name="${item.field}_kondisi" value="baik">
                                    <label for="${item.field}_baik">Baik</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="${item.field}_tidak" name="${item.field}_kondisi" value="tidak">
                                    <label for="${item.field}_tidak">Tidak Baik</label>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs text-gray-600">Lainnya:</label>
                                <input type="number" name="${item.field}_jumlah" id="${item.field}_jumlah" placeholder="Lainnya" class="w-full border rounded px-2 py-1 text-sm" min="0" onchange="handleNumberInput('${item.field}')">
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout -->
                    <div class="hidden md:grid grid-cols-12 gap-3 items-center">
                        <div class="col-span-1 font-semibold text-sm">${index + 1}</div>
                        <div class="col-span-5 text-sm">${item.name}</div>
                        <div class="col-span-2 text-sm font-medium">${item.standard}</div>
                        <div class="col-span-4 space-y-2">
                            <div class="radio-group text-sm" id="radio-desktop-${item.field}">
                                <div class="radio-option">
                                    <input type="radio" id="${item.field}_baik_desktop" name="${item.field}_kondisi" value="baik">
                                    <label for="${item.field}_baik_desktop">Baik</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="${item.field}_tidak_desktop" name="${item.field}_kondisi" value="tidak">
                                    <label for="${item.field}_tidak_desktop">Tidak Baik</label>
                                </div>
                            </div>
                            <input type="number" name="${item.field}_jumlah" id="${item.field}_jumlah_desktop" placeholder="Lainnya" class="w-full border rounded px-2 py-1 text-sm" min="0" onchange="handleNumberInput('${item.field}')">
                        </div>
                    </div>
                `;
                container.appendChild(itemDiv);
            });
        }

        // Generate items untuk Step 2 (Expiry dates)
        function generateStep2Items() {
            const container = document.getElementById('expiry-container');
            container.innerHTML = '';

            p3kItems.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'bg-gray-50 p-3 md:p-4 rounded-lg';
                itemDiv.innerHTML = `
                    <label class="block font-semibold mb-2 text-sm md:text-base">Tanggal kadaluarsa ${item.name}</label>
                    <input type="date" name="kadaluarsa_${item.field}" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm md:text-base">
                `;
                container.appendChild(itemDiv);
            });
        }

        // Generate items untuk Step 3 (Notes)
        function generateStep3Items() {
            const container = document.getElementById('notes-container');
            container.innerHTML = '';

            p3kItems.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'bg-gray-50 p-3 md:p-4 rounded-lg';
                itemDiv.innerHTML = `
                    <label class="block font-semibold mb-2 text-sm md:text-base">Catatan ${item.name}</label>
                    <textarea name="catatan_${item.field}" rows="2" placeholder="Tulis catatan jika diperlukan" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm md:text-base"></textarea>
                `;
                container.appendChild(itemDiv);
            });
        }

        // Handle number input untuk disable/enable radio buttons
        function handleNumberInput(fieldName) {
            const numberInputMobile = document.getElementById(`${fieldName}_jumlah`);
            const numberInputDesktop = document.getElementById(`${fieldName}_jumlah_desktop`);
            const radioGroupMobile = document.getElementById(`radio-${fieldName}`);
            const radioGroupDesktop = document.getElementById(`radio-desktop-${fieldName}`);

            // Get the actual input value (either from mobile or desktop)
            let numberValue = '';
            if (numberInputMobile && numberInputMobile.value) {
                numberValue = numberInputMobile.value;
                if (numberInputDesktop) numberInputDesktop.value = numberValue;
            } else if (numberInputDesktop && numberInputDesktop.value) {
                numberValue = numberInputDesktop.value;
                if (numberInputMobile) numberInputMobile.value = numberValue;
            }

            // Handle radio button state
            const radioInputs = document.querySelectorAll(`input[name="${fieldName}_kondisi"]`);
            
            if (numberValue && numberValue !== '0') {
                // Disable radio buttons and clear selection
                radioInputs.forEach(radio => {
                    radio.checked = false;
                    radio.disabled = true;
                });
                if (radioGroupMobile) radioGroupMobile.classList.add('disabled-radio');
                if (radioGroupDesktop) radioGroupDesktop.classList.add('disabled-radio');
            } else {
                // Enable radio buttons
                radioInputs.forEach(radio => {
                    radio.disabled = false;
                });
                if (radioGroupMobile) radioGroupMobile.classList.remove('disabled-radio');
                if (radioGroupDesktop) radioGroupDesktop.classList.remove('disabled-radio');
            }
        }

        // Step Navigation Functions
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            
            // Show current step
            document.getElementById(`step${step}`).classList.remove('hidden');
            
            // Update indicators
            document.querySelectorAll('[id$="-indicator"]').forEach(el => {
                el.classList.remove('step-active');
                el.classList.add('step-inactive');
                el.classList.add('bg-gray-300');
            });
            
            document.getElementById(`step${step}-indicator`).classList.remove('step-inactive', 'bg-gray-300');
            document.getElementById(`step${step}-indicator`).classList.add('step-active');
            
            currentStep = step;
        }

        function validateStep1() {
            // Check basic info first
            const tanggal = document.querySelector('[name="tanggal_pemeriksaan"]');
            const petugas = document.querySelector('[name="petugas"]');
            
            if (!tanggal || !tanggal.value.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lengkapi Data!',
                    text: 'Tanggal pemeriksaan harus diisi.',
                    showConfirmButton: true
                });
                return false;
            }
            
            if (!petugas || !petugas.value.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lengkapi Data!',
                    text: 'Nama petugas harus diisi.',
                    showConfirmButton: true
                });
                return false;
            }
            
            // Check each item condition
            for (let item of p3kItems) {
                const numberInput = document.querySelector(`[name="${item.field}_jumlah"]`);
                const kondisiInput = document.querySelector(`[name="${item.field}_kondisi"]:checked`);
                
                if ((!numberInput || !numberInput.value) && !kondisiInput) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lengkapi Data!',
                        text: `Kondisi ${item.name} harus dipilih atau diisi jumlah.`,
                        showConfirmButton: true
                    });
                    return false;
                }
            }
            return true;
        }

        // Event Listeners
        document.getElementById('next-step1').addEventListener('click', function() {
            if (validateStep1()) {
                showStep(2);
            }
        });

        document.getElementById('prev-step2').addEventListener('click', function() {
            showStep(1);
        });

        document.getElementById('next-step2').addEventListener('click', function() {
            showStep(3);
        });

        document.getElementById('prev-step3').addEventListener('click', function() {
            showStep(2);
        });

        // Form submission with proper validation
        document.getElementById('form-p3k').addEventListener('submit', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                return;
            }

            // Validate before submission
            if (!validateStep1()) {
                e.preventDefault();
                showStep(1);
                return;
            }

            // Set submitting flag
            isSubmitting = true;
            
            // Show loading state
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;
            document.getElementById('form-p3k').classList.add('loading');

            // Show loading message
            Swal.fire({
                title: 'Menyimpan Data...',
                text: 'Mohon tunggu, data sedang diproses.',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Let the form submit naturally
        });

        // Initialize
        function init() {
            generateStep1Items();
            generateStep2Items();
            generateStep3Items();
            showStep(1);
        }

        function setBodyPadding() {
            const header = document.getElementById('main-header');
            const spacer = document.getElementById('spacer');
            if (header && spacer) {
                const headerHeight = header.offsetHeight;
                spacer.style.paddingTop = `${headerHeight + 3}px`; 
            }
        }

        // Handle page unload warning if form is partially filled
        window.addEventListener('beforeunload', function(e) {
            if (!isSubmitting) {
                const petugas = document.querySelector('[name="petugas"]');
                if (petugas && petugas.value.trim()) {
                    e.preventDefault();
                    e.returnValue = 'Data yang sudah diisi akan hilang. Yakin ingin keluar?';
                    return e.returnValue;
                }
            }
        });

        window.addEventListener('load', function() {
            init();
            setBodyPadding();
        });
        
        window.addEventListener('resize', setBodyPadding);

        // Debug function untuk testing
        function debugFormData() {
            const formData = new FormData(document.getElementById('form-p3k'));
            console.log('=== FORM DATA DEBUG ===');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
        }
    </script>

</body>
</html>