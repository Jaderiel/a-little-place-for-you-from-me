<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') · A Little Place</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh bg-mist/40">
    <header class="border-b border-ink/10 bg-white">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-6 py-4">
            <a href="{{ route('admin.dashboard') }}" class="font-extrabold tracking-tight">Content manager</a>

            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('home') }}" class="font-semibold text-sea">View site</a>

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-semibold text-ink/50 hover:text-ink">Log out</button>
                    </form>
                @endauth
            </div>
        </div>

        @auth
            <nav class="mx-auto flex max-w-6xl flex-wrap gap-2 px-6 pb-4 text-sm">
                @foreach (config('admin.resources') as $key => $resource)
                    <a href="{{ route('admin.resource.index', $key) }}"
                       @class([
                           'rounded-full px-3 py-1.5 font-medium ring-1 ring-ink/10',
                           'bg-ink text-white' => request()->is("admin/$key*"),
                           'bg-white text-ink/70' => ! request()->is("admin/$key*"),
                       ])>{{ $resource['label'] }}</a>
                @endforeach
            </nav>
        @endauth
    </header>

    <main class="mx-auto max-w-6xl px-6 py-10">
        @if (session('status'))
            <p class="mb-6 rounded-2xl bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 ring-1 ring-green-200">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>
