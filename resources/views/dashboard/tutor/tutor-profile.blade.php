<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Sidebar -->


                <!-- Main Content -->
                <div class="flex-1" x-data="{ editModal: false }">
                    <!-- Profile Header -->
                    <div class="relative mb-12">
                        <div
                            class="h-48 bg-gradient-to-r from-primary to-secondary rounded-3xl overflow-hidden relative">
                            <!-- Pattern overlay -->
                            <div class="absolute inset-0 opacity-10">
                                <svg width="100%" height="100%" fill="none" viewBox="0 0 400 400">
                                    <defs>
                                        <pattern id="grid-tutor-profile" width="40" height="40"
                                            patternUnits="userSpaceOnUse">
                                            <path d="M 40 0 L 0 0 0 40" stroke="white" stroke-width="1" />
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#grid-tutor-profile)" />
                                </svg>
                            </div>
                        </div>

                        <div class="absolute -bottom-16 left-8 flex items-end">
                            <div
                                class="w-32 h-32 bg-white rounded-2xl shadow-xl flex items-center justify-center border-4 border-white overflow-hidden">
                                @if ($user->profile_photo_path)
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full bg-primary-container/10 flex items-center justify-center text-4xl font-bold text-primary-container">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-6 -mb-4">
                                <h1 class="text-3xl font-extrabold text-on-surface">{{ $user->name }}</h1>
                                <p class="text-secondary font-medium">
                                    {{ $user->program ?? __('messages.tutor_profile_default') }}</p>
                            </div>
                        </div>

                        <div class="absolute top-4 right-4 flex gap-2">
                            <button @click="editModal = true"
                                class="bg-white/20 hover:bg-white/30 backdrop-blur-md text-white p-2 rounded-xl transition-colors shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    @if (session('success'))
                        <div
                            class="mt-20 mb-4 p-4 bg-primary-container text-white rounded-xl text-sm font-bold flex items-center shadow-md">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-8">

                        <!-- Left Column: Main Info -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Professional Presentation -->
                            <x-card class="!p-8 border border-outline-variant/10">
                                <h3 class="text-xl font-bold text-on-surface mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-primary-container" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    {{ __('messages.tutor_profile_presentation') }}
                                </h3>
                                <div class="text-on-surface-variant leading-relaxed">
                                    <p>{{ $user->bio ?? __('messages.tutor_profile_no_bio') }}</p>
                                </div>
                            </x-card>

                            <!-- Academic Info -->
                            <x-card class="!p-8 border border-outline-variant/10">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-on-surface">
                                        {{ __('messages.tutor_profile_academic') }}</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.tutor_profile_program') }}</label>
                                        <div class="font-medium text-on-surface">
                                            {{ $user->program ?? __('messages.tutor_profile_not_specified') }}</div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.tutor_profile_cedula') }}</label>
                                        <div class="font-medium text-on-surface">
                                            {{ $user->cedula ?? __('messages.tutor_profile_not_specified') }}</div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.tutor_profile_email') }}</label>
                                        <div class="font-medium text-on-surface">{{ $user->email }}</div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('messages.tutor_profile_member_since') }}</label>
                                        <div class="font-medium text-on-surface">{{ $user->created_at->format('M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                        </div>

                        <!-- Right Column: Sidebar Info -->
                        <div class="space-y-8">
                            <!-- Performance Stats -->
                            <x-card class="!p-6 border border-secondary/20 bg-secondary/5 text-center">
                                <h3 class="text-sm font-bold text-on-surface-variant uppercase tracking-wider mb-4">
                                    {{ __('messages.tutor_profile_performance') }}</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-2xl font-extrabold text-secondary">0</div>
                                        <div class="text-xs text-on-surface-variant">
                                            {{ __('messages.tutor_profile_given') }}</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-extrabold text-primary-container">
                                            {{ $tutoringsCount }}</div>
                                        <div class="text-xs text-on-surface-variant">
                                            {{ __('messages.tutor_profile_published') }}</div>
                                    </div>
                                </div>
                            </x-card>

                            <!-- Recent Activity -->
                            <x-card class="!p-6 border border-outline-variant/10">
                                <h3 class="text-lg font-bold text-on-surface mb-4">
                                    {{ __('messages.tutor_profile_activity') }}</h3>
                                <ul class="space-y-4">
                                    @forelse($recentTutorings as $tutoring)
                                        <li class="flex items-start">
                                            <div
                                                class="w-8 h-8 rounded-full bg-secondary/10 text-secondary flex items-center justify-center mr-3 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-on-surface text-sm">
                                                    {{ __('messages.tutor_profile_tut_published') }}</h4>
                                                <p class="text-xs text-on-surface-variant">"{{ $tutoring->title }}"</p>
                                                <p class="text-[10px] text-on-surface-variant/60 uppercase">
                                                    {{ $tutoring->created_at->diffForHumans() }}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-center py-4 text-on-surface-variant text-sm italic">
                                            {{ __('messages.tutor_profile_no_activity') }}
                                        </li>
                                    @endforelse
                                </ul>
                            </x-card>
                        </div>

                        <!-- Edit Profile Modal -->
                        <div x-show="editModal"
                            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100" x-cloak>

                            <div class="bg-white rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl"
                                @click.away="editModal = false">
                                <div class="bg-gradient-to-r from-primary to-secondary p-6 text-white">
                                    <h3 class="text-xl font-bold">{{ __('messages.tutor_profile_edit_title') }}</h3>
                                    <p class="text-white/80 text-sm">{{ __('messages.tutor_profile_edit_subtitle') }}
                                    </p>
                                </div>

                                <form action="{{ route('dashboard.tutor.profile.update') }}" method="POST"
                                    enctype="multipart/form-data" class="p-8 space-y-6">
                                    @csrf

                                    <div>
                                        <label
                                            class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.tutor_profile_photo') }}</label>
                                        <input type="file" name="photo" accept="image/*"
                                            class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-secondary file:text-white hover:file:bg-secondary/90 transition-colors cursor-pointer">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.tutor_profile_name') }}</label>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary text-sm">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.tutor_profile_program_label') }}</label>
                                        <input type="text" name="program" value="{{ $user->program }}"
                                            class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary text-sm">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-bold text-on-surface mb-2">{{ __('messages.tutor_profile_bio_label') }}</label>
                                        <textarea name="bio" rows="4"
                                            class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary text-sm resize-none">{{ $user->bio }}</textarea>
                                    </div>

                                    <div class="flex gap-4 pt-4">
                                        <button type="button" @click="editModal = false"
                                            class="flex-1 px-6 py-3 bg-surface-container rounded-xl font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                                            {{ __('messages.tutor_profile_cancel') }}
                                        </button>
                                        <button type="submit"
                                            class="flex-1 px-6 py-3 bg-secondary text-white rounded-xl font-bold shadow-lg shadow-secondary/30 hover:bg-secondary/90 transition-colors">
                                            {{ __('messages.tutor_profile_save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
