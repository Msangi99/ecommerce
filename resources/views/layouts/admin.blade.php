<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style type="text/css">
        @theme {
            --color-brand-black: #232f3e;
            --color-brand-orange: #fa8900;
            --font-sans: "Inter", ui-sans-serif, system-ui, sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased text-slate-600 bg-slate-50 h-full flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex-shrink-0 flex flex-col h-full overflow-y-auto">
        <!-- Logo / Brand -->
        <div class="h-16 flex items-center px-6 border-b border-slate-100">
            <span class="text-xl font-bold tracking-tight text-[#232f3e]">amazon<span
                    class="text-[#fa8900]">.pro</span></span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-6">

            <!-- Dashboard Section -->
            <div>
                <h3 class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Dashboard</h3>
                <div class="space-y-1">
                    <a href="#"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Business Analytics
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Overview
                    </a>
                </div>
            </div>

            <!-- Management Section -->
            <div>
                <h3 class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Management</h3>
                <div class="space-y-1">

                    <!-- Products -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Products
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pl-10 space-y-1 mt-1 border-l-2 border-slate-100 ml-4">
                            <a href="{{ route('admin.products.index') }}"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">All Products</a>
                            <a href="{{ route('admin.products.create') }}"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Add Product</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Categories</a>
                            <a href="{{ route('admin.products.index') }}"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Stock</a>
                            <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Low
                                Stock</a>
                        </div>
                    </div>

                    <!-- Orders -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Orders
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pl-10 space-y-1 mt-1 border-l-2 border-slate-100 ml-4">
                            <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">All
                                Orders</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Pending</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Processing</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Completed</a>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Customers
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pl-10 space-y-1 mt-1 border-l-2 border-slate-100 ml-4">
                            <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">All
                                Customers</a>
                            <a href="{{ route('admin.dealers.index') }}"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Dealers /
                                Approvals</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Retailers</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Requests</a>
                        </div>
                    </div>

                    <!-- Staff -->
                    <a href="#"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Staff
                    </a>

                </div>
            </div>

            <!-- Operations Section -->
            <div>
                <h3 class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Operations</h3>
                <div class="space-y-1">
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Inventory
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Payments
                    </a>

                    <!-- Reports -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Reports
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pl-10 space-y-1 mt-1 border-l-2 border-slate-100 ml-4">
                            <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Sales</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Traffic</a>
                            <a href="#"
                                class="block px-2 py-1.5 text-sm text-slate-600 hover:text-slate-900">Returns</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div>
                <h3 class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Settings</h3>
                <div class="space-y-1">
                    <a href="#"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        General
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-slate-700 rounded-md hover:bg-slate-50 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Store Settings
                    </a>
                </div>
            </div>
        </nav>

        <!-- User Profile (Bottom) -->
        <div class="p-4 border-t border-slate-200 mt-auto" x-data="{ open: false }">
            <div class="relative">
                <button @click="open = !open" class="w-full flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <p class="text-sm font-medium text-slate-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-transform"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute bottom-full left-0 w-full mb-2 bg-white rounded-md shadow-lg border border-slate-200 py-1 z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-red-600 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 h-full overflow-y-auto bg-slate-50">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>

</html>