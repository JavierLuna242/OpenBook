@props(['title' => '', 'description' => ''])

<div {{ $attributes->merge(['class' => 'card-editorial']) }}>
    @if($title)
        <h3 class="text-xl font-bold mb-3 text-on-surface">{{ $title }}</h3>
    @endif
    
    @if($description)
        <p class="text-on-surface-variant leading-relaxed mb-4">{{ $description }}</p>
    @endif

    {{ $slot }}
</div>
