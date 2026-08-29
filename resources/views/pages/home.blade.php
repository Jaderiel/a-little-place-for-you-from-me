@extends('layouts.app')

@section('title', 'A Little Place for You, from Me')

@section('content')
    <section class="grain relative flex min-h-[92dvh] flex-col justify-center overflow-hidden bg-linear-to-b from-ink via-deep to-sea px-6 py-20 text-white">
        <div aria-hidden="true" class="pointer-events-none absolute -left-24 top-10 h-64 w-64 rounded-full bg-blue/30 blur-3xl"></div>
        <div aria-hidden="true" class="pointer-events-none absolute -right-16 bottom-0 h-72 w-72 rounded-full bg-soft/20 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-3xl">
            <p class="hand text-3xl text-soft">For {{ config('friendship.name') }}.</p>

            <h1 class="mt-2 text-[clamp(2.5rem,10vw,5.5rem)] font-extrabold leading-[0.95] tracking-tight">
                A Little Place<br>for You,<br><span class="text-soft">from Me</span>
            </h1>

            <p class="mt-6 max-w-lg text-base leading-relaxed text-white/75 sm:text-lg">
                A little collection of memories, moments, and things worth remembering.
            </p>

            <div class="mt-10 rounded-3xl bg-white/10 p-6 ring-1 ring-white/15"
                 x-data="friendshipCounter('{{ $startDate->toIso8601String() }}')">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-soft">
                    We've been part of each other's story for
                </p>

                <p class="mt-3 text-2xl font-extrabold leading-tight tracking-tight sm:text-4xl" aria-live="polite">
                    <span x-text="label(parts.years, 'year')">{{ $counter['years'] }} years</span>,
                    <span x-text="label(parts.months, 'month')">{{ $counter['months'] }} months</span>,
                    <span x-text="label(parts.days, 'day')">{{ $counter['days'] }} days</span>
                </p>

                <p class="mt-2 hidden text-sm text-white/50 sm:block">
                    that's <span x-text="parts.totalDays.toLocaleString()"></span> days since April 6, 2024
                </p>
            </div>

            <div class="mt-10 flex flex-wrap items-center gap-4">
                <a href="{{ route('story') }}"
                   class="rounded-full bg-white px-7 py-4 text-base font-bold text-ink transition hover:bg-mist">
                    Start the Journey →
                </a>

                <a href="{{ route('wrapped') }}" class="text-sm font-semibold text-white/70 underline-offset-4 hover:underline">
                    or jump to our Wrapped
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-6 py-20">
        <x-section-heading
            eyebrow="Hey, Justine."
            title="I made you a little corner of the internet."
            lede="Nothing too serious. Just some memories, random things I remember, and a few things I never want to forget." />

        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $cards = [
                    ['route' => 'story', 'emoji' => '📖', 'title' => 'Our Story', 'text' => 'Everything from the first time I saw you to the latest memory.'],
                    ['route' => 'memories', 'emoji' => '📷', 'title' => 'Memories', 'text' => 'Photos, small moments, and one very well-planned halo-halo.'],
                    ['route' => 'lore', 'emoji' => '✨', 'title' => 'Justine Lore™', 'text' => 'Random facts, nicknames, and a quiz about your own life.'],
                    ['route' => 'wrapped', 'emoji' => '🎁', 'title' => 'Friendship Wrapped', 'text' => '2024, 2025, 2026 — year by year.'],
                    ['route' => 'about', 'emoji' => '🩵', 'title' => 'Things I Like About You', 'text' => 'Fifteen of them, at last count.'],
                ];
            @endphp

            @foreach ($cards as $card)
                <a href="{{ route($card['route']) }}" class="card reveal group p-6 transition hover:-translate-y-1">
                    <span aria-hidden="true" class="text-2xl">{{ $card['emoji'] }}</span>
                    <p class="mt-3 text-lg font-extrabold tracking-tight">{{ $card['title'] }}</p>
                    <p class="mt-1 text-sm text-ink/60">{{ $card['text'] }}</p>
                    <p class="mt-4 text-sm font-semibold text-sea">Open →</p>
                </a>
            @endforeach

            @if ($firstEvent)
                <div class="card reveal p-6">
                    <p class="hand text-2xl text-sea">it started here</p>
                    <p class="mt-1 text-lg font-extrabold tracking-tight">{{ $firstEvent->title }}</p>
                    <p class="mt-1 text-sm text-ink/60">{{ $firstEvent->date->format('F j, Y') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
