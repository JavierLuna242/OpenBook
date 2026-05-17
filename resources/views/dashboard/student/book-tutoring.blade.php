@php
    $allowedDaysStr = !empty($tutoring->scheduled_date) ? $tutoring->scheduled_date : '';
    $allowedDaysArr = explode(',', $allowedDaysStr);
    
    $dayMap = [
        'Domingo' => 0,
        'Lunes' => 1,
        'Martes' => 2,
        'Miércoles' => 3,
        'Jueves' => 4,
        'Viernes' => 5,
        'Sábado' => 6
    ];
    
    $allowedJsDays = [];
    foreach ($allowedDaysArr as $dayStr) {
        $dayStr = trim($dayStr);
        if (isset($dayMap[$dayStr])) {
            $allowedJsDays[] = $dayMap[$dayStr];
        }
    }
    $allowedJsDaysJson = json_encode($allowedJsDays);
@endphp

<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @if(app()->getLocale() !== 'en')
        <script src="https://npmcdn.com/flatpickr/dist/l10n/{{ app()->getLocale() }}.js"></script>
    @endif

    <div class="py-8" x-data="{
        selectedTime: '',
        price: {{ $tutoring->price }},
        date: '',
        getTimeDisplay() {
            if (!this.selectedTime) return '{{ __('messages.book_none_selected') }}';
            const map = {
                'Mañana': '{{ __('messages.time_manana') }}',
                'Tarde': '{{ __('messages.time_tarde') }}'
            };
            return map[this.selectedTime] || this.selectedTime;
        },
        init() {
            const allowedDays = {{ $allowedJsDaysJson }};
            flatpickr(this.$refs.datePicker, {
                locale: '{{ app()->getLocale() === "en" ? "default" : app()->getLocale() }}',
                minDate: 'today',
                disable: [
                    function(date) {
                        if (allowedDays.length === 0) return false;
                        return !allowedDays.includes(date.getDay());
                    }
                ],
                onChange: (selectedDates, dateStr, instance) => {
                    this.date = dateStr;
                }
            });
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Sidebar -->


                <!-- Main Content -->
                <div class="flex-1">
                    <div class="mb-10">
                        <div class="flex items-center space-x-4 mb-4">
                            <a href="{{ route('dashboard.search') }}"
                                class="text-on-surface-variant hover:text-primary-container transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <h1 class="text-3xl font-extrabold text-on-surface">{{ __('messages.book_title') }}</h1>
                        </div>
                        <p class="text-on-surface-variant text-lg">{{ __('messages.book_subtitle') }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-8 p-4 bg-error-container text-error rounded-xl font-bold">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.book.confirm', $tutoring->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" :value="date">
                        <input type="hidden" name="time" :value="selectedTime">

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Booking Info -->
                            <div class="lg:col-span-2 space-y-8">
                                <!-- Tutor Info Card -->
                                <x-card class="flex items-start space-x-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-primary-container to-primary rounded-2xl flex-shrink-0 flex items-center justify-center text-white text-2xl font-bold shadow-lg overflow-hidden">
                                        @if($tutoring->user->profile_photo_path)
                                            <img src="{{ $tutoring->user->profile_photo_url }}" alt="{{ $tutoring->user->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($tutoring->user->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-on-surface">{{ $tutoring->user->name }}</h2>
                                        <p class="text-primary font-medium mb-3">
                                            {{ $tutoring->user->program ?? __('messages.tutor_profile_default') }}</p>
                                        <p class="text-on-surface-variant text-sm leading-relaxed">
                                            {{ $tutoring->user->bio ?? __('messages.book_tutor_bio_default') }}
                                        </p>
                                    </div>
                                </x-card>

                                <!-- Availability Selection -->
                                <x-card>
                                    <h3 class="text-xl font-bold text-on-surface mb-6 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-primary-container" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('messages.book_availability') }}: {{ !empty($tutoring->scheduled_date) ? collect(explode(',', $tutoring->scheduled_date))->map(fn($d) => __('messages.day_' . Str::slug(trim($d), '_')))->implode(', ') : __('messages.book_tbd') }}
                                    </h3>
                                    
                                    <p class="text-on-surface-variant mb-6">{{ __('messages.book_avail_desc', ['days' => !empty($tutoring->scheduled_date) ? collect(explode(',', $tutoring->scheduled_date))->map(fn($d) => __('messages.day_' . Str::slug(trim($d), '_')))->implode(', ') : __('messages.book_tbd')]) }}</p>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        @foreach($tutoring->availability as $slot)
                                            <button type="button" 
                                                    @click="selectedTime = '{{ $slot }}'"
                                                    class="p-6 border-2 rounded-2xl text-left transition-all relative group"
                                                    :class="selectedTime === '{{ $slot }}' ? 'border-primary bg-primary-container/10' : 'border-outline-variant/20 hover:border-primary-container/40'">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="font-bold text-xl" :class="selectedTime === '{{ $slot }}' ? 'text-primary' : 'text-on-surface'">{{ __('messages.time_' . Str::slug($slot, '_')) }}</span>
                                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                                         :class="selectedTime === '{{ $slot }}' ? 'border-primary bg-primary' : 'border-outline-variant/30'">
                                                        <svg x-show="selectedTime === '{{ $slot }}'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    </div>
                                                </div>
                                                <p class="text-sm text-on-surface-variant">
                                                    @if($slot === 'Mañana')
                                                        8:00 AM - 12:00 PM
                                                    @else
                                                        2:00 PM - 6:00 PM
                                                    @endif
                                                </p>
                                            </button>
                                        @endforeach
                                    </div>

                                    <div class="mt-8 pt-6 border-t border-outline-variant/20">
                                        <h3 class="text-lg font-bold text-on-surface mb-4">{{ __('messages.book_select_date') }}</h3>
                                        <input type="text" x-ref="datePicker" placeholder="{{ __('messages.book_date_ph') }}" 
                                               class="w-full bg-surface-container-high border-b-2 border-transparent focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg text-on-surface cursor-pointer">
                                    </div>
                                </x-card>
                            </div>

                            <!-- Summary Sidebar -->
                            <div class="space-y-6">
                                <x-card class="sticky top-8 border border-primary-container/20 shadow-lg">
                                    <h3 class="text-xl font-bold text-on-surface mb-6">{{ __('messages.book_summary') }}</h3>

                                    <div class="space-y-4 mb-8">
                                        <div class="flex justify-between items-center pb-4 border-b border-outline-variant/10">
                                            <span class="text-on-surface-variant">{{ __('messages.book_sum_subject') }}</span>
                                            <span class="font-bold text-on-surface text-right ml-2">{{ __('messages.subject_' . Str::slug($tutoring->subject, '_')) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center pb-4 border-b border-outline-variant/10">
                                            <span class="text-on-surface-variant">{{ __('messages.book_sum_day') }}</span>
                                            <span class="font-bold text-on-surface" x-text="date || '{{ __('messages.book_none_selected') }}'"></span>
                                        </div>
                                        <div class="flex justify-between items-center pb-4 border-b border-outline-variant/10">
                                            <span class="text-on-surface-variant">{{ __('messages.book_sum_block') }}</span>
                                            <span class="font-bold text-primary" x-text="getTimeDisplay()"></span>
                                        </div>
                                        <div class="flex justify-between items-center pt-2">
                                            <span class="text-lg font-bold text-on-surface">{{ __('messages.book_sum_total') }}</span>
                                            <span class="text-2xl font-extrabold text-primary-container">${{ number_format($tutoring->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    <button type="submit" 
                                            :disabled="!selectedTime || !date"
                                            class="btn-prestige w-full py-4 text-lg mb-4 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                                        {{ __('messages.book_confirm_btn') }}
                                    </button>

                                    <p class="text-[10px] text-center text-on-surface-variant leading-tight">
                                        {{ __('messages.book_confirm_note') }}
                                    </p>
                                </x-card>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
