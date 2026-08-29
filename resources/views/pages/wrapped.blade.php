@extends('layouts.app')

@section('title', 'Our Friendship Wrapped · A Little Place for You, from Me')

@section('content')
    <section class="grain relative overflow-hidden bg-linear-to-b from-ink via-deep to-sea px-6 pt-16 pb-24 text-white sm:pt-24">
        <div aria-hidden="true" class="pointer-events-none absolute -right-24 top-24 h-72 w-72 rounded-full bg-blue/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-4xl">
            <x-section-heading tone="dark" eyebrow="press play" title="Our Friendship Wrapped" />

            <div class="no-scrollbar mt-8 flex gap-2 overflow-x-auto pb-2">
                @foreach ($years as $year)
                    <a href="{{ route('wrapped', $year->year) }}"
                       @class([
                           'shrink-0 rounded-full px-5 py-2 text-sm font-bold ring-1 ring-white/20',
                           'bg-white text-ink' => $active && $active->year === $year->year,
                           'bg-white/10 text-white' => ! $active || $active->year !== $year->year,
                       ])>{{ $year->year }}</a>
                @endforeach
            </div>

            @if ($active)
                <div class="mt-10">
                    <p class="text-[clamp(3.5rem,18vw,9rem)] font-extrabold leading-none tracking-tighter text-white/15">{{ $active->year }}</p>
                    <h3 class="-mt-6 text-3xl font-extrabold tracking-tight sm:text-5xl">{{ $active->headline }}</h3>

                    @if ($active->blurb)
                        <p class="mt-4 max-w-xl text-base leading-relaxed text-white/70 sm:text-lg">{{ $active->blurb }}</p>
                    @endif

                    @if ($active->highlights)
                        <ul class="mt-8 grid gap-3 sm:grid-cols-2">
                            @foreach ($active->highlights as $highlight)
                                <li class="reveal rounded-2xl bg-white/10 px-5 py-4 font-semibold ring-1 ring-white/15">{{ $highlight }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

            <div class="mt-16">
                <p class="hand text-3xl text-soft">the numbers, honestly counted</p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($cards as $card)
                        <x-stat-card :label="$card['label']" :value="$card['value']" :hint="$card['hint']" />
                    @endforeach
                </div>

                <p class="mt-6 text-xs text-white/40">
                    Every number here is counted from what's actually in the archive. Nothing is invented.
                </p>
            </div>
        </div>
    </section>
@endsection
