@extends('layouts.app')

@section('title', 'Memories · A Little Place for You, from Me')

@section('content')
    @php
        $lightboxPhotos = $photos->map(fn ($photo) => [
            'url' => $photo->url(),
            'title' => $photo->title,
            'caption' => $photo->caption,
            'date' => $photo->date_taken?->format('F j, Y'),
            'category' => $photo->category,
            'location' => $photo->location,
        ])->values();
    @endphp

    <section class="mx-auto max-w-5xl px-6 pt-16 sm:pt-24">
        <x-section-heading
            eyebrow="the archive"
            title="Memories"
            lede="Pictures, half-pictures, and the ones still waiting to be uploaded." />
    </section>

    <section class="mx-auto max-w-5xl px-6 py-10" x-data="gallery({{ $lightboxPhotos->toJson() }})">
        <div class="no-scrollbar -mx-6 flex gap-2 overflow-x-auto px-6 pb-2">
            <a href="{{ route('memories') }}"
               @class([
                   'shrink-0 rounded-full px-4 py-2 text-sm font-semibold ring-1 ring-ink/10',
                   'bg-ink text-white' => ! $activeCategory,
                   'bg-white text-ink/70' => $activeCategory,
               ])>All</a>

            @foreach ($categories as $category)
                <a href="{{ route('memories', ['category' => $category]) }}"
                   @class([
                       'shrink-0 rounded-full px-4 py-2 text-sm font-semibold ring-1 ring-ink/10',
                       'bg-ink text-white' => $activeCategory === $category,
                       'bg-white text-ink/70' => $activeCategory !== $category,
                   ])>{{ $category }}</a>
            @endforeach
        </div>

        @if ($photos->isEmpty())
            <p class="mt-10 text-center text-ink/50">Nothing in this category yet.</p>
        @else
            <ul class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3">
                @foreach ($photos as $photo)
                    <li>
                        <button type="button"
                                @click="show({{ $loop->index }})"
                                class="group block w-full text-left"
                                aria-label="Open {{ $photo->title ?? 'photo' }}">
                            <x-photo-frame :photo="$photo" :alt="$photo->title" ratio="aspect-square" class="transition group-hover:brightness-95" />
                            <p class="mt-2 truncate text-sm font-semibold">{{ $photo->title ?? 'Untitled' }}</p>
                            <p class="truncate text-xs text-ink/50">{{ $photo->category }}</p>
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif

        <div x-show="open"
             x-cloak
             @keydown.window.escape="close()"
             @keydown.window.arrow-right="next()"
             @keydown.window.arrow-left="previous()"
             @touchstart="onTouchStart($event)"
             @touchend="onTouchEnd($event)"
             class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-ink/95 p-4"
             role="dialog"
             aria-modal="true">
            <button type="button" @click="close()" class="absolute right-4 top-4 rounded-full bg-white/10 px-4 py-2 text-white" aria-label="Close">✕</button>

            <template x-if="photo">
                <figure class="max-h-[80dvh] w-full max-w-3xl text-center">
                    <template x-if="photo.url">
                        <img :src="photo.url" :alt="photo.title ?? 'Photo'" class="mx-auto max-h-[65dvh] rounded-2xl object-contain">
                    </template>

                    <template x-if="!photo.url">
                        <div class="mx-auto flex aspect-4/3 max-h-[65dvh] w-full items-center justify-center rounded-2xl border-2 border-dashed border-white/25 text-white/60">
                            Photo not added yet
                        </div>
                    </template>

                    <figcaption class="mt-4 text-white">
                        <p class="text-lg font-bold" x-text="photo.title ?? 'Untitled'"></p>
                        <p class="text-sm text-white/60" x-text="[photo.date, photo.location, photo.category].filter(Boolean).join(' · ')"></p>
                        <p class="hand mt-2 text-2xl text-soft" x-text="photo.caption"></p>
                    </figcaption>
                </figure>
            </template>

            <div class="mt-6 flex gap-3">
                <button type="button" @click="previous()" class="rounded-full bg-white/10 px-5 py-3 text-white" aria-label="Previous photo">←</button>
                <button type="button" @click="next()" class="rounded-full bg-white/10 px-5 py-3 text-white" aria-label="Next photo">→</button>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-3xl space-y-6 px-6 py-16">
        <x-section-heading eyebrow="stories without a date" title="Small Operations & Big Moments" />

        @foreach ($memories as $memory)
            <x-memory-card :memory="$memory" />
        @endforeach
    </section>
@endsection
