@props(['eyebrow' => null, 'title', 'lede' => null, 'tone' => 'light'])

<div {{ $attributes->class(['reveal max-w-2xl']) }}>
    @if ($eyebrow)
        <p @class(['hand text-2xl', 'text-sea' => $tone === 'light', 'text-soft' => $tone === 'dark'])>{{ $eyebrow }}</p>
    @endif

    <h2 @class([
        'mt-1 text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl md:text-5xl',
        'text-ink' => $tone === 'light',
        'text-white' => $tone === 'dark',
    ])>{{ $title }}</h2>

    @if ($lede)
        <p @class(['mt-4 text-base leading-relaxed sm:text-lg', 'text-ink/70' => $tone === 'light', 'text-white/70' => $tone === 'dark'])>
            {{ $lede }}
        </p>
    @endif
</div>
