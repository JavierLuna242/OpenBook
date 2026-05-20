<x-app-layout>
    @auth
        <script>
            window.location.href = "{{ route('dashboard.student') }}";
        </script>
    @endauth

    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-surface">
        <div
            class="max-w-5xl w-full grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl bg-white">
            <!-- Left Side: Brand/Info -->
            <div class="hidden lg:flex flex-col justify-center p-12 bg-primary-container text-white relative">
                <div class="relative z-10 text-white">
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

                    <div>
                        <h2 class="text-4xl font-extrabold mb-6 leading-tight">
                            {{ __('messages.register_student_portal_headline') }}</h2>
                        <p class="text-lg text-white/90 mb-8 leading-relaxed">
                            {{ __('messages.register_student_portal_desc') }}
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div
                                class="flex-shrink-0 w-6 h-6 bg-white/10 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                                    </path>
                                </svg>
                            </div>
                            <p class="font-medium">{{ __('messages.register_student_promo_1') }}</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Student Form -->
            <div class="p-8 sm:p-12">
                <div class="mb-8">
                    <div
                        class="flex items-center space-x-2 text-primary-container font-bold text-xs uppercase tracking-widest mb-2">
                        <span>{{ __('messages.register_portal_student') }}</span>
                        <span>•</span>
                        <a href="{{ route('register') }}"
                            class="hover:underline text-on-surface-variant font-medium normal-case tracking-normal">{{ __('messages.register_change_portal') }}</a>
                    </div>
                    <h3 class="text-2xl font-bold text-on-surface mb-2">{{ __('messages.register_student_title') }}</h3>
                    <p class="text-on-surface-variant">{{ __('messages.register_student_desc') }}</p>
                </div>

                <form action="{{ route('register.student') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6" novalidate>
                    @csrf
                    <!-- Global Fields -->
                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold text-on-surface mb-2 tracking-widest uppercase">{{ __('messages.register_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full bg-surface-container-high border-b-2 @error('name') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                            placeholder="{{ __('messages.register_placeholder_name') }}">
                        @error('name')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold text-on-surface mb-2 tracking-widest uppercase">{{ __('messages.register_email') }}
                            (@unab.edu.co)</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-surface-container-high border-b-2 @error('email') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                            placeholder="{{ __('messages.register_placeholder_email') }}">
                        @error('email')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-bold text-on-surface mb-2 tracking-widest uppercase">{{ __('messages.register_program') }}</label>
                        <input type="text" name="program" value="{{ old('program') }}"
                            class="w-full bg-surface-container-high border-b-2 @error('program') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                            placeholder="{{ __('messages.register_placeholder_program') }}">
                        @error('program')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-bold text-on-surface mb-2 tracking-widest uppercase">{{ __('messages.register_student_id') }}
                            (U00XXXXXX)</label>
                        <input type="text" name="student_id" value="{{ old('student_id') }}"
                            class="w-full bg-surface-container-high border-b-2 @error('student_id') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                            placeholder="{{ __('messages.register_placeholder_student_id') }}">
                        @error('student_id')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1" x-data="{ show: false }">
                        <label
                            class="block text-xs font-bold text-on-surface mb-2 tracking-widest uppercase">{{ __('messages.register_password') }}</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password"
                                class="w-full bg-surface-container-high border-b-2 @error('password') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg pr-10"
                                placeholder="{{ __('messages.register_placeholder_password') }}">
                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.594-4.894M8.823 8.823l1.177 1.177M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2.225 3.225l1.177 1.177M15 15l6 6M3 3l6 6">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1" x-data="{ show: false }">
                        <label
                            class="block text-xs font-bold text-on-surface mb-2 tracking-widest uppercase">{{ __('messages.register_confirm') }}</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation"
                                class="w-full bg-surface-container-high border-b-2 focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg pr-10"
                                placeholder="{{ __('messages.register_placeholder_confirm') }}">
                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.594-4.894M8.823 8.823l1.177 1.177M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2.225 3.225l1.177 1.177M15 15l6 6M3 3l6 6">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <button type="submit" class="btn-prestige w-full py-4 text-lg">
                            {{ __('messages.register_student_button') }}
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-on-surface-variant text-sm">
                        {{ __('messages.register_have_account') }}
                        <a href="{{ route('login') }}"
                            class="font-bold text-primary-container hover:text-secondary transition-colors">{{ __('messages.register_login') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
