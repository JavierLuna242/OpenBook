<x-app-layout>
    @auth
        <script>window.location.href = "{{ route('dashboard.student') }}";</script>
    @endauth

    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-surface">
        <div class="max-w-4xl w-full grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl bg-white">
            <!-- Left Side: Brand/Info -->
            <div class="hidden lg:flex flex-col justify-center p-12 bg-primary-container text-white relative">
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center space-x-4 mb-10 group">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md transition-all group-hover:bg-white/30">
                            <span class="text-3xl font-bold">O</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-3xl font-extrabold tracking-tight text-white leading-none">Open<span class="text-white/80">Book</span></span>
                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-white/60 mt-1">La Academia Digital</span>
                        </div>
                    </a>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight">Accede a tus Tutorías Académicas</h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        Conéctate con mentores especializados de la UNAB de forma 100% gratuita y colaborativa.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <span class="font-medium">Agenda clases en segundos</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="font-medium">Comunidad 100% libre y sin pagos</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Student Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-10">
                    <div class="flex items-center space-x-2 text-primary-container font-bold text-xs uppercase tracking-widest mb-2">
                        <span>Portal Estudiantes</span>
                        <span>•</span>
                        <a href="{{ route('login') }}" class="hover:underline text-on-surface-variant font-medium normal-case tracking-normal">Cambiar portal</a>
                    </div>
                    <h3 class="text-2xl font-bold text-on-surface mb-2">¡Hola de nuevo!</h3>
                    <p class="text-on-surface-variant">Inicia sesión para continuar aprendiendo.</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-500 text-white rounded-xl text-sm font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.student') }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">Correo Institucional</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="w-full bg-surface-container-high border-b-2 border-transparent focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg"
                               placeholder="usuario@unab.edu.co">
                    </div>

                    <div x-data="{ showPassword: false }">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-on-surface tracking-tight uppercase">Contraseña</label>
                            <a href="{{ route('password.request') }}" class="text-sm font-bold text-primary-container hover:text-secondary transition-colors">¿La olvidaste?</a>
                        </div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" 
                                   class="w-full bg-surface-container-high border-b-2 border-transparent focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg pr-12"
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
                    </div>

                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary-container focus:ring-primary-container border-outline-variant rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-on-surface-variant">Recordarme en este dispositivo</label>
                    </div>

                    <button type="submit" class="btn-prestige w-full py-4 text-lg">
                        Ingresar
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-on-surface-variant text-sm">
                        ¿No tienes una cuenta aún? 
                        <a href="{{ route('register') }}" class="font-bold text-primary-container hover:text-secondary transition-colors">Regístrate como Estudiante</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
