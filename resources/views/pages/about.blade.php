@extends('layouts.app')

@section('title', 'Things I Like About You · A Little Place for You, from Me')

@section('content')
    <section class="mx-auto max-w-5xl px-6 pt-16 sm:pt-24">
        <x-section-heading
            eyebrow="the list"
            title="Things I Like About You"
            lede="Not everything needs a big reason. Sometimes, I just like the little things about you." />
    </section>

    <section class="mx-auto max-w-5xl px-6 py-10">
        <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($things as $thing)
                <li class="card reveal p-6">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-base font-extrabold leading-snug tracking-tight">{{ $thing->title }}</p>
                        <span aria-hidden="true" class="text-2xl">{{ $thing->emoji }}</span>
                    </div>

                    @if ($thing->body)
                        <p class="mt-3 text-sm leading-relaxed text-ink/65">{{ $thing->body }}</p>
                    @endif

                    <p class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-sea/50">#{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                </li>
            @endforeach
        </ul>

        <p class="hand mt-8 text-center text-3xl text-sea">So it's not just me. Apparently everyone agrees.</p>
    </section>

    <section class="grain relative overflow-hidden bg-ink px-6 py-20 text-white">
        <div class="relative mx-auto max-w-2xl">
            <x-section-heading tone="dark" eyebrow="no conditions attached" title="If You Ever Need Me" />

            <div class="mt-8 space-y-4 text-lg leading-relaxed text-white/80">
                <p>I hope you know you don't always have to carry everything alone.</p>
                <p>You don't have to explain everything. You don't have to be okay all the time.</p>
                <p>If you ever need someone to listen, laugh with, walk around with, or simply sit beside you...</p>
                <p class="hand text-4xl text-soft">I'm here.</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-2xl px-6 py-20 text-center">
        <div class="space-y-4 text-lg leading-relaxed text-ink/75">
            <p>And that's our little collection so far.</p>
            <p>I'm sure there will be more.</p>
            <p>More random days. More pictures. More conversations. More memories that don't seem important at the time but somehow become the ones we remember.</p>
            <p>So this isn't really the end. It's just the latest page.</p>
            <p class="hand text-3xl text-sea">— from me, to you. 🩵</p>
        </div>

        <h2 class="mt-12 text-3xl font-extrabold tracking-tight sm:text-4xl">A Little Place for You, from Me</h2>
        <p class="hand mt-2 text-2xl text-ink/50">See you in the next memory.</p>

        <div class="mt-10" x-data="tapCounter('You really like this picture, huh?')">
            <button type="button" @click="tap()" class="polaroid mx-auto block w-40" aria-label="A picture of us">
                <div class="flex aspect-square items-center justify-center rounded-xl bg-mist text-3xl" aria-hidden="true">🐶</div>
                <span class="hand mt-2 block text-lg text-ink/60">kevin, probably</span>
            </button>

            <p x-show="message" x-cloak x-transition class="hand mt-4 text-2xl text-sea" x-text="message"></p>
        </div>
    </section>
@endsection
