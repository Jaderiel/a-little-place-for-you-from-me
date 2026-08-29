@extends('layouts.admin')

@section('title', $config['label'])

@section('content')
    @php
        $isNew = ! $record->exists;
    @endphp

    <h1 class="text-3xl font-extrabold tracking-tight">
        {{ $isNew ? 'New' : 'Edit' }} — {{ Str::singular($config['label']) }}
    </h1>

    <form method="POST"
          action="{{ $isNew ? route('admin.resource.store', $resource) : route('admin.resource.update', [$resource, $record->id]) }}"
          enctype="multipart/form-data"
          class="mt-8 max-w-2xl space-y-6 rounded-3xl bg-white p-6 ring-1 ring-ink/10 sm:p-8">
        @csrf
        @unless ($isNew)
            @method('PUT')
        @endunless

        @foreach ($config['fields'] as $name => $field)
            @php
                $label = $field['label'] ?? Str::headline($name);
                $value = old($name, $record->getAttribute($name));
            @endphp

            <div>
                <label for="{{ $name }}" class="text-xs font-bold uppercase tracking-[0.18em] text-ink/50">{{ $label }}</label>

                @switch($field['type'])
                    @case('textarea')
                        <textarea id="{{ $name }}" name="{{ $name }}" rows="6"
                                  class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">{{ $value }}</textarea>
                        @break

                    @case('lines')
                        <textarea id="{{ $name }}" name="{{ $name }}" rows="5"
                                  class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">{{ is_array($value) ? implode("\n", $value) : $value }}</textarea>
                        @break

                    @case('boolean')
                        <div class="mt-1">
                            <input type="hidden" name="{{ $name }}" value="0">
                            <input id="{{ $name }}" name="{{ $name }}" type="checkbox" value="1" @checked($value)>
                        </div>
                        @break

                    @case('date')
                        <input id="{{ $name }}" name="{{ $name }}" type="date"
                               value="{{ $value instanceof \Illuminate\Support\Carbon ? $value->format('Y-m-d') : $value }}"
                               class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
                        @break

                    @case('number')
                        <input id="{{ $name }}" name="{{ $name }}" type="number" value="{{ $value }}"
                               class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
                        @break

                    @case('select')
                        @php
                            $options = is_string($field['options']) ? config("friendship.{$field['options']}") : $field['options'];
                        @endphp
                        <select id="{{ $name }}" name="{{ $name }}" class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
                            <option value="">—</option>
                            @foreach ($options as $option)
                                <option value="{{ $option }}" @selected($value === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                        @break

                    @case('relation')
                        <select id="{{ $name }}" name="{{ $name }}" class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
                            <option value="">—</option>
                            @foreach ($field['model']::orderBy($field['display'])->get() as $option)
                                <option value="{{ $option->id }}" @selected((int) $value === $option->id)>{{ $option->{$field['display']} }}</option>
                            @endforeach
                        </select>
                        @break

                    @case('image')
                        @if ($value)
                            <img src="{{ Storage::disk('public')->url($value) }}" alt="" class="mt-2 h-32 w-32 rounded-2xl object-cover">
                        @endif
                        <input id="{{ $name }}" name="{{ $name }}" type="file" accept="image/*" class="mt-2 block w-full text-sm">
                        <p class="mt-1 text-xs text-ink/40">JPG, PNG, WebP or GIF · up to 8 MB · saved in storage/app/public/{{ $field['folder'] ?? 'friendship/gallery' }}</p>
                        @break

                    @default
                        <input id="{{ $name }}" name="{{ $name }}" type="text" value="{{ $value }}"
                               class="mt-1 w-full rounded-2xl border border-ink/10 px-4 py-3">
                @endswitch

                @error($name)<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        @endforeach

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-full bg-ink px-6 py-3 font-semibold text-white hover:bg-deep">Save</button>
            <a href="{{ route('admin.resource.index', $resource) }}" class="text-sm font-semibold text-ink/50">Cancel</a>
        </div>
    </form>
@endsection
