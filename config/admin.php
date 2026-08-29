<?php

use App\Models\Achievement;
use App\Models\LoreFact;
use App\Models\Memory;
use App\Models\Photo;
use App\Models\SecretNote;
use App\Models\Song;
use App\Models\SupportMessage;
use App\Models\ThingILike;
use App\Models\TimelineEvent;
use App\Models\TriviaQuestion;
use App\Models\WrappedYear;

/*
 * Every admin screen is generated from this file. To add a new editable field:
 * add a column with a migration, then add it to the matching "fields" array.
 *
 * Field types: text, textarea, date, number, boolean, select, image, lines, relation
 */
return [
    'resources' => [
        'timeline-events' => [
            'label' => 'Timeline events',
            'model' => TimelineEvent::class,
            'order' => ['date', 'asc'],
            'columns' => ['date', 'title', 'category'],
            'fields' => [
                'date' => ['type' => 'date', 'rules' => ['required', 'date']],
                'title' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'story' => ['type' => 'textarea', 'rules' => ['nullable', 'string']],
                'location' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'category' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'song' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'quote' => ['type' => 'textarea', 'label' => 'Pull quote', 'rules' => ['nullable', 'string']],
                'is_cinematic' => ['type' => 'boolean', 'label' => 'Full-screen cinematic section'],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'memories' => [
            'label' => 'Memories',
            'model' => Memory::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['title', 'date', 'category'],
            'fields' => [
                'title' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'date' => ['type' => 'date', 'rules' => ['nullable', 'date']],
                'description' => ['type' => 'textarea', 'rules' => ['nullable', 'string']],
                'category' => ['type' => 'select', 'options' => 'photo_categories', 'rules' => ['nullable', 'string']],
                'location' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'featured' => ['type' => 'boolean'],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'photos' => [
            'label' => 'Photos',
            'model' => Photo::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['title', 'category', 'date_taken'],
            'fields' => [
                'image_path' => ['type' => 'image', 'label' => 'Photo', 'folder' => 'friendship/gallery'],
                'title' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'caption' => ['type' => 'textarea', 'rules' => ['nullable', 'string']],
                'date_taken' => ['type' => 'date', 'rules' => ['nullable', 'date']],
                'category' => ['type' => 'select', 'options' => 'photo_categories', 'rules' => ['required', 'string']],
                'location' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'timeline_event_id' => ['type' => 'relation', 'label' => 'Timeline event', 'model' => TimelineEvent::class, 'display' => 'title'],
                'memory_id' => ['type' => 'relation', 'label' => 'Memory', 'model' => Memory::class, 'display' => 'title'],
                'is_placeholder' => ['type' => 'boolean', 'label' => 'Still a placeholder'],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'things-i-like' => [
            'label' => 'Things I like about you',
            'model' => ThingILike::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['title'],
            'fields' => [
                'title' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'body' => ['type' => 'textarea', 'rules' => ['nullable', 'string']],
                'emoji' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:8']],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'songs' => [
            'label' => 'Soundtrack',
            'model' => Song::class,
            'order' => ['id', 'asc'],
            'columns' => ['title', 'artist'],
            'fields' => [
                'title' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'artist' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'note' => ['type' => 'textarea', 'label' => 'Why this song', 'rules' => ['nullable', 'string']],
                'spotify_url' => ['type' => 'text', 'rules' => ['nullable', 'url', 'max:255']],
                'cover_path' => ['type' => 'image', 'label' => 'Cover art', 'folder' => 'friendship/soundtrack'],
                'is_featured' => ['type' => 'boolean'],
            ],
        ],

        'achievements' => [
            'label' => 'Achievements',
            'model' => Achievement::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['icon', 'title', 'achieved_on'],
            'fields' => [
                'icon' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:8']],
                'title' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'achieved_on' => ['type' => 'date', 'rules' => ['nullable', 'date']],
                'description' => ['type' => 'textarea', 'rules' => ['nullable', 'string']],
                'is_locked' => ['type' => 'boolean', 'label' => 'Locked (future memory)'],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'trivia-questions' => [
            'label' => 'Trivia questions',
            'model' => TriviaQuestion::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['question'],
            'fields' => [
                'question' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'options' => ['type' => 'lines', 'label' => 'Choices (one per line)', 'rules' => ['required', 'string']],
                'correct_index' => ['type' => 'number', 'label' => 'Correct choice number (starting at 0)', 'rules' => ['required', 'integer', 'min:0']],
                'response' => ['type' => 'textarea', 'label' => 'Reveal text', 'rules' => ['nullable', 'string']],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'lore-facts' => [
            'label' => 'Justine lore',
            'model' => LoreFact::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['group', 'label', 'value'],
            'fields' => [
                'group' => ['type' => 'select', 'options' => ['fact', 'nickname', 'word', 'phrase', 'reference'], 'rules' => ['required', 'string']],
                'label' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'value' => ['type' => 'textarea', 'rules' => ['required', 'string']],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],

        'support-messages' => [
            'label' => 'Bad-day messages',
            'model' => SupportMessage::class,
            'order' => ['id', 'asc'],
            'columns' => ['message'],
            'fields' => [
                'message' => ['type' => 'textarea', 'rules' => ['required', 'string']],
            ],
        ],

        'wrapped-years' => [
            'label' => 'Wrapped years',
            'model' => WrappedYear::class,
            'order' => ['year', 'asc'],
            'columns' => ['year', 'headline'],
            'fields' => [
                'year' => ['type' => 'number', 'rules' => ['required', 'integer', 'min:2000', 'max:2100']],
                'headline' => ['type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'blurb' => ['type' => 'textarea', 'rules' => ['nullable', 'string']],
                'highlights' => ['type' => 'lines', 'label' => 'Highlights (one per line)', 'rules' => ['nullable', 'string']],
            ],
        ],

        'secret-notes' => [
            'label' => 'Secret page',
            'model' => SecretNote::class,
            'order' => ['sort_order', 'asc'],
            'columns' => ['heading'],
            'fields' => [
                'heading' => ['type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'body' => ['type' => 'textarea', 'rules' => ['required', 'string']],
                'sort_order' => ['type' => 'number', 'rules' => ['nullable', 'integer', 'min:0']],
            ],
        ],
    ],
];
