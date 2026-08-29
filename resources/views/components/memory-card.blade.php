@props(['memory'])

<article class="card reveal p-6 sm:p-8">
    <p class="hand text-2xl text-sea">{{ $memory->category ?? 'A memory' }}</p>
    <h3 class="mt-1 text-2xl font-extrabold tracking-tight">{{ $memory->title }}</h3>

    @if ($memory->date)
        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-ink/40">{{ $memory->date->format('F j, Y') }}</p>
    @endif

    @if ($memory->description)
        <div class="mt-4 space-y-3 text-base leading-relaxed text-ink/75">
            @foreach (preg_split('/\n+/', $memory->description) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    @endif
</article>
