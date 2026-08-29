@props(['event', 'index' => 0])

<article class="reveal relative pl-10 sm:pl-14">
    <span aria-hidden="true" class="absolute left-2 top-2 h-4 w-4 -translate-x-1/2 rounded-full bg-blue ring-4 ring-mist sm:left-3"></span>

    <p class="text-xs font-bold uppercase tracking-[0.2em] text-sea/70">
        {{ $event->date->format('F j, Y') }}
        @if ($event->location)
            <span class="text-ink/30">·</span> {{ $event->location }}
        @endif
    </p>

    <h3 class="mt-2 text-2xl font-extrabold tracking-tight sm:text-3xl">{{ $event->title }}</h3>

    @if ($event->story)
        <div class="mt-3 space-y-3 text-base leading-relaxed text-ink/75">
            @foreach (preg_split('/\n+/', $event->story) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    @endif

    @if ($event->quote)
        <p class="hand mt-4 text-2xl text-sea">“{{ $event->quote }}”</p>
    @endif

    @if ($event->photos->isNotEmpty())
        <div class="mt-5 grid gap-4 sm:grid-cols-2">
            @foreach ($event->photos as $photo)
                <figure class="polaroid" style="transform: rotate({{ $loop->even ? '1' : '-1' }}deg)">
                    <x-photo-frame :photo="$photo" :alt="$event->title" ratio="aspect-[4/3]" />
                    <figcaption class="hand mt-2 px-1 text-lg text-ink/60">{{ $photo->caption ?? $event->title }}</figcaption>
                </figure>
            @endforeach
        </div>
    @endif
</article>
