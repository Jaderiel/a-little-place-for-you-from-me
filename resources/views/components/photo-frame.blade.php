@props(['photo' => null, 'alt' => null, 'ratio' => 'aspect-[4/5]', 'eager' => false])

@if ($photo?->image_path)
    <img src="{{ $photo->url() }}"
         alt="{{ $alt ?? $photo->title ?? 'A photo from our memories' }}"
         loading="{{ $eager ? 'eager' : 'lazy' }}"
         decoding="async"
         {{ $attributes->class(['w-full rounded-2xl object-cover', $ratio]) }}>
@else
    <div {{ $attributes->class(['flex w-full flex-col items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-sea/30 bg-mist/60 p-6 text-center', $ratio]) }}
         role="img"
         aria-label="Placeholder — photo not added yet">
        <span aria-hidden="true" class="text-3xl">🖼️</span>
        <p class="hand text-xl text-sea">photo goes here</p>
        <p class="text-[11px] font-medium uppercase tracking-widest text-sea/60">placeholder</p>
    </div>
@endif
