<x-app-layout>
    <div class="py-16 bg-surface min-h-[80vh] flex items-center justify-center">
        <div class="max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-on-surface mb-4">{{ __('messages.login_choice_title') }}</h1>
                <p class="text-on-surface-variant text-lg">{{ __('messages.login_choice_desc') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Estudiante Card -->
                <a href="{{ route('login.student') }}"
                    class="group block p-10 bg-white rounded-[2rem] border border-outline-variant/20 hover:border-primary hover:shadow-2xl hover:shadow-primary/10 transition-all hover:-translate-y-2 text-center">
                    <div
                        class="w-24 h-24 mx-auto bg-primary/10 rounded-full flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-on-surface mb-3">{{ __('messages.login_choice_student_title') }}
                    </h2>
                    <p class="text-on-surface-variant">{{ __('messages.login_choice_student_desc') }}</p>
                </a>

                <!-- Tutor Card -->
                <a href="{{ route('login.tutor') }}"
                    class="group block p-10 bg-white rounded-[2rem] border border-outline-variant/20 hover:border-secondary hover:shadow-2xl hover:shadow-secondary/10 transition-all hover:-translate-y-2 text-center">
                    <div
                        class="w-24 h-24 mx-auto bg-secondary/10 rounded-full flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-on-surface mb-3">{{ __('messages.login_choice_tutor_title') }}
                    </h2>
                    <p class="text-on-surface-variant">{{ __('messages.login_choice_tutor_desc') }}</p>
                </a>
            </div>

            <div class="mt-12 text-center">
                <p class="text-on-surface-variant">
                    {{ __('messages.login_no_account') }} <a href="{{ route('register') }}"
                        class="text-primary font-bold hover:underline">{{ __('messages.login_register') }}</a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
