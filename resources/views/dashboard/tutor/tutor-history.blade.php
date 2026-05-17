<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Sidebar -->


                <!-- Main Content -->
                <div class="flex-1">
                    <div class="mb-10">
                        <h1 class="text-3xl font-extrabold text-on-surface mb-2">{{ __('messages.tutor_hist_title') }}</h1>
                        <p class="text-on-surface-variant text-lg">{{ __('messages.tutor_hist_subtitle') }}</p>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                        <x-card class="!p-5 text-center">
                            <div class="text-3xl font-bold text-primary mb-1">{{ $myTutoringOffers->count() }}</div>
                            <div class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                {{ __('messages.tutor_stat_tutorings') }}</div>
                        </x-card>
                        <x-card class="!p-5 text-center">
                            <div class="text-3xl font-bold text-secondary mb-1">{{ $completedBookings->count() }}</div>
                            <div class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                Tutorías Dadas</div>
                        </x-card>
                        <x-card class="!p-5 text-center border border-green-500/30 bg-green-500/5">
                            <div class="text-3xl font-bold text-green-600 mb-1">Gratis</div>
                            <div class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                Costo de Servicio</div>
                        </x-card>
                    </div>

                    <!-- Actividades Recientes -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-outline-variant/20 mb-10">
                        <div
                            class="px-6 py-4 border-b border-outline-variant/20 flex justify-between items-center bg-surface-container-low/50">
                            <h3 class="font-bold text-on-surface">{{ __('messages.history_my_activities') }}</h3>
                            <span
                                class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">{{ __('messages.history_showing', ['count' => $completedBookings->count()]) }}</span>
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
                                        <th class="px-6 py-4 text-right">Costo</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/10">
                                    <!-- Tutorías Dadas -->
                                    @foreach ($completedBookings as $booking)
                                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                                            <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">
                                                {{ $booking->created_at->format('d M, Y') }}</td>
                                            <td class="px-6 py-4"><span
                                                    class="text-xs font-bold text-blue-600 uppercase tracking-tighter">{{ __('messages.history_type_tutoring') }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-on-surface">{{ $booking->tutoring->subject }}</div>
                                                <div class="text-xs text-on-surface-variant">
                                                    {{ __('messages.tutor_hist_student') }}: {{ $booking->student->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ __('messages.tutor_hist_paid') }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-bold text-success">
                                                {{ __('messages.price_free') }}</td>
                                        </tr>
                                    @endforeach

                                    @if ($completedBookings->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-20 text-center text-on-surface-variant italic">
                                                {{ __('messages.history_empty') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @if ($completedBookings->hasPages())
                            <div class="px-6 py-4 border-t border-outline-variant/20 bg-surface-container-low/30">
                                {{ $completedBookings->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
