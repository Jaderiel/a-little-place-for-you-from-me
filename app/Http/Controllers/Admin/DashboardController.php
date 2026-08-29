<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $counts = [];

        foreach (config('admin.resources') as $key => $config) {
            $counts[$key] = [
                'label' => $config['label'],
                'count' => $config['model']::count(),
            ];
        }

        return view('admin.dashboard', [
            'counts' => $counts,
            'placeholders' => Photo::whereNull('image_path')->count(),
        ]);
    }
}
