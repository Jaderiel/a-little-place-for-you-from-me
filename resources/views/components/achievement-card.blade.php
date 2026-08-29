@props(['achievement'])

<div @class([
    'reveal flex items-start gap-4 rounded-3xl p-5 ring-1',
    'bg-white ring-ink/5' => ! $achievement->is_locked,
    'bg-mist/40 ring-dashed ring-sea/20' => $achievement->is_locked,
])>
    <span aria-hidden="true" @class(['text-3xl', 'opacity-50' => $achievement->is_locked])>{{ $achievement->icon }}</span>

    <div>
        <p @class(['font-extrabold tracking-tight', 'text-ink/50' => $achievement->is_locked])>{{ $achievement->title }}</p>

        @if ($achievement->achieved_on)
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-sea/70">{{ $achievement->achieved_on->format('F j, Y') }}</p>
        @endif

        @if ($achievement->description)
            <p class="mt-1 text-sm text-ink/60">{{ $achievement->description }}</p>
        @endif
    </div>
</div>
