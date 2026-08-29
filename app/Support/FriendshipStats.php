<?php

namespace App\Support;

use App\Models\Achievement;
use App\Models\Memory;
use App\Models\Photo;
use App\Models\Song;
use App\Models\TimelineEvent;
use Carbon\CarbonImmutable;

class FriendshipStats
{
    public function startDate(): CarbonImmutable
    {
        return CarbonImmutable::parse(config('friendship.start_date'), config('friendship.timezone'))->startOfDay();
    }

    public function now(): CarbonImmutable
    {
        return CarbonImmutable::now(config('friendship.timezone'));
    }

    /**
     * Years / months / days since the first conversation.
     *
     * @return array{years:int, months:int, days:int, hours:int, minutes:int}
     */
    public function counter(): array
    {
        $diff = $this->startDate()->diff($this->now());

        return [
            'years' => $diff->y,
            'months' => $diff->m,
            'days' => $diff->d,
            'hours' => $diff->h,
            'minutes' => $diff->i,
        ];
    }

    public function daysTogether(): int
    {
        return (int) $this->startDate()->diffInDays($this->now());
    }

    /**
     * Only counts things that actually exist — no invented numbers.
     *
     * @return array<int, array{label:string, value:int|string, hint:?string}>
     */
    public function cards(): array
    {
        return [
            ['label' => 'Days since our first conversation', 'value' => number_format($this->daysTogether()), 'hint' => 'Since April 6, 2024'],
            ['label' => 'Moments on the timeline', 'value' => TimelineEvent::count(), 'hint' => null],
            ['label' => 'Documented memories', 'value' => Memory::count() + TimelineEvent::count(), 'hint' => null],
            ['label' => 'Photos in the archive', 'value' => Photo::whereNotNull('image_path')->count(), 'hint' => 'More to be added'],
            ['label' => 'Songs on our soundtrack', 'value' => Song::count(), 'hint' => null],
            ['label' => 'Achievements unlocked', 'value' => Achievement::where('is_locked', false)->count(), 'hint' => null],
        ];
    }
}
