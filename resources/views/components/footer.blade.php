<footer class="bg-surface-container-low mt-20 border-t border-outline-variant/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xl">O</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold tracking-tight text-on-surface leading-none">Open<span class="text-primary">Book</span></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-primary/80 mt-0.5">La Academia Digital</span>
                    </div>
                </div>
                <p class="text-on-surface-variant max-w-xs leading-relaxed">
                    {{ __('messages.footer_desc') }}
                </p>
            </div>
            
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider mb-6">{{ __('messages.footer_explore') }}</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('dashboard.search') }}" class="text-on-surface-variant hover:text-primary transition-colors">{{ __('messages.footer_tutorings') }}</a></li>
                    <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors">{{ __('messages.footer_material') }}</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider mb-6">{{ __('messages.footer_support') }}</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors">{{ __('messages.footer_contact') }}</a></li>
                    <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors">{{ __('messages.footer_policies') }}</a></li>
                    <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors">{{ __('messages.footer_faq') }}</a></li>
                </ul>
            </div>
        </div>
        
        <div class="mt-16 pt-8 border-t border-outline-variant/10 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-sm text-on-surface-variant">
                {{ __('messages.footer_rights', ['year' => date('Y')]) }}
            </p>
            <div class="flex space-x-6">
                <!-- Social Icons would go here -->
            </div>
        </div>
    </div>
</footer>

