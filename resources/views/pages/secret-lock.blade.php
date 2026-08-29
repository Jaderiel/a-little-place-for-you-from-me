@extends('layouts.app')

@section('title', 'Locked')

@section('content')
    <section class="grain relative flex min-h-[80dvh] items-center justify-center overflow-hidden bg-linear-to-b from-ink to-deep px-6 py-20">
        <x-secret-lock />
    </section>
@endsection
