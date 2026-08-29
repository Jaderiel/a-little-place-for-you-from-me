@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-extrabold tracking-tight">Everything you can edit</h1>
    <p class="mt-2 text-ink/60">Add photos and memories here — no Blade files involved.</p>

    @if ($placeholders > 0)
        <p class="mt-6 rounded-2xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-800 ring-1 ring-amber-200">
            {{ $placeholders }} photo {{ Str::plural('slot', $placeholders) }} still {{ $placeholders === 1 ? 'has' : 'have' }} no image.
            Open <a href="{{ route('admin.resource.index', 'photos') }}" class="underline">Photos</a> to upload them.
        </p>
    @endif

    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($counts as $key => $item)
            <a href="{{ route('admin.resource.index', $key) }}" class="rounded-3xl bg-white p-6 ring-1 ring-ink/10 transition hover:-translate-y-0.5">
                <p class="text-3xl font-extrabold tracking-tight">{{ $item['count'] }}</p>
                <p class="mt-1 font-semibold text-ink/70">{{ $item['label'] }}</p>
            </a>
        @endforeach
    </div>
@endsection
