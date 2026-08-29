@extends('layouts.app')

@section('title', 'Something I Never Said')

@section('content')
    <section class="grain relative min-h-[90dvh] overflow-hidden bg-linear-to-b from-[#050d20] via-ink to-deep px-6 py-24 text-white">
        <div aria-hidden="true" class="pointer-events-none absolute left-1/2 top-10 h-72 w-72 -translate-x-1/2 rounded-full bg-sea/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-xl">
            @foreach ($notes as $note)
                @if ($note->heading)
                    <h1 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl">{{ $note->heading }}</h1>
                @endif

                <div @class(['space-y-5 leading-relaxed', 'mt-8 text-lg text-white/85' => $loop->first, 'mt-14 border-t border-white/10 pt-8 text-sm text-white/50' => ! $loop->first])>
                    @foreach (preg_split('/\n+/', $note->body) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            @endforeach

            <form method="POST" action="{{ route('secret.lock') }}" class="mt-16">
                @csrf
                <button type="submit" class="rounded-full bg-white/10 px-5 py-3 text-sm font-semibold text-white/70 hover:bg-white/20">
                    Close this and lock it again
                </button>
            </form>
        </div>
    </section>
@endsection
