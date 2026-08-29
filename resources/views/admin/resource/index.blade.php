@extends('layouts.admin')

@section('title', $config['label'])

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-extrabold tracking-tight">{{ $config['label'] }}</h1>

        <a href="{{ route('admin.resource.create', $resource) }}" class="rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white hover:bg-deep">
            Add new
        </a>
    </div>

    <div class="mt-8 overflow-x-auto rounded-3xl bg-white ring-1 ring-ink/10">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-ink/10 text-xs uppercase tracking-[0.15em] text-ink/40">
                <tr>
                    @foreach ($config['columns'] as $column)
                        <th class="px-5 py-3 font-bold">{{ Str::headline($column) }}</th>
                    @endforeach
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>

            <tbody>
                @forelse ($records as $record)
                    <tr class="border-b border-ink/5 last:border-0">
                        @foreach ($config['columns'] as $column)
                            <td class="px-5 py-3">{{ Str::limit((string) $record->{$column}, 70) }}</td>
                        @endforeach

                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.resource.edit', [$resource, $record->id]) }}" class="font-semibold text-sea">Edit</a>

                            <form method="POST" action="{{ route('admin.resource.destroy', [$resource, $record->id]) }}" class="ml-3 inline"
                                  onsubmit="return confirm('Delete this for good?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-semibold text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-5 py-6 text-ink/50" colspan="{{ count($config['columns']) + 1 }}">Nothing here yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $records->links() }}</div>
@endsection
