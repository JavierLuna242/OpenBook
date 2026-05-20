<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">

                <div class="flex-1">
                    <div class="mb-10">
                        <h1 class="text-3xl font-extrabold text-on-surface mb-2">{{ __('messages.history_title') }}</h1>
                        <p class="text-on-surface-variant text-lg">{{ __('messages.history_subtitle') }}</p>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                        <x-card class="!p-5 text-center">
                            <div class="text-3xl font-bold text-primary mb-1">{{ $takenTutorings->count() }}</div>
                            <div class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                {{ __('messages.history_stat_taken_tutorings') }}</div>
                        </x-card>

                        <x-card class="!p-5 text-center border border-green-500/30 bg-green-500/5">
                            <div class="text-3xl font-bold text-green-600 mb-1">
                                {{ __('messages.history_stat_account_status') }}</div>
                            <div class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                {{ __('messages.history_stat_account_balance') }}</div>
                        </x-card>
                    </div>

                    <!-- Actividades Recientes -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-outline-variant/20 mb-10">
                        <div
                            class="px-6 py-4 border-b border-outline-variant/20 flex justify-between items-center bg-surface-container-low/50">
                            <h3 class="font-bold text-on-surface">{{ __('messages.history_my_activities') }}</h3>
                            <span
                                class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">{{ __('messages.history_showing', ['count' => $takenTutorings->count()]) }}</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-surface-container-low text-on-surface-variant text-xs uppercase tracking-wider font-bold">
                                    <tr>
                                        <th class="px-6 py-4">{{ __('messages.history_col_date') }}</th>
                                        <th class="px-6 py-4">{{ __('messages.history_col_type') }}</th>
                                        <th class="px-6 py-4">{{ __('messages.history_col_title') }}</th>
                                        <th class="px-6 py-4 text-center">{{ __('messages.history_col_status') }}</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/10 text-sm">
                                    <!-- Tutorías Tomadas (Como Alumno) -->
                                    @foreach ($takenTutorings as $booking)
                                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                                            <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">
                                                {{ $booking->created_at->format('d M, Y') }}</td>
                                            <td class="px-6 py-4"><span
                                                    class="text-xs font-bold text-blue-600 uppercase tracking-tighter">{{ __('messages.history_type_tutoring') }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-on-surface">
                                                    {{ $booking->tutoring->subject }}</div>
                                                <div class="text-xs text-on-surface-variant">
                                                    {{ __('messages.pay_tutor') }}:
                                                    {{ $booking->tutoring->user->name ?? __('messages.dash_anon') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ __('messages.tutor_hist_paid') }}</span>
                                            </td>

                                        </tr>
                                    @endforeach

                                    @if ($takenTutorings->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-20 text-center text-on-surface-variant italic">
                                                {{ __('messages.history_empty') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($takenTutorings->hasPages())
                            <div class="px-6 py-4 border-t border-outline-variant/20 bg-surface-container-low/30">
                                {{ $takenTutorings->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
