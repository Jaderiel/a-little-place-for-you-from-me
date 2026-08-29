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

<header class="sticky top-0 z-40 hidden border-b border-ink/5 bg-paper/80 backdrop-blur md:block">
    <nav aria-label="Main" class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
        <a href="{{ route('home') }}" class="text-sm font-extrabold tracking-tight text-ink">
            A Little Place <span class="hand text-xl text-sea">for you</span>
        </a>

        <ul class="flex items-center gap-1 text-sm font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ route($link['route']) }}"
                       @class([
                           'rounded-full px-3 py-2 transition hover:bg-mist',
                           'bg-ink text-white hover:bg-ink' => request()->routeIs($link['route']),
                       ])>{{ $link['label'] }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
