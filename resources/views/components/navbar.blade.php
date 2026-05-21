@props(['showSidebarToggleOnDesktop' => false])
@php
    $isTutorMode = request()->routeIs('dashboard.tutor*');
    $user = auth()->user();
@endphp

<nav class="fixed top-0 left-0 right-0 z-[60] bg-white/80 backdrop-blur-xl border-b border-outline-variant/15"
    x-data="{ mobileOpen: false, userDropdownOpen: false, mobileLangOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <!-- Left Side: Brand Logo -->
            <div class="flex items-center space-x-8 flex-shrink-0">
                <a href="/" class="flex items-center space-x-3 group">
                    <div
                        class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center flex-shrink-0 shadow-md shadow-primary/20 group-hover:scale-105 transition-transform">
                        <span class="text-white font-bold text-xl font-display">O</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold tracking-tight text-on-surface leading-none">Open<span
                                class="text-primary">Book</span></span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-primary/80 mt-0.5">La Academia
                            Digital</span>
                    </div>
                </a>

                <!-- Desktop Active Mode Links -->
                @auth
                    <div class="hidden lg:flex items-center space-x-1">
                        @if ($isTutorMode)
                            <!-- Tutor Navigation Links -->
                            <a href="{{ route('dashboard.tutor') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.tutor') && !request()->routeIs('dashboard.tutor.post') && !request()->routeIs('dashboard.tutor.history') && !request()->routeIs('dashboard.tutor.profile') && !request()->routeIs('dashboard.tutor.materials*') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_resumen') }}
                            </a>
                            <a href="{{ route('dashboard.tutor.post') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.tutor.post') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_offer') }}
                            </a>
                            <a href="{{ route('dashboard.tutor.materials') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.tutor.materials*') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_material') }}
                            </a>
                            <a href="{{ route('dashboard.tutor.history') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.tutor.history') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_historial') }}
                            </a>
                        @else
                            <!-- Student Navigation Links -->
                            <a href="{{ route('dashboard.student') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.student') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_resumen') }}
                            </a>
                            <a href="{{ route('dashboard.search') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.search') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_buscar') }}
                            </a>
                            <a href="{{ route('dashboard.history') }}"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard.history') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                                {{ __('messages.sidebar_historial') }}
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Right Side Actions & Dropdowns -->
            <div class="hidden lg:flex items-center space-x-4">

                @auth
                    <!-- Profile Role Badge -->
                    @if (Auth::user()->role === 'tutor')
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-teal-500/10 text-teal-600 text-xs font-bold rounded-full border border-teal-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            Mentor
                        </div>
                    @else
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary text-xs font-bold rounded-full border border-primary/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Estudiante
                        </div>
                    @endif
                @endauth

                <!-- Language Switcher -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center space-x-1.5 text-on-surface-variant hover:text-on-surface text-xs font-bold uppercase tracking-wider transition-colors px-3.5 py-2 rounded-xl hover:bg-surface-container border border-outline-variant/15 bg-white shadow-sm">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                        <svg class="w-3 h-3 text-on-surface-variant transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute right-0 mt-2 w-44 bg-white rounded-2xl shadow-xl border border-outline-variant/20 overflow-hidden z-50"
                        style="display: none;">
                        @foreach (['es' => 'Español', 'en' => 'English', 'fr' => 'Français', 'pt' => 'Português'] as $locale => $label)
                            <form method="POST" action="{{ route('language.switch', $locale) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm font-semibold text-on-surface hover:bg-surface-container transition-colors flex items-center space-x-2 {{ app()->getLocale() === $locale ? 'bg-primary/5 font-bold text-primary' : '' }}">
                                    {{ $label }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>

                @auth
                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false"
                            class="flex items-center space-x-2 p-1 bg-surface-container rounded-full hover:bg-surface-container-high transition-all border border-outline-variant/20">
                            <div
                                class="w-8 h-8 rounded-full overflow-hidden bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                @if ($user->profile_photo_path)
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-on-surface-variant pr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profile Dropdown Content -->
                        <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute right-0 mt-3 w-64 bg-white rounded-3xl shadow-2xl border border-outline-variant/25 py-4 overflow-hidden z-50"
                            style="display: none;">

                            <div class="px-5 py-3 border-b border-outline-variant/15 flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full overflow-hidden bg-primary/10 flex items-center justify-center text-primary font-bold">
                                    @if ($user->profile_photo_path)
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="text-sm font-bold text-on-surface truncate">{{ $user->name }}</h4>
                                    <p class="text-[10px] text-on-surface-variant font-mono truncate">
                                        {{ $isTutorMode ? __('messages.nav_cedula_label') : 'ID:' }}
                                        {{ $isTutorMode ? $user->cedula ?? $user->id : $user->student_id ?? $user->id }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ $isTutorMode ? route('dashboard.tutor.profile') : route('dashboard.profile') }}"
                                class="flex items-center space-x-3 px-5 py-3 text-sm font-semibold text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ __('messages.sidebar_perfil') }}</span>
                            </a>

                            <div class="border-t border-outline-variant/15 mt-2 pt-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center space-x-3 px-5 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors text-left">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        <span>{{ __('messages.sidebar_logout') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-on-surface-variant hover:text-primary transition-colors px-4 py-2">{{ __('messages.nav_access') }}</a>
                    <a href="{{ route('register') }}"
                        class="btn-prestige text-sm px-6 py-2.5 shadow-md shadow-primary/10">{{ __('messages.welcome_btn_tutor') }}</a>
                @endauth
            </div>

            <!-- Hamburger Button (Mobile & Tablet) -->
            <div class="lg:hidden flex items-center space-x-3">

                @auth
                    <!-- Fast Mode Switcher for mobile -->
                    @if ($isTutorMode)
                        <a href="{{ route('dashboard.student') }}"
                            class="w-8 h-8 rounded-full bg-secondary/15 flex items-center justify-center text-secondary border border-secondary/20 transition-all">
                            <span class="w-2.5 h-2.5 rounded-full bg-secondary animate-pulse"></span>
                        </a>
                    @else
                        <a href="{{ route('dashboard.tutor') }}"
                            class="w-8 h-8 rounded-full bg-primary/15 flex items-center justify-center text-primary border border-primary/20 transition-all">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary animate-pulse"></span>
                        </a>
                    @endif
                @endauth

                <!-- Mobile language button (separate from hamburger drawer) -->
                <div class="relative" @click.away="mobileLangOpen = false">
                    <button @click="mobileLangOpen = !mobileLangOpen"
                        class="p-2.5 text-on-surface-variant hover:text-on-surface hover:bg-surface-container rounded-xl transition-all border border-outline-variant/15 flex items-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10" />
                        </svg>
                    </button>

                    <div x-show="mobileLangOpen" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute right-0 mt-2 w-40 bg-white rounded-2xl shadow-xl border border-outline-variant/20 overflow-hidden z-50"
                        style="display: none;">
                        @foreach (['es' => 'Español', 'en' => 'English', 'fr' => 'Français', 'pt' => 'Português'] as $locale => $label)
                            <form method="POST" action="{{ route('language.switch', $locale) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm font-semibold text-on-surface hover:bg-surface-container transition-colors {{ app()->getLocale() === $locale ? 'bg-primary/5 font-bold text-primary' : '' }}">
                                    {{ $label }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>

                <button @click="mobileOpen = !mobileOpen"
                    class="p-2.5 text-on-surface-variant hover:text-on-surface hover:bg-surface-container rounded-xl transition-all border border-outline-variant/15">
                    <svg class="w-6 h-6" :class="mobileOpen ? 'hidden' : 'block'" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="w-6 h-6" :class="mobileOpen ? 'block' : 'hidden'" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer / Panel -->
    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-outline-variant/20 shadow-2xl py-6 px-6 space-y-6 z-50"
        style="display: none;">

        @auth
            <!-- Logged In Mobile Links -->
            <div
                class="flex items-center space-x-3 p-4 bg-surface-container/50 rounded-2xl border border-outline-variant/15 mb-4">
                <div
                    class="w-12 h-12 rounded-xl overflow-hidden bg-primary/10 flex items-center justify-center text-primary font-extrabold text-lg">
                    @if ($user->profile_photo_path)
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <h4 class="font-extrabold text-on-surface">{{ $user->name }}</h4>
                    <p class="text-xs text-on-surface-variant font-mono">
                        {{ $isTutorMode ? __('messages.nav_cedula_label') : 'ID:' }}
                        {{ $isTutorMode ? $user->cedula ?? $user->id : $user->student_id ?? $user->id }}</p>
                </div>
            </div>

            <div class="space-y-2">
                @if ($isTutorMode)
                    <div class="px-2 py-1 text-[10px] font-black uppercase tracking-widest text-primary/80 mb-2">Panel de
                        Tutor</div>
                    <a href="{{ route('dashboard.tutor') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.tutor') && !request()->routeIs('dashboard.tutor.post') && !request()->routeIs('dashboard.tutor.history') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_resumen') }}</span>
                    </a>
                    <a href="{{ route('dashboard.tutor.post') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.tutor.post') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_offer') }}</span>
                    </a>
                    <a href="{{ route('dashboard.tutor.materials') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.tutor.materials*') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_material') }}</span>
                    </a>
                    <a href="{{ route('dashboard.tutor.history') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.tutor.history') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_historial') }}</span>
                    </a>
                    <a href="{{ route('dashboard.tutor.profile') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.tutor.profile') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_perfil') }}</span>
                    </a>
                @else
                    <div class="px-2 py-1 text-[10px] font-black uppercase tracking-widest text-secondary/80 mb-2">Panel de
                        Estudiante</div>
                    <a href="{{ route('dashboard.student') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.student') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_resumen') }}</span>
                    </a>
                    <a href="{{ route('dashboard.search') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.search') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_buscar') }}</span>
                    </a>
                    <a href="{{ route('dashboard.history') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.history') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_historial') }}</span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-on-surface hover:bg-surface-container {{ request()->routeIs('dashboard.profile') ? 'bg-primary/5 text-primary' : '' }}">
                        <span>{{ __('messages.sidebar_perfil') }}</span>
                    </a>
                @endif
            </div>

            <!-- Logout mobile button -->
            <div class="pt-6 border-t border-outline-variant/15 mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center items-center gap-2 py-3 bg-red-50 text-red-600 font-bold rounded-xl text-sm transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        {{ __('messages.sidebar_logout') }}
                    </button>
                </form>
            </div>
        @else
            <!-- Public Mobile Links -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('login') }}"
                    class="w-full text-center py-3 font-bold text-on-surface hover:bg-surface-container rounded-xl transition-all">{{ __('messages.nav_access') }}</a>
                <a href="{{ route('register') }}"
                    class="w-full text-center py-3 font-bold bg-primary text-white hover:bg-primary-dark rounded-xl shadow-md transition-all">{{ __('messages.welcome_btn_tutor') }}</a>
            </div>
        @endauth


    </div>
</nav>
<div class="h-20"></div> <!-- Spacer for fixed nav -->
