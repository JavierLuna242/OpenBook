<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">

                <div class="flex-1" x-data="{ editModal: false }" x-init="$watch('editModal', value => { if (value) document.body.classList.add('overflow-hidden'); else document.body.classList.remove('overflow-hidden'); })">
                    <!-- Profile Header -->
                    <div class="relative mb-12">
                        <div class="h-48 bg-gradient-to-r from-primary to-secondary rounded-3xl overflow-hidden relative">
                            <div class="absolute inset-0 opacity-10">
                                <svg width="100%" height="100%" fill="none" viewBox="0 0 400 400">
                                    <defs><pattern id="grid-profile" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" stroke="white" stroke-width="1"/></pattern></defs>
                                    <rect width="100%" height="100%" fill="url(#grid-profile)" />
                                </svg>
                            </div>
                        </div>
                        <div class="absolute -bottom-16 left-8 flex items-end">
                            <div class="w-32 h-32 bg-white rounded-2xl shadow-xl flex items-center justify-center border-4 border-white overflow-hidden">
                                @if($user->profile_photo_path)
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-surface-container-high flex items-center justify-center text-4xl font-bold text-on-surface-variant">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-6 -mb-4">
                                <h1 class="text-3xl font-extrabold text-on-surface">{{ $user->name }}</h1>
                                <p class="text-primary font-medium">{{ $user->program ?? __('messages.profile_default_program') }}</p>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 flex gap-2">
                            <button @click="editModal = true" class="bg-white/20 hover:bg-white/30 backdrop-blur-md text-white p-2 rounded-xl transition-colors shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="mt-20 mb-4 p-4 bg-primary text-white rounded-xl text-sm font-bold flex items-center shadow-md border border-primary/20">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Main Info -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- About Me -->
                            <x-card class="!p-8 border border-outline-variant/10">
                                <h3 class="text-xl font-bold text-on-surface mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ __('messages.profile_about') }}
                                </h3>
                                <div class="text-on-surface-variant leading-relaxed">
                                    <p>{{ $user->bio ?? __('messages.profile_no_bio') }}</p>
                                </div>
                            </x-card>

                            <!-- Academic Info -->
                            <x-card class="!p-8 border border-outline-variant/10">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-on-surface">{{ __('messages.profile_academic_info') }}</h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.profile_program') }}</label>
                                        <div class="font-medium text-on-surface">{{ $user->program ?? __('messages.profile_not_specified') }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.profile_student_id') }}</label>
                                        <div class="font-medium text-on-surface">{{ $user->student_id ?? __('messages.profile_not_specified') }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.profile_email') }}</label>
                                        <div class="font-medium text-on-surface">{{ $user->email }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.profile_member_since') }}</label>
                                        <div class="font-medium text-on-surface">{{ $user->created_at->format('M Y') }}</div>
                                    </div>
                                </div>
                            </x-card>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-8">
                            <x-card class="!p-6 border border-primary/20 bg-primary/5 text-center">
                                <h3 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-4">Mi Actividad</h3>
                                <div class="flex justify-center items-center">
                                    <div>
                                        <div class="text-3xl font-extrabold text-primary">{{ sprintf('%02d', $myBookingsCount) }}</div>
                                        <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wide mt-1">Tutorías Tomadas</div>
                                    </div>
                                </div>
                            </x-card>

                            <x-card class="!p-6 border border-outline-variant/10">
                                <h3 class="text-lg font-bold text-on-surface mb-4">Actividad Reciente</h3>
                                <ul class="space-y-4">
                                    @forelse($recentActivity as $activity)
                                        <li class="flex items-start">
                                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-on-surface text-sm">Sesión Agendada</h4>
                                                <p class="text-xs text-on-surface-variant">"{{ __('messages.subject_' . Str::slug($activity->tutoring->subject, '_')) }}"</p>
                                                <p class="text-[10px] text-on-surface-variant/60 uppercase mt-0.5">{{ $activity->created_at->diffForHumans() }}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-center py-4 text-on-surface-variant text-sm italic">
                                            Sin actividad reciente
                                        </li>
                                    @endforelse
                                </ul>
                            </x-card>
                        </div>
                    </div>

                    <!-- Edit Profile Modal -->
                    <div x-show="editModal"
                         class="fixed inset-0 z-50 flex items-start justify-center p-4 bg-black/50 backdrop-blur-sm overflow-y-auto"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-cloak>
                        <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl my-auto flex flex-col overflow-hidden" @click.away="editModal = false">
                            <!-- Modal Header -->
                            <div class="bg-gradient-to-r from-primary to-secondary p-6 text-white flex-shrink-0">
                                <h3 class="text-xl font-bold">{{ __('messages.profile_edit_title') }}</h3>
                                <p class="text-white/80 text-sm">{{ __('messages.profile_edit_subtitle') }}</p>
                            </div>
                            
                            <!-- Modal Form -->
                            <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 overflow-y-auto max-h-[70vh]">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.profile_photo') }}</label>
                                    <input type="file" name="photo" accept="image/*" class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary file:text-white hover:file:bg-primary-dark transition-colors cursor-pointer">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.profile_name') }}</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.profile_academic_prog') }}</label>
                                    <input type="text" name="program" value="{{ $user->program }}" class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.profile_bio_label') }}</label>
                                    <textarea name="bio" rows="4" class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary text-sm resize-none">{{ $user->bio }}</textarea>
                                </div>
                                <div class="flex gap-4 pt-4 sticky bottom-0 bg-white">
                                    <button type="button" @click="editModal = false" class="flex-1 px-6 py-3 bg-surface-container rounded-xl font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                                        {{ __('messages.profile_cancel') }}
                                    </button>
                                    <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/30 hover:bg-primary-dark transition-colors">
                                        {{ __('messages.profile_save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
