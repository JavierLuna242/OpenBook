<x-app-layout>
    @auth
        <script>
            window.location.href = "{{ route('dashboard.tutor') }}";
        </script>
    @endauth

    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-surface">
        <div
            class="max-w-4xl w-full grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl bg-white">
            <!-- Left Side: Brand/Info -->
            <div class="hidden lg:flex flex-col justify-center p-12 bg-teal-600 text-white relative">
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center space-x-4 mb-10 group">
                        <div
                            class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md transition-all group-hover:bg-white/30">
                            <span class="text-3xl font-bold">O</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-3xl font-extrabold tracking-tight text-white leading-none">Open<span
                                    class="text-white/80">Book</span></span>
                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-white/60 mt-1">La Academia
                                Digital</span>
                        </div>
                    </a>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight">
                        {{ __('messages.login_tutor_portal_headline') }}</h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        {{ __('messages.login_tutor_portal_desc') }}
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Define tu propia disponibilidad</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Destaca como líder y mentor</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Tutor Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-10">
                    <div
                        class="flex items-center space-x-2 text-teal-600 font-bold text-xs uppercase tracking-widest mb-2">
                        <span>{{ __('messages.login_portal_tutor') }}</span>
                        <span>•</span>
                        <a href="{{ route('login') }}"
                            class="hover:underline text-on-surface-variant font-medium normal-case tracking-normal">{{ __('messages.login_change_portal') }}</a>
                    </div>
                    <h3 class="text-2xl font-bold text-on-surface mb-2">{{ __('messages.login_tutor_title') }}</h3>
                    <p class="text-on-surface-variant">{{ __('messages.login_tutor_desc') }}</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-teal-500 text-white rounded-xl text-sm font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.tutor') }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    <div>
                        <label for="email"
                            class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">{{ __('messages.login_email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-surface-container-high border-b-2 border-transparent focus:border-teal-600 px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                            placeholder="{{ __('messages.login_placeholder_email') }}">
                    </div>

                    <div x-data="{ showPassword: false }">
                        <div class="flex justify-between mb-2">
                            <label for="password"
                                class="block text-sm font-bold text-on-surface tracking-tight uppercase">{{ __('messages.login_password') }}</label>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-bold text-teal-600 hover:text-teal-700 transition-colors">{{ __('messages.login_forgot') }}</a>
                        </div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                class="w-full bg-surface-container-high border-b-2 border-transparent focus:border-teal-600 px-4 py-3 outline-none transition-all duration-300 rounded-t-lg pr-12"
                                placeholder="{{ __('messages.login_placeholder_password') }}">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-teal-600 transition-colors focus:outline-none cursor-pointer p-1">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.594-4.894M8.823 8.823l1.177 1.177M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2.225 3.225l1.177 1.177M15 15l6 6M3 3l6 6">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-outline-variant rounded">
                        <label for="remember-me"
                            class="ml-2 block text-sm text-on-surface-variant">{{ __('messages.login_remember') }}</label>
                    </div>

                    <button type="submit"
                        class="w-full py-4 text-lg bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 cursor-pointer">
                        {{ __('messages.login_tutor_button') }}
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-on-surface-variant text-sm">
                        {{ __('messages.login_no_account') }}
                        <a href="{{ route('register.tutor') }}"
                            class="font-bold text-teal-600 hover:text-teal-700 transition-colors">{{ __('messages.login_register_tutor') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
