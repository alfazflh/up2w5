@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peralatan Tanggap Darurat UP2WV</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-primary { background-color: #1f7389; }
        .text-primary { color: #196275; }
        .hover\:bg-primary-dark:hover { background-color: #134e5a; }
    </style>
</head>
<body id="main-body" class="bg-gray-100 font-sans">

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
            DASHBOARD PERALATAN TANGGAP DARURAT
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W V
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
            DASHBOARD PERALATAN TANGGAP DARURAT
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
        
    
    

    <!-- Main Section -->
    <main class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-10 text-center">
            @php
            $alat = [
                ['label' => 'APAR', 'route' => 'apar.index', 'icon' => 'https://seduhteh.wordpress.com/wp-content/uploads/2015/08/apar.png'],
                ['label' => 'APAT', 'route' => 'apat.index', 'icon' => 'https://ik.imagekit.io/pln/sekop.png'],
                ['label' => 'APAB', 'route' => 'apab.index', 'icon' => 'https://seduhteh.wordpress.com/wp-content/uploads/2015/08/apar.png'],
                ['label' => 'Fire Alarm', 'route' => 'fire_alarm.index', 'icon' => 'https://phabcart.imgix.net/cdn/scdn/images/uploads/firealarm_square_web_600.png?auto=compress&lossless=1&w=500'],
                ['label' => 'Box Hydrant', 'route' => 'boxhydrant.index', 'icon' => 'https://png.pngtree.com/png-vector/20250523/ourmid/pngtree-fire-hydrant-sign-red-vector-png-image_16363373.png'],
                ['label' => 'Rumah Pompa', 'route' => 'rumah_pompa.index', 'icon' => 'https://png.pngtree.com/png-vector/20250523/ourmid/pngtree-fire-hydrant-sign-red-vector-png-image_16363373.png'],
                ['label' => 'Kotak P3K', 'route' => 'p3k.index', 'icon' => 'https://ik.imagekit.io/pln/pngwing.com.png'],
                ['label' => 'IK', 'route' => 'inspeksi.dokumen.hasil', 'icon' => 'https://ik.imagekit.io/pln/audit.png'],
            ];
        
            if (Auth::check() && Auth::user()->role === 'admin') {
                $alat[] = [
                    'label' => 'Kritik & Saran',
                    'route' => 'saran.hasil',
                    'icon'  => 'https://blood4life.id/img/Icon_Kritik_Saran.png?1584552386'
                ];
            } else {
                $alat[] = [
                    'label' => 'Kritik & Saran',
                    'route' => 'saran.create',
                    'icon'  => 'https://blood4life.id/img/Icon_Kritik_Saran.png?1584552386'
                ];
            }
        @endphp
        
        
            {{-- 6 item pertama --}}
            @foreach (array_slice($alat, 0, 9) as $item)
                <a href="{{ route($item['route']) }}" 
                   class="bg-white shadow-md rounded-lg p-6 sm:p-4 min-h-[150px] flex flex-col items-center justify-center hover:bg-gray-100 transition">
                    <img src="{{ $item['icon'] }}" 
                         alt="{{ $item['label'] }}" 
                         class="w-24 h-24 sm:w-20 sm:h-20 object-contain mb-3">
                    <span class="text-base sm:text-md font-semibold text-gray-800">
                        {{ $item['label'] }}
                    </span>
                </a>
            @endforeach
        
        </div>
        
        
        

        <div class="bg-white shadow-md rounded-lg p-4 sm:p-6 text-center">
            <img src="{{ asset('images/denah.jpg') }}" alt="Denah Lokasi" id="denah-img"
                 class="mx-auto rounded cursor-zoom-in shadow-lg max-w-full h-auto">
        </div>

        <div id="popup-denah" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden">
            <div class="relative overflow-hidden max-w-full max-h-full">
                <button onclick="closePopup()" class="absolute top-2 right-2 text-white text-3xl font-bold z-10 hover:text-red-500">&times;</button>

                <div id="image-wrapper" class="cursor-grab active:cursor-grabbing select-none" style="width: 100vw; height: 90vh; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('images/denah.jpg') }}" alt="Popup Denah" id="popup-img"
                         class="rounded shadow-lg transform transition-transform duration-200 object-contain" />
                </div>
            </div>
        </div>
<br>
<div class="text-center mt-5 space-x-4">
    <a href="{{ route('login') }}" class="bg-primary text-white text-lg px-6 py-3 rounded hover:bg-primary-dark">Login</a>
    <a href="{{ route('register') }}" class="hidden bg-green-600 text-white text-lg px-6 py-3 rounded hover:bg-green-700">Register</a>
</div>

    </main>

    <footer class="text-center text-sm text-gray-500 py-6">
        &copy; {{ date('Y') }} K3 PLN Pusharlis UP2WVI. All rights reserved.
    </footer>

    <script>
    const denahImg = document.getElementById('denah-img');
    const popup = document.getElementById('popup-denah');
    const popupImg = document.getElementById('popup-img');
    const wrapper = document.getElementById('image-wrapper');
    let scale = 1, isDragging = false, startX, startY, translateX = 0, translateY = 0;

    denahImg.addEventListener('click', () => {
        popup.classList.remove('hidden');
        scale = 1;
        translateX = 0;
        translateY = 0;
        updateTransform();
    });

    function closePopup() {
        popup.classList.add('hidden');
    }

    wrapper.addEventListener('wheel', (e) => {
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        scale = Math.min(Math.max(0.5, scale + delta), 3);
        updateTransform();
    });

    wrapper.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.clientX - translateX;
        startY = e.clientY - translateY;
    });

    wrapper.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        translateX = e.clientX - startX;
        translateY = e.clientY - startY;
        updateTransform();
    });

    wrapper.addEventListener('mouseup', () => isDragging = false);
    wrapper.addEventListener('mouseleave', () => isDragging = false);

    function updateTransform() {
        popupImg.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
    }

    popup.addEventListener('click', (e) => {
        if (e.target === popup) closePopup();
    });

    function setBodyPadding() {
        const header = document.getElementById('main-header');
        const body = document.getElementById('main-body');
        const headerHeight = header.offsetHeight;
        body.style.paddingTop = `${headerHeight}px`;
    }

    window.addEventListener('load', setBodyPadding);
    window.addEventListener('resize', setBodyPadding);
    </script>
</body>
</html>

