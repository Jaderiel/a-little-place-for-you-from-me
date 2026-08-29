<?php

namespace App\Http\Controllers;

use App\Models\SecretNote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SecretController extends Controller
{
    private const SESSION_KEY = 'secret_unlocked';

    public function show(Request $request): View
    {
        if (! $request->session()->get(self::SESSION_KEY)) {
            return view('pages.secret-lock');
        }

        return view('pages.secret', [
            'notes' => SecretNote::orderBy('sort_order')->get(),
        ]);
    }

    public function unlock(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'password' => ['required', 'string'],
        ]);

        if (! hash_equals((string) config('friendship.secret_password'), $data['password'])) {
            throw ValidationException::withMessages([
                'password' => 'That is not it. Think smaller, furrier, four legs.',
            ]);
        }

        $request->session()->put(self::SESSION_KEY, true);

        return redirect()->route('secret');
    }

    public function lock(Request $request): RedirectResponse
    {
        $request->session()->forget(self::SESSION_KEY);

        return redirect()->route('home');
    }
}
