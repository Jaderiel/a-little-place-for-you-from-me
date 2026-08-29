<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * One controller for every content type. The screens are generated from config/admin.php.
 */
class ResourceController extends Controller
{
    public function index(string $resource): View
    {
        $config = $this->config($resource);
        $model = $this->model($config);
        [$column, $direction] = $config['order'];

        return view('admin.resource.index', [
            'resource' => $resource,
            'config' => $config,
            'records' => $model->newQuery()->orderBy($column, $direction)->paginate(30),
        ]);
    }

    public function create(string $resource): View
    {
        $config = $this->config($resource);

        return view('admin.resource.form', [
            'resource' => $resource,
            'config' => $config,
            'record' => $this->model($config),
        ]);
    }

    public function store(Request $request, string $resource): RedirectResponse
    {
        $config = $this->config($resource);
        $record = $this->model($config);

        $record->fill($this->payload($request, $config, $record))->save();

        return redirect()->route('admin.resource.index', $resource)->with('status', 'Saved.');
    }

    public function edit(string $resource, int $id): View
    {
        $config = $this->config($resource);

        return view('admin.resource.form', [
            'resource' => $resource,
            'config' => $config,
            'record' => $this->model($config)->newQuery()->findOrFail($id),
        ]);
    }

    public function update(Request $request, string $resource, int $id): RedirectResponse
    {
        $config = $this->config($resource);
        $record = $this->model($config)->newQuery()->findOrFail($id);

        $record->fill($this->payload($request, $config, $record))->save();

        return redirect()->route('admin.resource.index', $resource)->with('status', 'Updated.');
    }

    public function destroy(string $resource, int $id): RedirectResponse
    {
        $config = $this->config($resource);
        $this->model($config)->newQuery()->findOrFail($id)->delete();

        return redirect()->route('admin.resource.index', $resource)->with('status', 'Deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function payload(Request $request, array $config, Model $record): array
    {
        $rules = [];

        foreach ($config['fields'] as $name => $field) {
            $rules[$name] = match ($field['type']) {
                'boolean' => ['nullable', 'boolean'],
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:8192'],
                'relation' => ['nullable', 'integer'],
                default => $field['rules'] ?? ['nullable', 'string'],
            };
        }

        $validated = $request->validate($rules);
        $payload = [];

        foreach ($config['fields'] as $name => $field) {
            $value = $validated[$name] ?? null;

            $payload[$name] = match ($field['type']) {
                'boolean' => $request->boolean($name),
                'number' => $value === null || $value === '' ? 0 : (int) $value,
                'relation' => $value ?: null,
                'lines' => $this->lines($value),
                'image' => $this->upload($request, $name, $field, $record),
                default => $value,
            };

            if ($field['type'] === 'image' && $payload[$name] === null) {
                unset($payload[$name]);
            }
        }

        return $payload;
    }

    /**
     * @return array<int, string>
     */
    private function lines(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function upload(Request $request, string $name, array $field, Model $record): ?string
    {
        if (! $request->hasFile($name)) {
            return null;
        }

        $old = $record->getAttribute($name);

        if ($old) {
            Storage::disk('public')->delete($old);
        }

        return $request->file($name)->store($field['folder'] ?? 'friendship/gallery', 'public');
    }

    /**
     * @return array<string, mixed>
     */
    private function config(string $resource): array
    {
        $config = config("admin.resources.$resource");

        if (! $config) {
            throw new NotFoundHttpException("Unknown resource [$resource].");
        }

        return $config;
    }

    private function model(array $config): Model
    {
        return new $config['model'];
    }
}
