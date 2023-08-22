<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('/default_images/beauty_shop_white_logo_transparent.png') }}" />

    <title>@yield('meta-title', 'Beauty Shop')</title>
    <meta name="description" content="@yield('meta-description', 'Beauty Shop is an online cosmetics shop that is providing local customers with best quality cosmetics products.')" />
    <link rel="canonical" href='@yield('meta-canonical', url()->current())' />
    <meta name="robots" content="@yield('meta-robots', 'index, follow')">

    <!-- Open Graph meta tags -->
    <meta property="og:type" content="@yield('meta-og-type', 'website')" />
    <meta property="og:title" content="@yield('meta-og-title', 'Beauty Shop')" />
    <meta property="og:description" content="@yield('meta-og-description', 'A cosmetics online shop that is selling quality cosmetics products with affordable prices for each product.')" />
    <meta property="og:image" content="@yield('meta-og-image', asset('/default_images/beauty_shop_white_banner.png'))" />
    <meta property="og:url" content="@yield('meta-og-url', url()->current())" />
    <meta property="og:site_name" content="@yield('meta-og-sitename', 'Beauty Shop')" />

    <!-- Tailwind css directive -->
    @vite('resources/js/app.js')

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    @yield('layout-style')

    @stack('layout-style-stack')
</head>

<body class="font-cabin bg-gradient-to-t from-[#e0bad5] to-[#f1b5d8] h-screen">
    <header class="bg-slate-50">
        <nav class="flex justify-around items-center w-[92%] mx-auto p-1">
            <div class="flex items-center gap-2">
                <img class="w-16" src="{{ asset('default_images/beauty_shop_white_logo_transparent.png') }}"
                    alt="Beaty Shop Logo">
                <p class="md:text-base lg:text-xl font-bold font-mono text-pink-600">
                    Best Comestics
                </p>
            </div>

            <div
                class="nav-links md:static absolute ease-in-out transition-all duration-500 bg-slate-50 md:min-h-fit left-0 top-[-100%] w-full md:w-auto flex items-center px-5 py-2">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                    <li>
                        <a class="hover:text-pink-500" href="#">Products</a>
                    </li>
                    <li>
                        <a class="hover:text-pink-500" href="#">Products</a>
                    </li>
                    <li>
                        <a class="hover:text-pink-500" href="#">Products</a>
                    </li>
                    <li>
                        <a class="hover:text-pink-500" href="#">Products</a>
                    </li>
                    <li>
                        <a class="hover:text-pink-500" href="#">Products</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-6">
                <button class="button-pink-rounded whitespace-nowrap">Sign In</button>
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </header>
    Unauth Layout2
    {{ $slot }}

    <!-- Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Custom Scripts -->
    @yield('layout-script')

    @stack('layout-script-stack')

    @include('components.partials.toast')

    <!-- Menu Toggle Function --->
    <script>

        const navLinks = document.querySelector('.nav-links')

        function onToggleMenu(event){
            event.name = event.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[10%]')
        }
    </script>
</body>

</html>
