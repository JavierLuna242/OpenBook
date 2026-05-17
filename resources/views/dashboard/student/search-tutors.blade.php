<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">

                <div class="flex-1">
                    <div class="mb-10">
                        <h1 class="text-3xl font-extrabold text-on-surface mb-2">{{ __('messages.search_title') }}</h1>
                        <p class="text-on-surface-variant text-lg">{{ __('messages.search_subtitle') }}</p>
                    </div>

                    @if (session('success'))
                        <div class="mb-8 p-4 bg-primary-container/10 text-primary-container rounded-xl font-bold border border-primary-container">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-8 p-4 bg-error-container text-error rounded-xl font-bold">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div x-data="{ openFilters: false }">
                        <!-- Search & Filter Bar -->
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <form action="{{ route('dashboard.search') }}" method="GET" class="flex-1 bg-surface-container-low p-3 rounded-2xl flex items-center shadow-sm border border-outline-variant/10 focus-within:border-primary/30 transition-all">
                                @if(request('subject'))
                                    <input type="hidden" name="subject" value="{{ request('subject') }}">
                                @endif
                                <svg class="w-5 h-5 text-on-surface-variant ml-2 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <input type="text" name="q" value="{{ $search }}" placeholder="{{ __('messages.search_placeholder') }}" class="w-full bg-transparent border-none outline-none text-on-surface placeholder-on-surface-variant/60">
                                <button type="submit" class="btn-prestige py-2 px-6 ml-2 hidden md:block text-sm">
                                    {{ __('messages.search_btn') }}
                                </button>
                            </form>
                            
                            <button @click="openFilters = !openFilters" 
                                    class="flex items-center justify-center gap-2 px-6 py-3 bg-surface-container-high text-on-surface font-bold rounded-2xl hover:bg-surface-container transition-all border border-outline-variant/20 shadow-sm sm:w-auto w-full">
                                <svg class="w-5 h-5 text-primary" :class="openFilters ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                {{ __('messages.search_btn_filters') }}
                                <span x-show="!openFilters" class="ml-1 text-xs bg-primary text-white w-5 h-5 rounded-full flex items-center justify-center">{{ $subjects->count() }}</span>
                            </button>
                        </div>

                        <!-- Active Filters Chips -->
                        @if($subjectFilter && $subjectFilter !== 'Todos' || $search)
                            <div class="flex flex-wrap gap-2 mb-8 items-center">
                                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mr-2">{{ __('messages.search_active_filters') }}</span>
                                @if($subjectFilter && $subjectFilter !== 'Todos')
                                    <div class="flex items-center gap-2 bg-primary/10 text-primary px-4 py-1.5 rounded-full border border-primary/20 text-sm font-bold">
                                        {{ __('messages.subject_' . Str::slug($subjectFilter, '_')) }}
                                        <a href="{{ route('dashboard.search', ['q' => $search]) }}" class="hover:text-primary-variant">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </div>
                                @endif
                                @if($search)
                                    <div class="flex items-center gap-2 bg-secondary/10 text-secondary px-4 py-1.5 rounded-full border border-secondary/20 text-sm font-bold">
                                        "{{ $search }}"
                                        <a href="{{ route('dashboard.search', ['subject' => $subjectFilter]) }}" class="hover:text-secondary-variant">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </div>
                                @endif
                                <a href="{{ route('dashboard.search') }}" class="text-xs text-on-surface-variant hover:text-primary font-bold underline ml-2">{{ __('messages.search_clear_all') }}</a>
                            </div>
                        @endif

                        <!-- Collapsible Filter Panel -->
                        <div x-show="openFilters" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-cloak
                             class="p-8 bg-surface-container-low border border-outline-variant/30 rounded-[2.5rem] shadow-2xl mb-10">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-on-surface">{{ __('messages.search_filter_title') }}</h3>
                                <button @click="openFilters = false" class="text-on-surface-variant hover:text-on-surface">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                <a href="{{ route('dashboard.search', ['q' => $search]) }}" 
                                   class="{{ !$subjectFilter || $subjectFilter === 'Todos' ? 'bg-primary text-white font-bold' : 'bg-surface-container-high text-on-surface hover:bg-surface-container' }} px-4 py-3 rounded-2xl text-sm text-center transition-all">
                                    {{ __('messages.search_filter_all_subjects') }}
                                </a>
                                @foreach($subjects as $subject)
                                    <a href="{{ route('dashboard.search', ['q' => $search, 'subject' => $subject->name]) }}" 
                                       class="{{ $subjectFilter === $subject->name ? 'bg-primary text-white font-bold' : 'bg-surface-container-high text-on-surface hover:bg-surface-container' }} px-4 py-3 rounded-2xl text-sm text-center transition-all truncate"
                                       title="{{ $subject->name }}">
                                        {{ __('messages.subject_' . Str::slug($subject->name, '_')) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Search Results with Tabs -->
                    <div x-data="{ activeTab: '{{ request('materials_page') ? 'materiales' : 'tutorias' }}' }">
                        <!-- Custom Tabs -->
                        <div class="flex gap-8 mb-8 border-b border-outline-variant/15 pb-px">
                            <button @click="activeTab = 'tutorias'" :class="activeTab === 'tutorias' ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface hover:border-b-2 hover:border-outline-variant/50'" class="pb-3 text-lg font-bold transition-all flex items-center gap-2 border-b-2 border-transparent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Tutorías
                            </button>
                            <button @click="activeTab = 'materiales'" :class="activeTab === 'materiales' ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface hover:border-b-2 hover:border-outline-variant/50'" class="pb-3 text-lg font-bold transition-all flex items-center gap-2 border-b-2 border-transparent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                Material Académico
                            </button>
                        </div>

                        <!-- Tutorias Tab -->
                        <div x-show="activeTab === 'tutorias'" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            @forelse($tutorings as $tutoring)
                                <x-card class="flex flex-col sm:flex-row gap-6 hover:border-primary-container/30 border border-transparent">
                                    <div class="flex-shrink-0 flex flex-col items-center sm:items-start">
                                        <div class="w-24 h-24 bg-gradient-to-br from-primary-container to-primary rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg mb-4 overflow-hidden">
                                            @if($tutoring->user->profile_photo_path)
                                                <img src="{{ $tutoring->user->profile_photo_url }}" alt="{{ $tutoring->user->name }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($tutoring->user->name, 0, 1)) . (strrchr($tutoring->user->name, " ") ? strtoupper(substr(strrchr($tutoring->user->name, " "), 1, 1)) : '') }}
                                            @endif
                                        </div>
                                        <span class="chip-mentor bg-secondary/10 text-secondary">{{ __('messages.search_tutor_label') }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col sm:flex-row sm:items-start justify-between mb-2">
                                            <div>
                                                <h2 class="text-2xl font-bold text-on-surface">{{ $tutoring->user->name }}</h2>
                                                <p class="text-primary font-medium mb-1">{{ __('messages.subject_' . Str::slug($tutoring->subject, '_')) }}</p>
                                                <div class="flex items-center text-sm text-on-surface-variant font-medium">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    {{ collect(explode(',', $tutoring->scheduled_date))->map(fn($d) => __('messages.day_' . Str::slug(trim($d), '_')))->implode(', ') }} ({{ collect(explode(',', $tutoring->scheduled_time))->map(fn($t) => __('messages.time_' . Str::slug(trim($t), '_')))->implode(', ') }})
                                                </div>
                                            </div>
                                            <div class="text-left sm:text-right mt-2 sm:mt-0">
                                                <p class="text-2xl font-extrabold text-success">{{ __('messages.price_free') }}</p>
                                            </div>
                                        </div>
                                        <p class="text-on-surface-variant leading-relaxed mb-6">{{ $tutoring->topics }}</p>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            @if($tutoring->user_id !== auth()->id())
                                                <a href="{{ route('dashboard.book', $tutoring->id) }}" class="btn-prestige py-2 px-6 flex-1 text-center">{{ __('messages.search_book_btn') }}</a>
                                            @else
                                                <button disabled class="bg-surface-container text-on-surface-variant font-bold py-2 px-6 rounded-full flex-1 cursor-not-allowed opacity-60">
                                                    {{ __('messages.tutor_active') }} (Mío)
                                                </button>
                                            @endif

                                        </div>
                                    </div>
                                </x-card>
                            @empty
                                <div class="text-center py-20 bg-surface-container-low rounded-3xl">
                                    <h3 class="text-xl font-bold text-on-surface">{{ __('messages.search_no_tutorings') }}</h3>
                                </div>
                            @endforelse

                            <div class="mt-8 flex flex-col items-center">
                                <p class="text-xs text-on-surface-variant mb-2">
                                    {{ __('messages.history_showing', ['count' => $tutorings->count()]) }} 
                                    ({{ __('messages.pagination_page') }} {{ $tutorings->currentPage() }} {{ __('messages.pagination_of') }} {{ $tutorings->lastPage() }})
                                </p>
                                {{ $tutorings->links() }}
                            </div>
                        </div>

                        <!-- Materiales Tab -->
                        <div x-show="activeTab === 'materiales'" x-cloak class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            @if ($materials->isEmpty())
                                <div class="text-center py-20 bg-surface-container-low rounded-3xl">
                                    <h3 class="text-xl font-bold text-on-surface">No se encontraron materiales académicos.</h3>
                                    <p class="text-on-surface-variant mt-2">Intenta ajustar tu búsqueda para encontrar más resultados.</p>
                                </div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($materials as $material)
                                        <div class="group border border-outline-variant/20 bg-white rounded-2xl p-6 hover:border-primary/30 hover:shadow-xl transition-all relative overflow-hidden flex flex-col h-full hover:-translate-y-1">
                                            <!-- Decorative accent -->
                                            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-primary to-secondary opacity-50 group-hover:opacity-100 transition-opacity"></div>
                                            
                                            <div class="flex items-center gap-4 mb-5">
                                                <div class="w-14 h-14 rounded-2xl bg-surface-container-high flex items-center justify-center text-primary font-black uppercase shadow-inner text-sm border border-outline-variant/10">
                                                    {{ substr($material->file_type ?? 'DOC', 0, 4) }}
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="font-extrabold text-on-surface text-lg line-clamp-1" title="{{ $material->title }}">{{ $material->title }}</h3>
                                                    <p class="text-xs font-bold text-primary mb-1">{{ $material->tutor->name }}</p>
                                                    <p class="text-[11px] text-on-surface-variant font-mono">{{ $material->file_size }} • {{ $material->created_at->format('d M, Y') }}</p>
                                                </div>
                                            </div>
                                            
                                            <p class="text-sm text-on-surface-variant leading-relaxed mb-6 line-clamp-3 flex-grow">{{ $material->description ?: 'Recurso académico compartido para facilitar el estudio y aprendizaje.' }}</p>
                                            
                                            <div class="mt-auto pt-4 border-t border-outline-variant/10">
                                                <a href="{{ route('dashboard.materials.download', $material) }}" class="w-full inline-flex justify-center items-center py-3 bg-surface-container hover:bg-primary text-on-surface hover:text-white font-bold rounded-xl transition-all text-sm gap-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                    Descargar Material
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-8 flex flex-col items-center">
                                    {{ $materials->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
