<x-app-layout>
    <style>
        /* Custom elite design elements for tutor dashboard */
        .animate-blob {
            animation: blob 12s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 3s;
        }
        .animation-delay-4000 {
            animation-delay: 6s;
        }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -40px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .dashboard-gradient-text {
            background: linear-gradient(135deg, #2563EB 0%, #14B8A6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <div class="relative overflow-hidden py-10 min-h-screen bg-gradient-to-b from-surface via-surface to-surface-container/10">
        <!-- Floating Animated Glowing Blobs in background -->
        <div class="absolute top-1/4 -left-20 w-80 h-80 bg-primary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob"></div>
        <div class="absolute top-1/3 -right-20 w-80 h-80 bg-secondary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col gap-8">
                
                <!-- Sidebar (Empty, disabled) -->


                <!-- Main Content -->
                <div class="flex-1">
                    
                    <!-- Welcome Header Banner -->
                    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/40 backdrop-blur-md p-6 rounded-[2rem] border border-outline-variant/15 shadow-sm">
                        <div>
                            <div class="flex items-center gap-3 mb-2 flex-wrap">
                                <h1 class="text-3xl font-extrabold text-on-surface leading-tight">
                                    {{ __('messages.dash_welcome', ['name' => '']) }}<span class="dashboard-gradient-text">{{ $user->name }}</span>!
                                </h1>
                            </div>
                            <p class="text-sm font-semibold text-on-surface-variant leading-relaxed">
                                Gestiona tus tutorías y ayuda a otros estudiantes a alcanzar sus metas colaborando juntos.
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex h-3.5 w-3.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-success"></span>
                            </span>
                            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Tutor Certificado</span>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                        <!-- Tutorías Impartidas -->
                        <x-card class="!p-6 border border-primary/10 hover:border-primary/20 bg-gradient-to-br from-primary/5 via-transparent to-transparent backdrop-blur-md transition-all hover:scale-[1.02] shadow-sm hover:shadow-[0_15px_40px_-10px_rgba(37,99,235,0.15)] rounded-3xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-5xl font-black text-on-surface tracking-tight mb-1">
                                {{ sprintf('%02d', $completedServices) }}
                            </h3>
                            <p class="text-[11px] font-extrabold text-on-surface-variant uppercase tracking-wider">
                                Tutorías Impartidas
                            </p>
                        </x-card>

                        <!-- Próximas Sesiones -->
                        <x-card class="!p-6 border border-secondary/15 hover:border-secondary/35 bg-gradient-to-br from-secondary/5 via-transparent to-transparent backdrop-blur-md transition-all hover:scale-[1.02] shadow-sm hover:shadow-[0_15px_40px_-10px_rgba(20,184,166,0.15)] rounded-3xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-5xl font-black text-secondary tracking-tight mb-1">
                                {{ sprintf('%02d', $upcomingTutoringsCount) }}
                            </h3>
                            <p class="text-[11px] font-extrabold text-on-surface-variant uppercase tracking-wider">
                                {{ __('messages.tutor_stat_upcoming') }}
                            </p>
                        </x-card>

                        <!-- Mis Ofertas Publicadas -->
                        <x-card class="!p-6 border border-primary/10 hover:border-primary/20 bg-gradient-to-br from-primary/5 via-transparent to-transparent backdrop-blur-md transition-all hover:scale-[1.02] shadow-sm hover:shadow-[0_15px_40px_-10px_rgba(37,99,235,0.15)] rounded-3xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <h3 class="text-5xl font-black text-on-surface tracking-tight mb-1">
                                {{ sprintf('%02d', $myTutorings->count()) }}
                            </h3>
                            <p class="text-[11px] font-extrabold text-on-surface-variant uppercase tracking-wider">
                                Tutorías Publicadas
                            </p>
                        </x-card>
                    </div>

                    <!-- My Offered Tutorings -->
                    <div class="mb-12">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-on-surface">{{ __('messages.tutor_my_tutorings') }}</h3>
                            <a href="{{ route('dashboard.tutor.post') }}"
                                class="text-sm font-bold text-primary hover:text-primary-dark transition-colors flex items-center gap-1 group">
                                {{ __('messages.tutor_create_new') }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($myTutorings as $tutoring)
                                <div class="bg-white p-6 rounded-[2rem] border border-outline-variant/15 flex items-center justify-between hover:shadow-md transition-shadow">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0 shadow-inner">
                                            <span class="font-extrabold text-base">{{ strtoupper(substr($tutoring->subject, 0, 2)) }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-base text-on-surface">
                                                {{ __('messages.subject_' . Str::slug($tutoring->subject, '_')) }}
                                            </h4>
                                            <p class="text-xs text-on-surface-variant font-semibold mt-0.5">
                                                <span class="text-success font-bold">{{ __('messages.price_free') }}</span> •
                                                📅 {{ collect(explode(',', $tutoring->scheduled_date))->map(fn($d) => __('messages.day_' . Str::slug(trim($d), '_')))->implode(', ') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center justify-center px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-wider border border-primary/20">
                                        {{ __('messages.tutor_active') }}
                                    </span>
                                </div>
                            @empty
                                <div class="bg-white p-8 rounded-[2rem] border border-outline-variant/15 text-center md:col-span-2 shadow-sm">
                                    <p class="text-on-surface-variant font-semibold">{{ __('messages.tutor_no_tutorings') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Upcoming Confirmed Sessions -->
                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-on-surface mb-6">{{ __('messages.tutor_upcoming') }}</h3>
                        <div class="space-y-4">
                            @forelse($upcomingTutorings as $request)
                                <x-card class="!p-6 border border-outline-variant/15 bg-white/70 backdrop-blur-md hover:border-primary/20 transition-all shadow-sm">
                                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                                        <div class="flex items-start space-x-4">
                                            <div class="w-14 h-14 bg-surface-container rounded-2xl flex items-center justify-center flex-shrink-0 overflow-hidden border border-outline-variant/15 shadow-inner">
                                                @if ($request->student->profile_photo_path)
                                                    <img src="{{ $request->student->profile_photo_url }}"
                                                        alt="{{ $request->student->name }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-secondary/10 text-secondary font-bold text-lg">
                                                        {{ strtoupper(substr($request->student->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $request->student->name)[1] ?? '', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-lg text-on-surface">
                                                    {{ $request->student->name }}
                                                </h4>
                                                <p class="text-xs text-primary font-bold mt-0.5">
                                                    📚 {{ __('messages.subject_' . Str::slug($request->tutoring->subject, '_')) }}
                                                </p>
                                                <p class="text-xs text-on-surface-variant font-medium mt-1 leading-relaxed italic">
                                                    {{ __('messages.tutor_request_for', [
                                                        'date' => $request->booking_date,
                                                        'time' => __('messages.time_' . Str::slug($request->booking_time, '_')),
                                                    ]) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <!-- Video Call / Meet Link Indicator -->
                                            @if($request->meet_link)
                                                <a href="{{ $request->meet_link }}" target="_blank" class="inline-flex items-center gap-1.5 px-4.5 py-2 bg-success text-white text-xs font-black rounded-xl hover:bg-success/90 transition-colors shadow-sm">
                                                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 00-2 2z"></path></svg>
                                                    Ir a Google Meet
                                                </a>
                                            @endif
                                            <span class="px-3.5 py-1.5 bg-success/10 text-success rounded-xl text-xs font-black uppercase tracking-wider border border-success/20">
                                                {{ __('messages.tutor_confirmed') }}
                                            </span>
                                        </div>
                                    </div>
                                </x-card>
                            @empty
                                <div class="bg-white p-8 rounded-[2rem] border border-outline-variant/15 text-center shadow-sm">
                                    <p class="text-on-surface-variant font-semibold">{{ __('messages.tutor_no_upcoming') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Collaboration Resource Banner (Replacing outdated Freelance Job card) -->
                    <div>
                        <h3 class="text-2xl font-bold text-on-surface mb-6">Herramientas & Recursos de Tutoría</h3>
                        <div class="bg-gradient-to-br from-secondary via-secondary to-primary-dark rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-xl shadow-secondary/15">
                            <!-- Floating absolute circles -->
                            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                            <div class="absolute top-0 right-1/4 w-40 h-40 bg-primary/10 rounded-full blur-xl pointer-events-none"></div>
                            
                            <div class="relative z-10 max-w-xl">
                                <span class="px-3.5 py-1 bg-white/10 text-white text-xs font-black rounded-full uppercase tracking-wider border border-white/20 mb-4 inline-block">
                                    Academia Colaborativa
                                </span>
                                <h4 class="text-2xl md:text-3xl font-extrabold mb-3 leading-tight">
                                    Consejos para Tutorías Exitosas
                                </h4>
                                <p class="text-white/90 text-sm md:text-base leading-relaxed mb-8 font-medium">
                                    Prepárate para guiar a tus compañeros con las mejores herramientas interactivas, como pizarras digitales integradas y material didáctico dinámico.
                                </p>
                                <a href="{{ route('dashboard.tutor.post') }}" class="inline-flex justify-center items-center bg-white text-secondary font-black px-8 py-3.5 rounded-2xl text-sm hover:bg-primary hover:text-white hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                    Ofrecer Nueva Tutoría
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
