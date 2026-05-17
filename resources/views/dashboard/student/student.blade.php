<x-app-layout>
    <style>
        /* Custom elite design elements for dashboard */
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
                                {{ __('messages.dash_progress') }}
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex h-3.5 w-3.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-success"></span>
                            </span>
                            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Conexión Segura</span>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="mb-8 p-4.5 bg-success/15 border border-success/20 text-success rounded-2xl text-sm font-bold flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-8 p-4.5 bg-danger/15 border border-danger/25 text-danger rounded-2xl font-bold flex items-start shadow-sm">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                        <!-- Tutorías Disponibles -->
                        <x-card class="!p-6 border border-primary/10 hover:border-primary/20 bg-gradient-to-br from-primary/5 via-transparent to-transparent backdrop-blur-md transition-all hover:scale-[1.02] shadow-sm hover:shadow-[0_15px_40px_-10px_rgba(37,99,235,0.15)] rounded-3xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                            </div>
                            <h3 class="text-5xl font-black text-on-surface tracking-tight mb-1">{{ sprintf('%02d', $totalTutorings) }}</h3>
                            <p class="text-[11px] font-extrabold text-on-surface-variant uppercase tracking-wider">Tutorías Disponibles</p>
                        </x-card>

                        <!-- Mis Tutorías Reservadas -->
                        <x-card class="!p-6 border border-secondary/15 hover:border-secondary/35 bg-gradient-to-br from-secondary/5 via-transparent to-transparent backdrop-blur-md transition-all hover:scale-[1.02] shadow-sm hover:shadow-[0_15px_40px_-10px_rgba(20,184,166,0.15)] rounded-3xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                            <h3 class="text-5xl font-black text-secondary tracking-tight mb-1">{{ sprintf('%02d', $myBookedSessionsCount) }}</h3>
                            <p class="text-[11px] font-extrabold text-on-surface-variant uppercase tracking-wider">Mis Clases Reservadas</p>
                        </x-card>

                        <!-- Mentores Activos -->
                        <x-card class="!p-6 border border-primary/10 hover:border-primary/20 bg-gradient-to-br from-primary/5 via-transparent to-transparent backdrop-blur-md transition-all hover:scale-[1.02] shadow-sm hover:shadow-[0_15px_40px_-10px_rgba(37,99,235,0.15)] rounded-3xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            </div>
                            <h3 class="text-5xl font-black text-on-surface tracking-tight mb-1">{{ sprintf('%02d', $totalTutors) }}</h3>
                            <p class="text-[11px] font-extrabold text-on-surface-variant uppercase tracking-wider">Mentores Activos</p>
                        </x-card>
                    </div>

                    <!-- Current Activities (Tutorings List) -->
                    <div class="mb-12">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-on-surface">{{ __('messages.dash_featured') }}</h3>
                            <a href="{{ route('dashboard.search') }}" class="text-sm font-bold text-primary hover:text-primary-dark transition-colors flex items-center gap-1 group">
                                {{ __('messages.dash_see_all') }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            @forelse($availableTutorings->take(3) as $tutoring)
                                <a href="{{ route('dashboard.book', $tutoring->id) }}" class="block group">
                                    <div class="bg-white p-6 rounded-[2rem] border border-outline-variant/15 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 group-hover:shadow-md group-hover:border-primary/35 transition-all">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-14 h-14 bg-surface-container rounded-2xl flex items-center justify-center overflow-hidden border border-outline-variant/15 flex-shrink-0 shadow-inner">
                                                @if($tutoring->user->profile_photo_path)
                                                    <img src="{{ $tutoring->user->profile_photo_url }}" alt="{{ $tutoring->user->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-primary/10 text-primary font-bold text-lg">
                                                        {{ strtoupper(substr($tutoring->subject, 0, 2)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-lg text-on-surface group-hover:text-primary transition-colors">
                                                    {{ __('messages.subject_' . Str::slug($tutoring->subject, '_')) }}
                                                </h4>
                                                <p class="text-xs text-on-surface-variant font-medium mt-1">
                                                    {{ __('messages.search_tutor_label') }}: <span class="text-on-surface font-bold">{{ $tutoring->user->name ?? __('messages.dash_anon') }}</span> • 
                                                    <span class="text-success font-bold">{{ __('messages.price_free') }}</span>
                                                </p>
                                                <p class="text-[11px] text-on-surface-variant/80 font-semibold mt-0.5">
                                                    📅 {{ collect(explode(',', $tutoring->scheduled_date))->map(fn($d) => __('messages.day_' . Str::slug(trim($d), '_')))->implode(', ') }} 
                                                    ({{ collect(explode(',', $tutoring->scheduled_time))->map(fn($t) => __('messages.time_' . Str::slug(trim($t), '_')))->implode(', ') }})
                                                </p>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center justify-center px-4 py-2 bg-primary/5 text-primary text-xs font-bold rounded-xl border border-primary/15 group-hover:bg-primary group-hover:text-white transition-colors self-stretch md:self-auto text-center">
                                            {{ __('messages.dash_schedule') }}
                                        </span>
                                    </div>
                                </a>
                            @empty
                                <div class="bg-white p-8 rounded-[2rem] border border-outline-variant/15 text-center shadow-sm">
                                    <svg class="w-10 h-10 text-on-surface-variant/30 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    <p class="text-on-surface-variant font-semibold">{{ __('messages.dash_no_tutorings') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Shortcuts Banner -->
                    <div>
                        <h3 class="text-2xl font-bold text-on-surface mb-6">{{ __('messages.dash_shortcuts') }}</h3>
                        <div class="bg-gradient-to-br from-primary via-primary to-primary-dark rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-xl shadow-primary/10">
                            <!-- Floating absolute circles -->
                            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                            <div class="absolute top-0 right-1/4 w-40 h-40 bg-secondary/15 rounded-full blur-xl pointer-events-none"></div>
                            
                            <div class="relative z-10 max-w-xl">
                                <span class="px-3.5 py-1 bg-white/10 text-white text-xs font-black rounded-full uppercase tracking-wider border border-white/20 mb-4 inline-block">
                                    Acceso Inmediato
                                </span>
                                <h4 class="text-2xl md:text-3xl font-extrabold mb-3 leading-tight">
                                    {{ __('messages.dash_emergency_title') }}
                                </h4>
                                <p class="text-white/90 text-sm md:text-base leading-relaxed mb-8 font-medium">
                                    {{ __('messages.dash_emergency_desc') }}
                                </p>
                                <a href="{{ route('dashboard.search') }}" class="inline-flex justify-center items-center bg-white text-primary font-black px-8 py-3.5 rounded-2xl text-sm hover:bg-secondary hover:text-white hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                    {{ __('messages.dash_emergency_btn') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
