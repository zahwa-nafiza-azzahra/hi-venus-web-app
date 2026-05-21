@props(['status', 'label' => null, 'size' => 'md'])

@php
    $statusColors = [
        'menunggu_pembayaran' => 'bg-secondary-container text-on-secondary-container',
        'terkonfirmasi' => 'bg-primary-fixed-dim text-on-primary-fixed-variant',
        'selesai' => 'bg-surface-container-highest text-on-surface-variant',
        'dibatalkan' => 'bg-error-container text-on-error-container',
        'refund' => 'bg-tertiary-fixed text-on-tertiary-fixed-variant',
    ];

    $sizeClasses = [
        'sm' => 'px-2 py-1 text-[10px]',
        'md' => 'px-3 py-1 text-[10px]',
        'lg' => 'px-4 py-2 text-sm',
    ];

    $statusClass = $statusColors[$status] ?? 'bg-surface-container-highest text-on-surface-variant';
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    
    $showPulse = in_array($status, ['menunggu_pembayaran', 'terkonfirmasi']);
    $displayLabel = $label ?? $attributes->get('default', '');
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 $sizeClass $statusClass font-black uppercase rounded-full tracking-tighter"]) }}>
    @if($showPulse)
        <span class="w-1.5 h-1.5 bg-current rounded-full animate-pulse"></span>
    @endif
    {{ $displayLabel ?: $slot }}
</span>


