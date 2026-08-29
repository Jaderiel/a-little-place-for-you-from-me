@extends('layouts.app')

@section('title', 'Our Story · A Little Place for You, from Me')

@section('content')
    <section class="mx-auto max-w-3xl px-6 pt-16 pb-6 sm:pt-24">
        <x-section-heading
            eyebrow="the long version"
            title="Our Story"
            lede="Some of it is important. Some of it is just a dog walk. Both count." />
    </section>

    <section class="mx-auto max-w-3xl px-6 pb-10">
        <div class="relative space-y-14 border-l-2 border-mist pl-1 sm:pl-2">
            @foreach ($events as $event)
                @if ($event->is_cinematic)
                    <x-timeline-card :event="$event" :index="$loop->index" class="rounded-3xl bg-linear-to-b from-mist/70 to-transparent py-8 pr-4" />
                @else
                    <x-timeline-card :event="$event" :index="$loop->index" />
                @endif
            @endforeach
        </div>
    </section>

    @if ($stayedWithMe)
        <section class="grain relative mt-20 overflow-hidden bg-ink px-6 py-20 text-white">
            <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 mx-auto h-64 w-64 rounded-full bg-sea/40 blur-3xl"></div>

            <div class="relative mx-auto max-w-2xl text-center">
                <x-section-heading
                    class="mx-auto text-center"
                    tone="dark"
                    eyebrow="quietly important"
                    title="One Memory That Stayed With Me" />

                <p class="hand mt-8 text-3xl leading-snug text-soft">
                    “There are some conversations you don't forget.<br>This was one of them.”
                </p>

                <p class="mx-auto mt-8 max-w-lg text-sm leading-relaxed text-white/60">
                    The story itself stays off this page — it isn't mine to tell. This section exists only so it doesn't get lost
                    among the arcade games and the halo-halo.
                </p>
            </div>
        </section>
    @endif

    @if ($song)
        <section class="mx-auto max-w-3xl px-6 py-20">
            <x-section-heading eyebrow="on repeat" title="Our Soundtrack" />

            <div class="card reveal mt-8 overflow-hidden">
                <div class="flex flex-col gap-6 p-6 sm:flex-row sm:items-center sm:p-8">
                    <div class="flex h-28 w-28 shrink-0 items-center justify-center rounded-2xl bg-linear-to-br from-sea to-blue text-4xl text-white shadow-lg">
                        @if ($song->cover_path)
                            <img src="{{ Storage::disk('public')->url($song->cover_path) }}" alt="Cover art for {{ $song->title }}" class="h-full w-full rounded-2xl object-cover" loading="lazy">
                        @else
                            ♪
                        @endif
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sea/70">Featured song</p>
                        <p class="mt-1 text-2xl font-extrabold tracking-tight">{{ $song->title }}</p>
                        <p class="text-ink/60">{{ $song->artist }}</p>

                        @if ($song->spotify_url)
                            <a href="{{ $song->spotify_url }}" target="_blank" rel="noopener"
                               class="mt-3 inline-block rounded-full bg-ink px-5 py-2 text-sm font-semibold text-white hover:bg-deep">
                                Open in Spotify
                            </a>
                        @endif
                    </div>
                </div>

                @if ($song->note)
                    <div class="space-y-3 border-t border-ink/5 bg-mist/40 p-6 text-base leading-relaxed text-ink/75 sm:p-8">
                        @foreach (preg_split('/\n+/', $song->note) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    <section class="mx-auto max-w-3xl px-6 pb-24">
        <x-section-heading eyebrow="unlocked so far" title="Friendship Achievements" />

        <div class="mt-8 grid gap-3 sm:grid-cols-2">
            @foreach ($achievements as $achievement)
                <x-achievement-card :achievement="$achievement" />
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('memories') }}" class="rounded-full bg-ink px-7 py-4 text-base font-bold text-white transition hover:bg-deep">
                Next: the photos →
            </a>
        </div>
    </section>
@endsection
