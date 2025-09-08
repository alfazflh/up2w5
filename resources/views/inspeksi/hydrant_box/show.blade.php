<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Peralatan Tanggap Darurat UP2WVI - BOX HYDRANT</title>
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
            MONITORING BOX HYDRANT
            </h1>
            <h2 class="text-xs sm:text-sm text-white font-semibold">
            PLN PUSHARLIS UP2W VI
            </h2>
        </div>

        <div class="absolute inset-x-0 text-center hidden md:block">
            <h1 class="font-bold text-white leading-tight"
                style="font-size: clamp(1rem, 2vw + 0.5rem, 2rem);">
                MONITORING BOX HYDRANT
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
        <a href="{{ route('boxhydrant.index') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
            ←
        </a>
    </div>

    <div class="max-w-6xl mx-auto px-4 mt-12 grid grid-cols-1 sm:grid-cols-2 gap-8 text-center">
        <a href="{{ route('boxhydrant.inspeksi', ['id_boxhydrant' => $boxhydrant->id_boxhydrant]) }}"
           class="flex flex-col items-center justify-center bg-gray-100 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 p-6">
            <img src="https://ik.imagekit.io/pln/boxhy.png"
                 alt="Inspeksi Fire Alarm" class="h-28 md:h-36 object-contain">
            <span class="mt-4 text-primary font-semibold text-base md:text-lg text-center">
                INSPEKSI BOX HYDRANT
            </span>
        </a>

        <a href="{{ route('boxhydrant.hasil', ['id_boxhydrant' => $boxhydrant->id_boxhydrant]) }}"
           class="flex flex-col items-center justify-center bg-gray-100 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 p-6">
            <img src="https://ik.imagekit.io/pln/boxhyhsl.png"
                 alt="Hasil Inspeksi" class="h-28 md:h-36 object-contain">
            <span class="mt-4 text-primary font-semibold text-base md:text-lg text-center">
                HASIL INSPEKSI BOX HYDRANT
            </span>
        </a>
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

</body>
</html>
