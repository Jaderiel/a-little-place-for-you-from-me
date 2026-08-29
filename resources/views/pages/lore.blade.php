@extends('layouts.app')

@section('title', 'Justine Lore™ · A Little Place for You, from Me')

@section('content')
    <section class="mx-auto max-w-5xl px-6 pt-16 sm:pt-24">
        <x-section-heading
            eyebrow="documented, verified, unfortunately true"
            title="Justine Lore™"
            lede="A small archive of facts, nicknames and phrases that would make no sense to anyone else." />
    </section>

    <section class="mx-auto max-w-5xl px-6 py-10">
        <div class="card reveal p-6 sm:p-10" x-data="loreMachine('{{ route('lore.random') }}')">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sea/70" x-text="label ?? 'Justine lore'">Justine lore</p>
            <p class="mt-3 min-h-16 text-2xl font-extrabold leading-tight tracking-tight sm:text-3xl" aria-live="polite" x-text="value">
                Press the button. Receive lore.
            </p>

            <button type="button"
                    @click="roll()"
                    :disabled="loading"
                    class="mt-6 rounded-full bg-ink px-6 py-3 font-semibold text-white transition hover:bg-deep disabled:opacity-50">
                Tell me some Justine lore
            </button>
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-6 py-10">
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($facts as $fact)
                <div class="card reveal p-5">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-sea/70">{{ $fact->label }}</p>
                    <p class="mt-1 text-lg font-bold tracking-tight">{{ $fact->value }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <div class="card reveal p-6">
                <p class="hand text-2xl text-sea">also answers to</p>
                <ul class="mt-3 flex flex-wrap gap-2">
                    @foreach ($nicknames as $nickname)
                        <li class="rounded-full bg-mist px-3 py-1 text-sm font-semibold text-sea">{{ $nickname->value }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="card reveal p-6" x-data="tiiihhh()">
                <p class="hand text-2xl text-sea">certified vocabulary</p>
                <ul class="mt-3 space-y-2 text-ink/75">
                    @foreach ($extras as $extra)
                        <li><span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/40">{{ $extra->label }}</span><br>{{ $extra->value }}</li>
                    @endforeach
                </ul>

                <button type="button" @click="say()" class="mt-4 rounded-full bg-mist px-4 py-2 text-sm font-semibold text-sea">
                    say it out loud
                </button>
                <p x-show="shown" x-cloak x-transition class="hand mt-3 text-3xl text-blue">tiiihhh 😤</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-3xl px-6 py-16">
        <x-section-heading eyebrow="a small exam" title="How Well Do You Know Your Own Lore?" />

        <div class="card reveal mt-8 p-6 sm:p-8"
             x-data="trivia({{ $questions->toJson() }}, '{{ route('trivia.check') }}', '{{ csrf_token() }}')">
            <template x-if="!finished">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-sea/70">
                        Question <span x-text="index + 1"></span> of <span x-text="questions.length"></span>
                    </p>

                    <p class="mt-2 text-xl font-extrabold tracking-tight sm:text-2xl" x-text="current.question"></p>

                    <ul class="mt-5 space-y-2">
                        <template x-for="(option, i) in current.options" :key="i">
                            <li>
                                <button type="button"
                                        @click="choose(i)"
                                        class="w-full rounded-2xl border px-4 py-3 text-left font-medium transition"
                                        :class="{
                                            'border-green-500 bg-green-50': answered && i === correctIndex,
                                            'border-red-400 bg-red-50': answered && i === chosen && i !== correctIndex,
                                            'border-ink/10 hover:border-blue hover:bg-mist/60': !answered,
                                            'border-ink/10 opacity-60': answered && i !== correctIndex && i !== chosen,
                                        }"
                                        x-text="option"></button>
                            </li>
                        </template>
                    </ul>

                    <div x-show="answered" x-cloak class="mt-5">
                        <p class="hand text-2xl text-sea" x-text="response"></p>
                        <button type="button" @click="next()" class="mt-3 rounded-full bg-ink px-6 py-3 font-semibold text-white hover:bg-deep">
                            Next →
                        </button>
                    </div>
                </div>
            </template>

            <template x-if="finished">
                <div class="text-center">
                    <p class="text-5xl font-extrabold tracking-tight"><span x-text="score"></span>/<span x-text="questions.length"></span></p>
                    <p class="hand mt-3 text-3xl text-sea" x-text="verdict"></p>
                    <button type="button" @click="restart()" class="mt-6 rounded-full bg-ink px-6 py-3 font-semibold text-white hover:bg-deep">
                        Try again
                    </button>
                </div>
            </template>
        </div>
    </section>

    <section class="grain relative overflow-hidden bg-ink px-6 py-20 text-white">
        <div class="relative mx-auto max-w-2xl text-center" x-data="badDay('{{ route('bad-day') }}')">
            <x-section-heading class="mx-auto text-center" tone="dark" eyebrow="emergency use only" title="If You're Having a Bad Day" />

            <button type="button"
                    @click="open()"
                    :disabled="loading"
                    class="mt-8 rounded-full bg-white px-7 py-4 font-bold text-ink transition hover:bg-mist disabled:opacity-60">
                Open this if today sucks.
            </button>

            <p x-show="opened" x-cloak x-transition class="hand mt-8 text-3xl leading-snug text-soft" aria-live="polite" x-text="message"></p>

            <button type="button" x-show="opened" x-cloak @click="open()" class="mt-4 text-sm font-semibold text-white/50 underline-offset-4 hover:underline">
                another one
            </button>
        </div>
    </section>

    <section class="mx-auto max-w-3xl px-6 py-16 text-center" x-data="pikachu()">
        <button type="button" @click="zap()" class="hand text-2xl text-ink/30 hover:text-sea" aria-label="A small hidden reference">
            ⚡
        </button>
        <p x-show="found" x-cloak x-transition class="hand mt-2 text-2xl text-sea">Justine Marco for three! ⚡</p>
    </section>
@endsection
