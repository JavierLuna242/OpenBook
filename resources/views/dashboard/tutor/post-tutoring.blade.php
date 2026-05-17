<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                
                <!-- Sidebar -->


                <!-- Main Content -->
                <div class="flex-1">
                    <div class="mb-10">
                        <h1 class="text-3xl font-extrabold text-on-surface mb-2">{{ __('messages.post_tut_title') }}</h1>
                        <p class="text-on-surface-variant text-lg">{{ __('messages.post_tut_subtitle') }}</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Form Area -->
                        <div class="lg:col-span-2">
                            <x-card class="!p-8">
                                <form action="{{ route('dashboard.tutor.store') }}" method="POST" class="space-y-6" novalidate>
                                    @csrf
                                    <div class="space-y-4">
                                        <h3 class="text-xl font-bold text-on-surface flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                            {{ __('messages.post_tut_details') }}
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">{{ __('messages.post_tut_subject_label') }}</label>
                                            <select name="subject" class="w-full bg-surface-container-high border-b-2 @error('subject') border-error @else border-outline-variant/30 @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg text-on-surface appearance-none">
                                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>{{ __('messages.subject_select') }}</option>
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->name }}" {{ old('subject') == $subject->name ? 'selected' : '' }}>{{ __('messages.subject_' . Str::slug($subject->name, '_')) }}</option>
                                                @endforeach
                                                <option value="Otro" {{ old('subject') == 'Otro' ? 'selected' : '' }}>{{ __('messages.subject_other') }}</option>
                                            </select>
                                            @error('subject')
                                                <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-bold text-on-surface mb-2 tracking-tight uppercase">{{ __('messages.post_tut_topics_label') }}</label>
                                            <input type="text" name="topics" value="{{ old('topics') }}" placeholder="{{ __('messages.post_tut_topics_ph') }}" 
                                                   class="w-full bg-surface-container-high border-b-2 @error('topics') border-error @else border-outline-variant/10 @enderror focus:border-primary-container px-4 py-3 outline-none transition-all duration-300 rounded-t-lg text-on-surface">
                                            @error('topics')
                                                <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                                            @enderror
                                        </div>
                                                               <div class="space-y-4 pt-4 border-t border-outline-variant/10">
                                        <h3 class="text-xl font-bold text-on-surface flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                            {{ __('messages.post_tut_availability') }}
                                        </h3>
                                        <p class="text-sm text-on-surface-variant">{{ __('messages.post_tut_avail_desc') }}</p>
                                        
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-on-surface mb-3 tracking-tight uppercase">{{ __('messages.post_tut_days_label') }}</label>
                                                <p class="text-xs text-on-surface-variant mb-4">{{ __('messages.post_tut_days_desc') }}</p>
                                                <div class="flex flex-wrap gap-3">
                                                    @php
                                                        $days = [
                                                            'Lunes'     => __('messages.post_tut_day_mon'),
                                                            'Martes'    => __('messages.post_tut_day_tue'),
                                                            'Miércoles' => __('messages.post_tut_day_wed'),
                                                            'Jueves'    => __('messages.post_tut_day_thu'),
                                                            'Viernes'   => __('messages.post_tut_day_fri'),
                                                            'Sábado'    => __('messages.post_tut_day_sat'),
                                                            'Domingo'   => __('messages.post_tut_day_sun'),
                                                        ];
                                                        $oldDays = old('scheduled_days', []);
                                                    @endphp
                                                    @foreach($days as $value => $label)
                                                    <label class="cursor-pointer">
                                                        <input type="checkbox" name="scheduled_days[]" value="{{ $value }}" {{ in_array($value, $oldDays) ? 'checked' : '' }} class="peer hidden">
                                                        <div class="px-4 py-2 border-2 border-outline-variant/20 rounded-xl text-center transition-all peer-checked:border-primary peer-checked:bg-primary-container/10 peer-checked:text-primary hover:bg-surface-container font-medium">
                                                            {{ $label }}
                                                        </div>
                                                    </label>
                                                    @endforeach
                                                </div>
                                                @error('scheduled_days')
                                                    <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-bold text-on-surface mb-3 tracking-tight uppercase">{{ __('messages.post_tut_slots_label') }}</label>
                                                @php $oldAvail = old('availability', []); @endphp
                                                <div class="flex flex-wrap gap-4">
                                                    <label class="flex-1 cursor-pointer">
                                                        <input type="checkbox" name="availability[]" value="Mañana" {{ in_array('Mañana', $oldAvail) ? 'checked' : '' }} class="peer hidden">
                                                        <div class="px-6 py-4 border-2 border-outline-variant/20 rounded-2xl text-center transition-all peer-checked:border-primary peer-checked:bg-primary-container/10 peer-checked:text-primary hover:bg-surface-container">
                                                            <div class="font-bold text-lg">{{ __('messages.post_tut_morning') }}</div>
                                                            <div class="text-xs text-on-surface-variant">8:00 AM - 12:00 PM</div>
                                                        </div>
                                                    </label>
                                                    <label class="flex-1 cursor-pointer">
                                                        <input type="checkbox" name="availability[]" value="Tarde" {{ in_array('Tarde', $oldAvail) ? 'checked' : '' }} class="peer hidden">
                                                        <div class="px-6 py-4 border-2 border-outline-variant/20 rounded-2xl text-center transition-all peer-checked:border-primary peer-checked:bg-primary-container/10 peer-checked:text-primary hover:bg-surface-container">
                                                            <div class="font-bold text-lg">{{ __('messages.post_tut_afternoon') }}</div>
                                                            <div class="text-xs text-on-surface-variant">2:00 PM - 6:00 PM</div>
                                                        </div>
                                                    </label>
                                                </div>
                                                @error('availability')
                                                    <p class="mt-1 text-xs text-error font-medium">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
       </div>



                                    <div class="pt-6 border-t border-outline-variant/20">
                                        <button type="submit" class="btn-prestige w-full md:w-auto px-10 py-3 text-lg">{{ __('messages.post_tut_btn') }}</button>
                                    </div>
                                </form>
                            </x-card>
                        </div>

                        <!-- Atelier Tips -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-primary to-secondary rounded-3xl p-8 text-white sticky top-8 shadow-xl">
                                <h3 class="text-xl font-bold mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                    {{ __('messages.post_tut_tip_title') }}
                                </h3>
                                
                                <ul class="space-y-6">
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-primary-container mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white/90 leading-relaxed">{{ __('messages.post_tut_tip_1') }}</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-primary-container mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white/90 leading-relaxed">{{ __('messages.post_tut_tip_2') }}</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-primary-container mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white/90 leading-relaxed">{{ __('messages.post_tut_tip_3') }}</span>
                                    </li>
                                </ul>

                                <div class="mt-10 pt-6 border-t border-white/20">
                                    <p class="text-sm text-white/70">© {{ date('Y') }} OpenBook Academic Editorial.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
