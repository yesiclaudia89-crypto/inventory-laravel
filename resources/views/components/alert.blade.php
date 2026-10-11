@props(['type' => 'info'])

@php
    $classes = match($type) {
        'success' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400',
        'danger', 'error' => 'bg-rose-500/10 border-rose-500/30 text-rose-400',
        'warning' => 'bg-amber-500/10 border-amber-500/30 text-amber-400',
        default => 'bg-cyan-500/10 border-cyan-500/30 text-cyan-400',
    };
    $icon = match($type) {
        'success' => 'fa-circle-check',
        'danger', 'error' => 'fa-circle-xmark',
        'warning' => 'fa-triangle-exclamation',
        default => 'fa-circle-info',
    };
@endphp

<div {{ $attributes->merge(['class' => "p-4 rounded-xl border flex items-start space-x-3 text-sm $classes"]) }}>
    <i class="fa-solid {{ $icon }} text-lg mt-0.5"></i>
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
