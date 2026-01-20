<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/css">
        @theme {
            --color-brand-black: #232f3e;
            --color-brand-dark: #19212c;
            --color-brand-yellow: #febd69;
            --color-brand-orange: #fa8900;
            --color-brand-blue: #007185;

            --font-sans: "Inter", ui-sans-serif, system-ui, sans-serif;

            --shadow-card: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-card-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @vite(['resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <!-- Top Header -->
    <header class="bg-[#232f3e] text-white sticky top-0 z-50">
        <!-- Main Bar -->
        <div class="max-w-[1600px] mx-auto flex items-center gap-2 lg:gap-4 p-2 px-4">
            <!-- Logo -->
            <a href="/"
                class="flex items-center pt-2 px-2 border border-transparent hover:border-white rounded-sm transition-all duration-200">
                <span class="text-2xl font-bold tracking-tight">amazon<span class="text-[#fa8900]">.pro</span></span>
            </a>

            <!-- Location Picker -->
            <div
                class="hidden lg:flex items-center px-2 py-1 border border-transparent hover:border-white rounded-sm cursor-pointer min-w-[120px] transition-all duration-200 group">
                <div class="mr-1 mt-auto mb-1 text-slate-300 group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="flex flex-col justify-center leading-tight">
                    <span class="text-[12px] text-slate-300 block leading-none">Deliver to</span>
                    <span class="font-bold text-sm text-white leading-none mt-0.5">New York 10001</span>
                </div>
            </div>

            <!-- Enhanced Search -->
            <div
                class="flex-grow flex h-10 rounded-md overflow-hidden ring-2 ring-transparent focus-within:ring-[#fa8900] transition-shadow duration-200 mx-2">
                <div class="relative group">
                    <select
                        class="h-full bg-slate-100 text-slate-600 text-xs px-3 pr-6 border-r border-slate-300 focus:outline-none cursor-pointer hover:bg-slate-200 hover:text-slate-900 transition-colors appearance-none text-center min-w-[60px]">
                        <option>All</option>
                        <option>Electronics</option>
                        <option>Home</option>
                        <option>Fashion</option>
                    </select>
                    <div class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                        <svg class="w-2.5 h-2.5 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </div>
                </div>

                <input type="text" placeholder="Search Amazon Pro"
                    class="flex-grow px-4 text-slate-900 bg-white placeholder:text-slate-500 focus:outline-none text-sm font-medium">

                <button
                    class="bg-[#febd69] hover:bg-[#fa8900] text-[#131921] px-6 transition-colors duration-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <!-- Language (Simulated) -->
            <div
                class="hidden md:flex items-center gap-1 p-2 border border-transparent hover:border-white rounded-sm cursor-pointer min-w-[60px]">
                <img src="https://flagcdn.com/w20/us.png" alt="US" class="w-5 h-3.5 object-cover">
                <span class="font-bold text-sm">EN</span>
                <svg class="w-2.5 h-2.5 fill-slate-300" viewBox="0 0 20 20">
                    <path
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
            </div>

            <!-- Navigation Links -->
            @auth
                <a href="{{ route('dashboard') }}"
                    class="hidden md:flex flex-col justify-center px-2 py-1 border border-transparent hover:border-white rounded-sm cursor-pointer leading-tight min-w-[124px] relative group">
                    <span class="text-[12px] text-slate-300 block h-3.5 leading-tight">Hello,
                        {{ Auth::user()->name }}</span>
                    <div class="flex items-center gap-0.5">
                        <span class="font-bold text-sm leading-tight">Account & Lists</span>
                        <svg class="w-2.5 h-2.5 fill-slate-300 text-slate-400 mt-1" viewBox="0 0 20 20">
                            <path
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="hidden md:flex flex-col justify-center px-2 py-1 border border-transparent hover:border-white rounded-sm cursor-pointer leading-tight min-w-[124px] relative group">
                    <span class="text-[12px] text-slate-300 block h-3.5 leading-tight">Hello, sign in</span>
                    <div class="flex items-center gap-0.5">
                        <span class="font-bold text-sm leading-tight">Account & Lists</span>
                        <svg class="w-2.5 h-2.5 fill-slate-300 text-slate-400 mt-1" viewBox="0 0 20 20">
                            <path
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </div>
                </a>
            @endauth

            <div
                class="hidden md:flex flex-col justify-center px-2 py-1 border border-transparent hover:border-white rounded-sm cursor-pointer leading-tight min-w-[75px]">
                <span class="text-[12px] text-slate-300 block h-3.5 leading-tight">Returns</span>
                <span class="font-bold text-sm leading-tight">& Orders</span>
            </div>

            <!-- Cart -->
            <a href="/cart"
                class="flex items-end px-2 py-1 border border-transparent hover:border-white rounded-sm transition-all gap-1 min-w-[80px] relative">
                <div class="relative flex items-end">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <!-- Cart Count centered above the cart basket -->
                    <span
                        class="absolute -top-0.5 left-[17px] -translate-x-1/2 text-[#f08804] font-bold text-[16px] leading-none">{{ $cartCount }}</span>
                </div>
                <span class="font-bold text-sm mb-1 hidden sm:block">Cart</span>
            </a>
        </div>

        <!-- Sub Navigation -->
        <div
            class="bg-[#19212c] flex items-center gap-1 py-1 px-4 text-sm font-medium overflow-x-auto whitespace-nowrap custom-scrollbar">
            <button
                class="flex items-center gap-1 p-1 px-2 border border-transparent hover:border-white rounded-sm font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                All
            </button>
            <a href="{{ route('orders.index') }}"
                class="p-1 px-3 border border-transparent hover:border-white rounded-sm transition-colors">Orders</a>
            <a href="#"
                class="p-1 px-3 border border-transparent hover:border-white rounded-sm transition-colors">History</a>
            <a href="#"
                class="p-1 px-3 border border-transparent hover:border-white rounded-sm transition-colors">Payments</a>
            <a href="#"
                class="p-1 px-3 border border-transparent hover:border-white rounded-sm transition-colors">Customer
                Service</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                    @csrf
                    <button type="submit"
                        class="p-1 px-3 border border-transparent hover:border-white rounded-sm transition-colors">Logout</button>
                </form>
            @endauth
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-[#232f3e] text-white border-t border-slate-700">
        <!-- Back to top -->
        <a href="#"
            class="block text-center py-4 bg-[#37475a] hover:bg-[#485769] transition-colors text-sm font-medium tracking-wide">
            Back to top
        </a>

        <!-- Footer Links -->
        <div class="max-w-[1000px] mx-auto grid grid-cols-2 md:grid-cols-4 gap-x-12 gap-y-10 py-12 px-6">
            <div class="flex flex-col gap-3">
                <h4 class="font-bold text-base text-white">Get to Know Us</h4>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li><a href="#" class="hover:underline">Careers</a></li>
                    <li><a href="#" class="hover:underline">Blog</a></li>
                    <li><a href="#" class="hover:underline">About Amazon</a></li>
                    <li><a href="#" class="hover:underline">Investor Relations</a></li>
                    <li><a href="#" class="hover:underline">Amazon Devices</a></li>
                </ul>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-bold text-base text-white">Make Money with Us</h4>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li><a href="#" class="hover:underline">Sell products on Amazon</a></li>
                    <li><a href="#" class="hover:underline">Sell on Amazon Business</a></li>
                    <li><a href="#" class="hover:underline">Sell apps on Amazon</a></li>
                    <li><a href="#" class="hover:underline">Become an Affiliate</a></li>
                    <li><a href="#" class="hover:underline">Advertise Your Products</a></li>
                </ul>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-bold text-base text-white">Amazon Payment Products</h4>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li><a href="#" class="hover:underline">Amazon Business Card</a></li>
                    <li><a href="#" class="hover:underline">Shop with Points</a></li>
                    <li><a href="#" class="hover:underline">Reload Your Balance</a></li>
                    <li><a href="#" class="hover:underline">Amazon Currency Converter</a></li>
                </ul>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-bold text-base text-white">Let Us Help You</h4>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li><a href="#" class="hover:underline">Your Account</a></li>
                    <li><a href="#" class="hover:underline">Your Orders</a></li>
                    <li><a href="#" class="hover:underline">Shipping Rates & Policies</a></li>
                    <li><a href="#" class="hover:underline">Returns & Replacements</a></li>
                    <li><a href="#" class="hover:underline">Manage Your Content and Devices</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-700/50 py-10 flex flex-col items-center gap-6 bg-[#131921]">
            <div class="text-2xl font-bold italic tracking-tighter flex items-baseline gap-1">
                <span>amazon</span><span class="text-[#ff9900] text-sm not-italic">.pro</span>
            </div>

            <div class="flex flex-wrap justify-center gap-1 sm:gap-6 px-4">
                <button
                    class="border border-slate-500 rounded px-4 py-1.5 text-xs text-slate-300 hover:border-slate-300">English</button>
                <button
                    class="border border-slate-500 rounded px-4 py-1.5 text-xs text-slate-300 hover:border-slate-300">$
                    USD - U.S. Dollar</button>
                <button
                    class="border border-slate-500 rounded px-4 py-1.5 text-xs text-slate-300 hover:border-slate-300 flex items-center gap-2">
                    <img src="https://flagcdn.com/w20/us.png" class="w-4" alt=""> United States
                </button>
            </div>

            <div class="flex flex-wrap justify-center gap-4 text-xs text-slate-400 mt-4">
                <a href="#" class="hover:underline">Conditions of Use</a>
                <a href="#" class="hover:underline">Privacy Notice</a>
                <a href="#" class="hover:underline">Consumer Health Data Privacy Disclosure</a>
                <a href="#" class="hover:underline">Your Ads Privacy Choices</a>
            </div>
            <p class="text-[10px] text-slate-500">© 1996-2026, Amazon.com, Inc. or its affiliates</p>
        </div>
    </footer>

    @stack('scripts')
    @livewireScripts
</body>

</html>