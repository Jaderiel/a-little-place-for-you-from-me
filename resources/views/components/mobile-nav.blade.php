@php
    $links = [
        ['route' => 'home', 'label' => 'Home', 'icon' => '🏠'],
        ['route' => 'story', 'label' => 'Our Story', 'icon' => '📖'],
        ['route' => 'memories', 'label' => 'Memories', 'icon' => '📷'],
        ['route' => 'lore', 'label' => 'Justine Lore', 'icon' => '✨'],
        ['route' => 'wrapped', 'label' => 'Wrapped', 'icon' => '🎁'],
        ['route' => 'about', 'label' => 'About', 'icon' => '🩵'],
    ];
@endphp

<nav aria-label="Main" class="fixed inset-x-0 bottom-0 z-40 border-t border-ink/10 bg-white/95 pb-[env(safe-area-inset-bottom)] backdrop-blur md:hidden">
    <ul class="grid grid-cols-6">
        @foreach ($links as $link)
            <li>
                <a href="{{ route($link['route']) }}"
                   @class([
                       'flex min-h-14 flex-col items-center justify-center gap-0.5 px-1 py-2 text-[10px] font-semibold',
                       'text-sea' => request()->routeIs($link['route']),
                       'text-ink/50' => ! request()->routeIs($link['route']),
                   ])>
                    <span aria-hidden="true" class="text-base leading-none">{{ $link['icon'] }}</span>
                    <span class="truncate">{{ Str::of($link['label'])->explode(' ')->last() }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
