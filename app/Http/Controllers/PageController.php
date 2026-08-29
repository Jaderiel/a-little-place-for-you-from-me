<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\LoreFact;
use App\Models\Memory;
use App\Models\Photo;
use App\Models\Song;
use App\Models\ThingILike;
use App\Models\TimelineEvent;
use App\Models\TriviaQuestion;
use App\Models\WrappedYear;
use App\Support\FriendshipStats;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(private readonly FriendshipStats $stats) {}

    public function home(): View
    {
        return view('pages.home', [
            'counter' => $this->stats->counter(),
            'startDate' => $this->stats->startDate(),
            'firstEvent' => TimelineEvent::inOrder()->first(),
        ]);
    }

    public function story(): View
    {
        return view('pages.story', [
            'events' => TimelineEvent::with('photos')->inOrder()->get(),
            'stayedWithMe' => Memory::where('title', 'One Memory That Stayed With Me')->first(),
            'song' => Song::where('is_featured', true)->first() ?? Song::first(),
            'achievements' => Achievement::orderBy('sort_order')->get(),
        ]);
    }

    public function memories(Request $request): View
    {
        $category = $request->query('category');

        $photos = Photo::with(['timelineEvent', 'memory'])
            ->when($category, fn ($query) => $query->where('category', $category))
            ->orderByDesc('date_taken')
            ->orderBy('sort_order')
            ->get();

        return view('pages.memories', [
            'photos' => $photos,
            'categories' => config('friendship.photo_categories'),
            'activeCategory' => $category,
            'memories' => Memory::with('photos')->orderBy('sort_order')->get(),
        ]);
    }

    public function lore(): View
    {
        return view('pages.lore', [
            'facts' => LoreFact::where('group', 'fact')->orderBy('sort_order')->get(),
            'nicknames' => LoreFact::where('group', 'nickname')->orderBy('sort_order')->get(),
            'extras' => LoreFact::whereIn('group', ['word', 'phrase', 'reference'])->orderBy('sort_order')->get(),
            'questions' => TriviaQuestion::orderBy('sort_order')->get(['id', 'question', 'options']),
        ]);
    }

    public function wrapped(?int $year = null): View
    {
        $years = WrappedYear::orderBy('year')->get();
        $active = $years->firstWhere('year', $year) ?? $years->last();

        return view('pages.wrapped', [
            'years' => $years,
            'active' => $active,
            'cards' => $this->stats->cards(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'things' => ThingILike::orderBy('sort_order')->get(),
            'song' => Song::where('is_featured', true)->first() ?? Song::first(),
        ]);
    }
}
