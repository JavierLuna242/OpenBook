<x-app-layout>
    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-surface">
        <div class="max-w-4xl w-full grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl bg-white">
            <!-- Left Side: Brand/Info -->
            <div class="hidden lg:flex flex-col justify-center p-12 bg-primary-container text-white relative">
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center space-x-4 mb-10 group text-white decoration-none">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md transition-all group-hover:bg-white/30">
                            <span class="text-3xl font-bold">O</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-3xl font-extrabold tracking-tight text-white leading-none">Open<span class="text-white/80">Book</span></span>
                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-white/60 mt-1">La Academia Digital</span>
                        </div>
                    </a>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight">{{ __('messages.reset_brand_title') }}</h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        {{ __('messages.reset_brand_desc') }}
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <span class="font-medium">{{ __('messages.reset_feature_1') }}</span>
                        </div>
                    </div>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-10">
                    <h3 class="text-2xl font-bold text-on-surface mb-2">{{ __('messages.reset_title') }}</h3>
                    <p class="text-on-surface-variant">{{ __('messages.reset_subtitle') }}</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">{{ __('messages.reset_new_pass') }}</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" 
                                   class="w-full bg-surface-container-high border-b-2 @error('password') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg pr-12"
                                   placeholder="••••••••">
                            <button type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors focus:outline-none cursor-pointer p-1">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.594-4.894M8.823 8.823l1.177 1.177M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2.225 3.225l1.177 1.177M15 15l6 6M3 3l6 6"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ showConfirm: false }">
                        <label for="password_confirmation" class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">{{ __('messages.reset_confirm') }}</label>
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" 
                                   class="w-full bg-surface-container-high border-b-2 border-transparent focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg pr-12"
                                   placeholder="••••••••">
                            <button type="button" 
                                    @click="showConfirm = !showConfirm" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors focus:outline-none cursor-pointer p-1">
                                <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg x-show="showConfirm" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.594-4.894M8.823 8.823l1.177 1.177M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2.225 3.225l1.177 1.177M15 15l6 6M3 3l6 6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-prestige w-full py-4 text-lg">
                        {{ __('messages.reset_btn') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
