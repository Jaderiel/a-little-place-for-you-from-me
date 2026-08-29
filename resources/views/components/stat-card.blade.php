@props(['label', 'value', 'hint' => null])

<div class="reveal rounded-3xl bg-white/10 p-6 ring-1 ring-white/15">
    <p class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">{{ $value }}</p>
    <p class="mt-2 text-sm font-semibold text-soft">{{ $label }}</p>
    @if ($hint)
        <p class="mt-1 text-xs text-white/50">{{ $hint }}</p>
    @endif
</div>
