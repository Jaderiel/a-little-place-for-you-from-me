<form method="POST" action="{{ route('secret.unlock') }}" class="card w-full max-w-sm space-y-4 p-8 text-center">
    @csrf

    <p aria-hidden="true" class="text-4xl">🔒</p>
    <h1 class="text-2xl font-extrabold tracking-tight">This one is locked.</h1>
    <p class="text-sm text-ink/60">If you were meant to find this, you already know the word.</p>

    <div class="text-left">
        <label for="password" class="text-xs font-bold uppercase tracking-[0.18em] text-ink/50">Password</label>
        <input id="password"
               name="password"
               type="password"
               required
               autocomplete="off"
               class="mt-1 w-full rounded-2xl border border-ink/10 bg-white px-4 py-3 text-base focus:border-blue focus:outline-none">

        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full rounded-full bg-ink px-6 py-3 font-semibold text-white transition hover:bg-deep">
        Unlock
    </button>

    <a href="{{ route('home') }}" class="block text-xs font-semibold text-ink/40 hover:text-ink">go back</a>
</form>
