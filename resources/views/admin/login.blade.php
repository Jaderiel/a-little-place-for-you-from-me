@extends('layouts.admin')

@section('title', 'Log in')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="mx-auto max-w-sm space-y-4 rounded-3xl bg-white p-8 ring-1 ring-ink/10">
        @csrf

        <h1 class="text-2xl font-extrabold tracking-tight">Log in</h1>

        <div>
            <label for="email" class="text-xs font-bold uppercase tracking-[0.18em] text-ink/50">Email</label>
            <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                   class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="password" class="text-xs font-bold uppercase tracking-[0.18em] text-ink/50">Password</label>
            <input id="password" name="password" type="password" required class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <label class="flex items-center gap-2 text-sm text-ink/60">
            <input type="checkbox" name="remember" value="1" class="rounded"> Remember me
        </label>

        <button type="submit" class="w-full rounded-full bg-ink px-6 py-3 font-semibold text-white hover:bg-deep">Log in</button>
    </form>
@endsection
