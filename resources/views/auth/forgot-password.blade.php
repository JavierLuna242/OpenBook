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
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight">{{ __('messages.forgot_brand_title') }}</h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        {{ __('messages.forgot_brand_desc') }}
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium">{{ __('messages.forgot_feature_1') }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <span class="font-medium">{{ __('messages.forgot_feature_2') }}</span>
                        </div>
                    </div>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-10">
                    <h3 class="text-2xl font-bold text-on-surface mb-2">{{ __('messages.forgot_title') }}</h3>
                    <p class="text-on-surface-variant">{{ __('messages.forgot_subtitle') }}</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-primary-container text-white rounded-xl text-sm font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">{{ __('messages.forgot_email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="w-full bg-surface-container-high border-b-2 @error('email') border-error @else border-transparent @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                               placeholder="usuario@unab.edu.co">
                        @error('email')
                            <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-prestige w-full py-4 text-lg">
                        {{ __('messages.forgot_btn') }}
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-on-surface-variant">
                        {{ __('messages.forgot_remember') }} 
                        <a href="{{ route('login') }}" class="font-bold text-primary-container hover:text-secondary transition-colors">{{ __('messages.forgot_back') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
