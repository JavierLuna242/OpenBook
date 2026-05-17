<x-app-layout>
    @auth
        <script>window.location.href = "{{ route('dashboard.student') }}";</script>
    @endauth

    <script>
        // Prevent back-button cache issue (bfcache)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>

    <style>
        /* Custom elite design elements for welcome page */
        .animate-blob {
            animation: blob 10s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2.5s;
        }
        .animation-delay-4000 {
            animation-delay: 5s;
        }
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(40px, -60px) scale(1.15);
            }
            66% {
                transform: translate(-30px, 30px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        .welcome-gradient-text {
            background: linear-gradient(135deg, #2563EB 0%, #1E40AF 50%, #14B8A6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glow-hover:hover {
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.15);
            border-color: rgba(20, 184, 166, 0.4);
        }
    </style>

    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-28 pb-36 bg-gradient-to-b from-surface via-surface to-surface-container/20">
        <!-- Floating Animated Glowing Blobs in background -->
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-primary/10 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob"></div>
        <div class="absolute top-1/3 -right-20 w-96 h-96 bg-secondary/15 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-10 left-1/3 w-96 h-96 bg-primary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-4000"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                
                <!-- Left: Branding & Core Headline -->
                <div class="sm:text-center md:max-w-3xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 border border-primary/20 mb-8 hover:bg-primary/10 transition-colors">
                        <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">{{ __('messages.welcome_badge') }}</span>
                    </div>
                    
                    <h1 class="text-5xl md:text-7xl font-extrabold text-on-surface leading-tight tracking-tight mb-8">
                        {{ __('messages.welcome_hero_h1') }} 
                        <span class="welcome-gradient-text">{{ __('messages.welcome_hero_highlight') }}</span> 
                        {{ __('messages.welcome_hero_h1_end') }}
                    </h1>
                    
                    <p class="text-lg md:text-xl text-on-surface-variant leading-relaxed mb-12 max-w-xl">
                        {{ __('messages.welcome_hero_desc') }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="btn-prestige text-lg px-10 py-4.5 shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/35 transform hover:-translate-y-0.5 transition-all">
                            {{ __('messages.welcome_btn_search') }}
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4.5 text-lg font-bold text-on-surface hover:text-primary transition-all group">
                            {{ __('messages.welcome_btn_tutor') }}
                            <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Premium Avatar Stack & Stats -->
                    <div class="mt-16 flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <div class="flex -space-x-3">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=85" alt="Student" class="w-12 h-12 rounded-full border-3 border-surface object-cover">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=85" alt="Student" class="w-12 h-12 rounded-full border-3 border-surface object-cover">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=85" alt="Student" class="w-12 h-12 rounded-full border-3 border-surface object-cover">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=85" alt="Student" class="w-12 h-12 rounded-full border-3 border-surface object-cover">
                        </div>
                        <div class="text-sm font-semibold text-on-surface-variant flex items-center gap-2">
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-success"></span>
                            </span>
                            <span>
                                <span class="text-on-surface font-black text-base">{{ __('messages.welcome_active_num') }}</span> {{ __('messages.welcome_active_count') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Interactive Premium UI Dashboard Simulation -->
                <div class="mt-20 sm:mt-24 lg:mt-0 lg:col-span-6 relative flex justify-center">
                    <div class="absolute -top-12 -left-12 w-64 h-64 bg-secondary/10 rounded-full filter blur-3xl opacity-60 animate-pulse"></div>
                    
                    <div class="w-full max-w-md bg-white/70 backdrop-blur-xl border border-outline-variant/30 rounded-[2.5rem] p-8 shadow-2xl relative">
                        <!-- Simulated Card Header -->
                        <div class="flex items-center justify-between mb-8 pb-6 border-b border-outline-variant/25">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <span class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-widest">OpenBook Session Desk</span>
                        </div>
                        
                        <!-- Simulated Live Session Offer Widget -->
                        <div class="space-y-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="px-3.5 py-1 rounded-full bg-success/15 text-success text-xs font-extrabold uppercase tracking-widest border border-success/20">
                                        100% {{ __('messages.price_free') }}
                                    </span>
                                    <h3 class="text-2xl font-bold text-on-surface mt-3">Calculo Integral</h3>
                                    <p class="text-primary font-medium text-sm">Ej. Integración por Partes & Sustitución</p>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80" alt="Tutor Laura" class="w-full h-full object-cover">
                                </div>
                            </div>
                            
                            <!-- Rating & Metadata -->
                            <div class="flex items-center gap-4 bg-surface-container/40 p-4 rounded-2xl border border-outline-variant/15">
                                <div class="flex-1">
                                    <span class="text-xs text-on-surface-variant/70 font-semibold block uppercase tracking-wider">Tutor Académico</span>
                                    <span class="font-bold text-on-surface text-base">Laura Sofia S.</span>
                                </div>
                                <div class="flex items-center gap-1 bg-white px-3 py-1 rounded-full shadow-sm text-sm font-bold text-yellow-500 border border-outline-variant/20">
                                    ★ 5.0
                                </div>
                            </div>

                            <!-- Availability Preview -->
                            <div class="space-y-3 pt-2">
                                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block">Disponibilidad Propuesta</span>
                                <div class="flex gap-2">
                                    <div class="px-4 py-2 bg-primary/5 text-primary text-xs font-bold rounded-xl border border-primary/10">Lunes (Mañana)</div>
                                    <div class="px-4 py-2 bg-primary/5 text-primary text-xs font-bold rounded-xl border border-primary/10">Miércoles (Tarde)</div>
                                </div>
                            </div>
                            
                            <!-- Book Call to Action Simulation -->
                            <div class="pt-4">
                                <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center gap-2.5 bg-primary text-white font-bold py-4 rounded-2xl hover:bg-primary-dark transition-all transform hover:scale-[1.02] shadow-md shadow-primary/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ __('messages.dash_schedule') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Features / Steps Section -->
    <section class="py-32 bg-surface-container-lowest relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-secondary/5 rounded-full filter blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24">
                <span class="text-sm font-extrabold text-primary uppercase tracking-widest mb-3 block">Simple & Rápido</span>
                <h2 class="text-4xl md:text-5xl font-black text-on-surface mb-8 tracking-tight">{{ __('messages.welcome_how_title') }}</h2>
                <p class="text-lg text-on-surface-variant leading-relaxed">
                    {{ __('messages.welcome_how_desc') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-surface-container/30 border border-outline-variant/10 rounded-[2rem] p-10 hover:border-primary/20 hover:bg-white transition-all duration-300 shadow-sm hover:shadow-xl group transform hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <span class="text-5xl font-extrabold text-on-surface-variant/15 group-hover:text-primary/20 transition-all font-display select-none">01</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-4 group-hover:text-primary transition-colors">{{ __('messages.welcome_step1_title') }}</h3>
                    <p class="text-on-surface-variant leading-relaxed text-sm">{{ __('messages.welcome_step1_desc') }}</p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-surface-container/30 border border-outline-variant/10 rounded-[2rem] p-10 hover:border-secondary/20 hover:bg-white transition-all duration-300 shadow-sm hover:shadow-xl group transform hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center group-hover:bg-secondary group-hover:text-white transition-all shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-5xl font-extrabold text-on-surface-variant/15 group-hover:text-secondary/20 transition-all font-display select-none">02</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-4 group-hover:text-secondary transition-colors">{{ __('messages.welcome_step2_title') }}</h3>
                    <p class="text-on-surface-variant leading-relaxed text-sm">{{ __('messages.welcome_step2_desc') }}</p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-surface-container/30 border border-outline-variant/10 rounded-[2rem] p-10 hover:border-primary/20 hover:bg-white transition-all duration-300 shadow-sm hover:shadow-xl group transform hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="text-5xl font-extrabold text-on-surface-variant/15 group-hover:text-primary/20 transition-all font-display select-none">03</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-4 group-hover:text-primary transition-colors">{{ __('messages.welcome_step3_title') }}</h3>
                    <p class="text-on-surface-variant leading-relaxed text-sm">{{ __('messages.welcome_step3_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Tutor Spotlight Spotlight Catalog -->
    <section class="py-32 bg-surface">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-sm font-extrabold text-primary uppercase tracking-widest mb-3 block">Excelencia Académica</span>
                <h2 class="text-4xl md:text-5xl font-black text-on-surface mb-6 tracking-tight">Tutores Destacados de OpenBook</h2>
                <p class="text-lg text-on-surface-variant leading-relaxed">
                    Aprende de estudiantes con rendimiento superior en las materias de mayor exigencia de la facultad.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tutor 1 -->
                <div class="bg-white border border-outline-variant/15 rounded-3xl p-8 hover:shadow-xl hover:border-primary/20 transition-all group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container-high overflow-hidden shadow-inner flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80" alt="Laura Sofia" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-on-surface group-hover:text-primary transition-colors">Laura Sofia S.</h3>
                            <p class="text-xs text-on-surface-variant font-medium">Ingeniería de Software</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-6">
                        <span class="px-3 py-1 rounded-full bg-primary/5 text-primary text-xs font-bold border border-primary/10">Cálculo Integral</span>
                        <span class="px-3 py-1 rounded-full bg-success/10 text-success text-xs font-bold border border-success/20">Gratis</span>
                    </div>

                    <p class="text-sm text-on-surface-variant leading-relaxed mb-8">
                        "¡Aprende integraciones en minutos de forma práctica! Simplifico la matemática para que superes tus exámenes sin estrés."
                    </p>

                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center py-3 bg-surface-container hover:bg-primary hover:text-white text-on-surface font-bold rounded-xl transition-all text-sm">
                        Agendar Tutoría
                    </a>
                </div>

                <!-- Tutor 2 -->
                <div class="bg-white border border-outline-variant/15 rounded-3xl p-8 hover:shadow-xl hover:border-secondary/20 transition-all group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container-high overflow-hidden shadow-inner flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" alt="Mateo G." class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-on-surface group-hover:text-secondary transition-colors">Mateo G.</h3>
                            <p class="text-xs text-on-surface-variant font-medium">Ingeniería de Sistemas</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-6">
                        <span class="px-3 py-1 rounded-full bg-primary/5 text-primary text-xs font-bold border border-primary/10">Bases de Datos</span>
                        <span class="px-3 py-1 rounded-full bg-success/10 text-success text-xs font-bold border border-success/20">Gratis</span>
                    </div>

                    <p class="text-sm text-on-surface-variant leading-relaxed mb-8">
                        "Te ayudo a dominar Programación Orientada a Objetos, estructuras de datos y modelado de bases de datos desde cero."
                    </p>

                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center py-3 bg-surface-container hover:bg-secondary hover:text-white text-on-surface font-bold rounded-xl transition-all text-sm">
                        Agendar Tutoría
                    </a>
                </div>

                <!-- Tutor 3 -->
                <div class="bg-white border border-outline-variant/15 rounded-3xl p-8 hover:shadow-xl hover:border-primary/20 transition-all group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container-high overflow-hidden shadow-inner flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80" alt="Carlos R." class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-on-surface group-hover:text-primary transition-colors">Carlos R.</h3>
                            <p class="text-xs text-on-surface-variant font-medium">Economía</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-6">
                        <span class="px-3 py-1 rounded-full bg-primary/5 text-primary text-xs font-bold border border-primary/10">Física Mecánica</span>
                        <span class="px-3 py-1 rounded-full bg-success/10 text-success text-xs font-bold border border-success/20">Gratis</span>
                    </div>

                    <p class="text-sm text-on-surface-variant leading-relaxed mb-8">
                        "Física y análisis estadístico explicado de forma simple e interactiva. Olvídate de memorizar fórmulas confusas."
                    </p>

                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center py-3 bg-surface-container hover:bg-primary hover:text-white text-on-surface font-bold rounded-xl transition-all text-sm">
                        Agendar Tutoría
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-32 bg-surface-container-lowest relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-96 h-96 bg-primary/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-96 h-96 bg-secondary/5 rounded-full filter blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                
                <div>
                    <span class="text-sm font-extrabold text-secondary uppercase tracking-widest mb-3 block">Nuestras Ventajas</span>
                    <h2 class="text-4xl md:text-5xl font-black text-on-surface mb-12 tracking-tight">{{ __('messages.welcome_ben_title') }}</h2>
                    
                    <div class="space-y-12">
                        <!-- Benefit 1 -->
                        <div class="flex space-x-6">
                            <div class="flex-shrink-0 w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-3 text-on-surface">{{ __('messages.welcome_ben1_title') }}</h4>
                                <p class="text-on-surface-variant leading-relaxed text-sm md:text-base">{{ __('messages.welcome_ben1_desc') }}</p>
                            </div>
                        </div>

                        <!-- Benefit 2 -->
                        <div class="flex space-x-6">
                            <div class="flex-shrink-0 w-14 h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-3 text-on-surface">{{ __('messages.welcome_ben2_title') }}</h4>
                                <p class="text-on-surface-variant leading-relaxed text-sm md:text-base">{{ __('messages.welcome_ben2_desc') }}</p>
                            </div>
                        </div>

                        <!-- Benefit 3 -->
                        <div class="flex space-x-6">
                            <div class="flex-shrink-0 w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-3 text-on-surface">{{ __('messages.welcome_ben3_title') }}</h4>
                                <p class="text-on-surface-variant leading-relaxed text-sm md:text-base">{{ __('messages.welcome_ben3_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative flex justify-center">
                    <div class="absolute -top-12 -right-12 w-72 h-72 bg-primary/5 rounded-full filter blur-3xl opacity-60"></div>
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl border border-outline-variant/20 max-w-md">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Comunidad OpenBook" class="w-full object-cover">
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-32 bg-on-surface text-surface relative overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_center,rgba(37,99,235,0.08)_0%,rgba(0,0,0,0)_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <span class="text-sm font-extrabold text-secondary uppercase tracking-widest mb-3 block text-center">Testimonios</span>
            <h2 class="text-4xl font-extrabold mb-20 text-center text-white tracking-tight">{{ __('messages.welcome_test_title') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Testimonial 1 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 hover:border-white/20 transition-all space-y-6">
                    <div class="flex text-yellow-400 gap-1 text-lg">★★★★★</div>
                    <p class="text-base italic leading-relaxed text-white/80">
                        {{ __('messages.welcome_test1_quote') }}
                    </p>
                    <div class="flex items-center space-x-3 pt-4 border-t border-white/10">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">
                            LS
                        </div>
                        <div>
                            <p class="font-bold text-white text-sm">{{ __('messages.welcome_test1_name') }}</p>
                            <p class="text-xs text-white/50">{{ __('messages.welcome_test1_role') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 hover:border-white/20 transition-all space-y-6">
                    <div class="flex text-yellow-400 gap-1 text-lg">★★★★★</div>
                    <p class="text-base italic leading-relaxed text-white/80">
                        {{ __('messages.welcome_test2_quote') }}
                    </p>
                    <div class="flex items-center space-x-3 pt-4 border-t border-white/10">
                        <div class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-white font-bold text-sm">
                            CR
                        </div>
                        <div>
                            <p class="font-bold text-white text-sm">{{ __('messages.welcome_test2_name') }}</p>
                            <p class="text-xs text-white/50">{{ __('messages.welcome_test2_role') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 hover:border-white/20 transition-all space-y-6">
                    <div class="flex text-yellow-400 gap-1 text-lg">★★★★★</div>
                    <p class="text-base italic leading-relaxed text-white/80">
                        {{ __('messages.welcome_test3_quote') }}
                    </p>
                    <div class="flex items-center space-x-3 pt-4 border-t border-white/10">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">
                            AM
                        </div>
                        <div>
                            <p class="font-bold text-white text-sm">{{ __('messages.welcome_test3_name') }}</p>
                            <p class="text-xs text-white/50">{{ __('messages.welcome_test3_role') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 relative overflow-hidden bg-gradient-to-b from-surface to-surface-container/20">
        <div class="max-w-5xl mx-auto px-6 sm:px-8 relative z-10">
            <div class="bg-gradient-to-br from-primary via-primary to-primary-dark rounded-[3.5rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl">
                <!-- Decorative absolute bubbles -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-secondary/20 rounded-full blur-2xl"></div>
                
                <div class="relative z-10">
                    <span class="text-white/85 text-sm font-extrabold uppercase tracking-widest mb-4 block">Comunidad de Aprendizaje</span>
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-8 tracking-tight">{{ __('messages.welcome_cta_title') }}</h2>
                    <p class="text-lg md:text-xl text-white/90 mb-12 max-w-2xl mx-auto leading-relaxed">
                        {{ __('messages.welcome_cta_desc') }}
                    </p>
                    
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-white text-primary hover:bg-secondary hover:text-white font-black px-12 py-5 rounded-2xl text-lg hover:shadow-xl hover:shadow-secondary/20 transition-all transform hover:-translate-y-0.5">
                        {{ __('messages.welcome_cta_btn') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

