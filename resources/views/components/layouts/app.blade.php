<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('/default_images/beauty_shop_white_logo_transparent.png') }}" />

    <title>@yield('meta-title', 'Beauty Shop')</title>
    <meta name="description"
        content="@yield('meta-description', 'Beauty Shop is an online cosmetics shop that is providing local customers with best quality cosmetics products.')" />
    <link rel="canonical" href='@yield(' meta-canonical', url()->current())' />
    <meta name="robots" content="@yield('meta-robots', 'index, follow')">

    <!-- Open Graph meta tags -->
    <meta property="og:type" content="@yield('meta-og-type', 'website')" />
    <meta property="og:title" content="@yield('meta-og-title', 'Beauty Shop')" />
    <meta property="og:description"
        content="@yield('meta-og-description', 'A cosmetics online shop that is selling quality cosmetics products with affordable prices for each product.')" />
    <meta property="og:image"
        content="@yield('meta-og-image', asset('/default_images/beauty_shop_white_banner.png'))" />
    <meta property="og:url" content="@yield('meta-og-url', url()->current())" />
    <meta property="og:site_name" content="@yield('meta-og-sitename', 'Beauty Shop')" />

    <!-- Tailwind css directive -->
    @vite('resources/js/app.js')

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">

    <!-- toastify css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Custom Styles -->
    @yield('layout-style')

    @stack('layout-style-stack')
</head>

<body class="font-cabin bg-gradient-to-t from-[#e0bad5] to-[#f1b5d8] h-screen">
    <header class="bg-slate-50 shadow-md">
        <nav class="flex justify-between md:justify-normal items-center w-[92%] mx-auto p-1">
            <div class="flex items-center gap-2">
                <img class="w-16" src="{{ asset('default_images/beauty_shop_white_logo_transparent.png') }}"
                    alt="Beaty Shop Logo">
                <p class="md:text-base lg:text-xl font-bold font-mono text-pink-600">
                    Best Comestics
                </p>
            </div>

            <div
                class="nav-links md:static absolute ease-in-out transition-all duration-500 bg-slate-50 md:min-h-fit left-0 top-[-100%] w-full md:w-auto flex items-center px-5 py-2">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-2 mx-2">
                    <li>
                        <a class="hover:text-pink-500 {{ request()->routeIs('home') ? 'text-pink-500' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>

                    <!-- Profile -->
                    @if (Auth::check())
                    <li>
                        <button class=" cursor-pointer" onclick="dropdownToggle('profile')">
                            <img id="profile-image" src="/storage{{ Auth::user()->image }}"
                                class="w-14 max-h-14 border rounded-full shadow" loading="lazy"
                                alt="{{ Auth::user()->name }}'s profile image" />
                        </button>
                        <div id="profile-dropdown"
                            class="hidden md:absolute rounded-lg w-auto bg-white text-black shadow py-2 px-1">
                            <ul class="ul-clear">

                                @if (Auth::user()->role === '2')
                                <li class="rounded-lg cursor-pointer px-4 py-2 hover:bg-gray-100">
                                    <a class="text-black hover:no-underline" href="">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-gauge"></i>
                                            Dashboard
                                        </div>
                                    </a>
                                </li>
                                @endif

                                <li class="rounded-lg cursor-pointer px-4 py-2 hover:bg-gray-100">
                                    <a class="text-black hover:no-underline" href="{{ route('user.profile') }}">
                                        Profile
                                    </a>
                                </li>

                                <li class="rounded-lg px-4 py-2 hover:bg-gray-100">
                                    <form id="admin-logout-delete-form" action="" method="POST">
                                        @csrf
                                        <button type="button"
                                            onclick='openPopupDeleteSubmit("Are you sure about logging out form the account, {{ Auth::user()->name }}?", "admin-logout")'
                                            class="flex items-center gap-2">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                </ul>
            </div>
            <div class="flex items-center gap-6">
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </header>

    <div>
        {{ $slot }}
    </div>


    <!-- Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- toastify js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Custom Scripts -->
    @yield('layout-script')

    @stack('layout-script-stack')

    @include('components.partials.toast')


    <script>
        // mobile toggle 
        const navLinks = document.querySelector('.nav-links')
        function onToggleMenu(event){
            event.name = event.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[65px]')
        }

        // dropdown toggle
        function dropdownToggle(type) {
            let dropdownList = document.getElementById(`${type}-dropdown`);

            dropdownList.classList.toggle('hidden');
        }

        // update the profile
        window.addEventListener('new-profile', event => {
            const profiles = document.querySelectorAll("#profile-image")

            // loop over all the profile images
            for(i = 0; i < profiles.length; ++i) {
                profiles[i].src = "/storage" + event.detail.src // change to new src
            }
        })  
    </script>
</body>

</html>