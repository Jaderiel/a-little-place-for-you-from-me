<?php

namespace Database\Seeders;

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
use Illuminate\Database\Seeder;

class FriendshipSeeder extends Seeder
{
    public function run(): void
    {
        $this->timeline();
        $this->memories();
        $this->thingsILike();
        $this->lore();
        $this->soundtrack();
        $this->achievements();
        $this->wrapped();
        $this->trivia();
        $this->supportMessages();
        $this->secret();
    }

    private function timeline(): void
    {
        $events = [
            [
                'date' => '2023-04-14',
                'title' => 'The First Time I Saw You',
                'story' => "This was during ICT Week 2023 at school.\n\nIt was the first time I ever saw you. At that point I didn't even know your name — I just remembered you as the person everyone was watching on the floor.\n\nLater on, I found out your name was Justine.",
                'location' => 'ICT Week 2023',
                'category' => 'Beginnings',
                'quote' => 'batang maangas sumayaw · batang smooth magtwerk',
                'sort_order' => 1,
            ],
            [
                'date' => '2024-04-06',
                'title' => 'The First Time We Talked',
                'story' => "The chapel. This was the first time we actually talked and interacted, not just existed in the same room.\n\nEverything on this website counts from this day.",
                'location' => 'Chapel',
                'category' => 'Beginnings',
                'quote' => null,
                'sort_order' => 2,
            ],
            [
                'date' => '2024-04-12',
                'title' => 'Our First Picture Together',
                'story' => 'ICT Week 2024. Technically a group picture — but still, officially, our first picture together.',
                'location' => 'ICT Week 2024',
                'category' => 'Firsts',
                'quote' => null,
                'sort_order' => 3,
            ],
            [
                'date' => '2024-05-05',
                'title' => 'The Kevin Walk 🐶',
                'story' => "The first hangout. I tagged along while you walked Kevin.\n\nTechnically it was just walking a dog.",
                'location' => 'Around the neighborhood',
                'category' => 'Hangouts',
                'quote' => 'Hangout na yun hehe.',
                'sort_order' => 4,
            ],
            [
                'date' => '2025-09-08',
                'title' => 'The SM Day',
                'story' => "One of my favorite memories. We went to SM and collected a whole pile of small moments.\n\nWe ate at Chowking. We hit the arcade — Tekken, basketball, the claw machine.\n\nI would like to officially report that Justine destroyed me in Tekken. Repeatedly.\n\nNothing extraordinary had to happen. We played, ate, walked around, and simply spent time together. It felt like a real bonding day.",
                'location' => 'SM',
                'category' => 'Hangouts',
                'quote' => 'I would like to officially report that Justine destroyed me in Tekken.',
                'sort_order' => 5,
            ],
            [
                'date' => '2026-05-26',
                'title' => 'The Day You Graduated',
                'story' => "Seeing you graduate made me tear up.\n\nYou had already gone through so much. There were moments when you almost didn't want to continue your studies, but somehow you made it all the way to graduation.\n\nAnd not just graduation. You graduated as Summa Cum Laude.\n\nAfter everything you had gone through, seeing you achieve that felt incredibly special.\n\nI remember thinking: \"Somehow, your achievement feels close to my heart too.\"\n\nCongratulations, Justineee. You did so well. 🥺",
                'location' => null,
                'category' => 'Milestones',
                'quote' => 'Summa Cum Laude.',
                'is_cinematic' => true,
                'sort_order' => 6,
            ],
            [
                'date' => '2026-08-23',
                'title' => 'IVN Training',
                'story' => 'The most recent one so far. This page is intentionally left a little empty — the story and the photos still have to be added.',
                'location' => null,
                'category' => 'Latest',
                'quote' => null,
                'sort_order' => 7,
            ],
        ];

        foreach ($events as $event) {
            $model = TimelineEvent::create($event);

            Photo::create([
                'title' => $model->title,
                'caption' => 'Placeholder — replace this photo in the admin panel.',
                'image_path' => null,
                'date_taken' => $model->date,
                'category' => 'Timeline',
                'timeline_event_id' => $model->id,
                'is_placeholder' => true,
            ]);
        }
    }

    private function memories(): void
    {
        $memories = [
            [
                'title' => 'The Great Halo-Halo Operation',
                'date' => null,
                'description' => "You once said you wanted to try halo-halo. So, naturally, I planned an entire operation around it.\n\nI invited Anthony, Lian and my mom, and paid for everyone — purely so it wouldn't be obvious that the whole thing existed because I wanted you to get the halo-halo you wanted.\n\nMission status: successful. Cover story: questionable.",
                'category' => 'Funny',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'One Memory That Stayed With Me',
                'date' => null,
                'description' => "There are some conversations you don't forget. This was one of them.\n\nYou opened up about your little brother. I'm not going to write that story down here — it isn't mine to tell. I just wanted this page to remember that it mattered.",
                'category' => 'Special Days',
                'featured' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($memories as $memory) {
            Memory::create($memory);
        }
    }

    private function thingsILike(): void
    {
        $things = [
            ["You'd rather tell me the truth than comfort me with lies.", 'You tell me the truth instead of simply telling me what I want to hear.', '🫱'],
            ["You don't tolerate me when I'm wrong.", "If I'm being stupid, you will tell me. That's actually one of the things I appreciate most.", '🙃'],
            ["You're reliable.", 'I know I can count on you for a lot of different things.', '🧷'],
            ["You don't let people feel out of place.", "You'll accompany someone just so they don't feel left out.", '🫶'],
            ["You're helpful.", 'If you can help, you will.', '🤝'],
            ["You're not lazy.", 'Usually. Sometimes. Maybe.', '😌'],
            ['You know how to read the room.', 'You know how to carry yourself in different situations, and how to interact with different people.', '🧠'],
            ['Full package.', 'Beautiful. Kind. Smart. Cute. Responsible.', '📦'],
            ['You know your worth.', 'You know what you deserve.', '💎'],
            ["You're appreciative.", 'You know how to appreciate people and things.', '🌱'],
            ['Your facial expressions.', 'The face you make when you hear something bad, weird, awkward or cringe. Extremely animated. I think it\'s cute.', '😳'],
            ['I like seeing you genuinely happy.', 'Especially when you\'re genuinely smiling, or when something good happens in your life. Because you deserve those moments.', '☀️'],
            ["You're someone I can talk to.", "When I have problems, you're often one of the people I talk to, because I know you'll understand. You might scold me when I'm being stupid. Honestly, that's part of it.", '💬'],
            ['The way you interact with people.', "Even people who don't know you tend to like you, because you know how to socialize and you're funny.", '✨'],
            ['People I introduce you to end up liking you too.', "My parents. My friends. Basically everyone. So it's not just me — apparently everyone agrees.", '🫂'],
        ];

        foreach ($things as $i => [$title, $body, $emoji]) {
            ThingILike::create([
                'title' => $title,
                'body' => $body,
                'emoji' => $emoji,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function lore(): void
    {
        $facts = [
            ['fact', 'Favorite color', 'Blue. Obviously. Look around.'],
            ['fact', 'Favorite pet', 'Kevin 🐶'],
            ['fact', 'Birthday', 'February 3, 2004'],
            ['fact', 'Favorite watch', 'Detective and documentary movies'],
            ['fact', 'Known dislike', 'Long-distance travel'],
            ['fact', 'Funny habit', 'The facial expressions when she hears something weird'],
            ['fact', 'Favorite phrase', '“tiiihhh”'],
            ['nickname', 'Nickname', 'Justine'],
            ['nickname', 'Nickname', 'Disney Princess'],
            ['nickname', 'Nickname', 'Gusting'],
            ['nickname', 'Nickname', 'bading'],
            ['nickname', 'Nickname', 'tiiihhh'],
            ['word', 'Certified vocabulary', '“libag sa utak”'],
            ['phrase', 'Battle cry', '“Justine Marco for three!”'],
            ['reference', 'Special reference', 'Pikachu ⚡'],
        ];

        foreach ($facts as $i => [$group, $label, $value]) {
            LoreFact::create([
                'group' => $group,
                'label' => $label,
                'value' => $value,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function soundtrack(): void
    {
        Song::create([
            'title' => "It's Always Been You",
            'artist' => 'tonybear',
            'note' => "This song reminds me of you because there are moments when I want to share almost everything with you.\n\nWhen I'm sad. When I'm happy. When I'm excited. When something happens and I immediately want to tell you.\n\nYou were there during some of the hardest moments of my life. There aren't many people who stay beside you during the saddest parts of your life.\n\nAnd even if you may have simply been there because you felt sorry for me, it meant much more to me than you probably realized.",
            'spotify_url' => null,
            'is_featured' => true,
        ]);
    }

    private function achievements(): void
    {
        $achievements = [
            ['🏆', 'First Conversation', '2024-04-06', 'The chapel. Where all of this started.', false],
            ['📸', 'First Photo Together', '2024-04-12', 'A group picture, but it counts.', false],
            ['🐶', 'The Kevin Walk', '2024-05-05', 'First hangout, technically dog-related.', false],
            ['🎮', 'Tekken Rivalry', '2025-09-08', 'Record so far: not in my favor.', false],
            ['🎓', 'Summa Cum Laude', '2026-05-26', 'After everything. Still made it.', false],
            ['🏅', 'Still Making Memories', '2026-08-23', 'IVN Training, and whatever comes next.', false],
            ['🔒', '???', null, 'Maybe another memory will unlock this.', true],
        ];

        foreach ($achievements as $i => [$icon, $title, $date, $description, $locked]) {
            Achievement::create([
                'icon' => $icon,
                'title' => $title,
                'achieved_on' => $date,
                'description' => $description,
                'is_locked' => $locked,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function wrapped(): void
    {
        WrappedYear::create([
            'year' => 2024,
            'headline' => 'The year it started.',
            'blurb' => 'This was the year we went from barely knowing each other to actually becoming friends.',
            'highlights' => ['First conversation — April 6', 'First picture together — April 12', 'First hangout: The Kevin Walk — May 5'],
        ]);

        WrappedYear::create([
            'year' => 2025,
            'headline' => 'The bonding era.',
            'blurb' => 'Less introductions, more actual hanging out.',
            'highlights' => ['The SM Day', 'Arcade + basketball + claw machine', 'Tekken (I lost)', 'Chowking'],
        ]);

        WrappedYear::create([
            'year' => 2026,
            'headline' => 'The year of milestones.',
            'blurb' => 'The year the big things happened.',
            'highlights' => ['Graduation — Summa Cum Laude', 'IVN Training', 'More to be added'],
        ]);
    }

    private function trivia(): void
    {
        $questions = [
            ["What is Justine's favorite color?", ['Pink', 'Blue', 'Purple', 'Green'], 1, 'Blue. The entire website is evidence.'],
            ["What is the name of Justine's dog?", ['Kevin', 'Bruno', 'Milo', 'Pikachu'], 0, 'Kevin. A legend.'],
            ['Which phrase is strongly associated with Justine?', ['“sheesh”', '“tiiihhh”', '“charot”', '“ay grabe”'], 1, 'tiiihhh.'],
            ['Where did we first talk?', ['The canteen', 'The chapel', 'The gym', 'The library'], 1, 'The chapel — April 6, 2024.'],
            ['What happened during our first hangout?', ['We watched a movie', 'We walked Kevin', 'We went to SM', 'We ate halo-halo'], 1, 'Walking Kevin. Still counts.'],
            ['Who won at Tekken during our SM day?', ['Me', 'Justine', 'Nobody', 'The claw machine'], 1, 'Justine. Repeatedly.'],
            ['Where did we eat during the SM day?', ['Jollibee', 'Chowking', 'Mang Inasal', 'McDonald\'s'], 1, 'Chowking.'],
            ['When is Justine\'s birthday?', ['February 3', 'March 2', 'February 13', 'January 3'], 0, 'February 3, 2004.'],
            ['What honor did Justine graduate with?', ['Cum Laude', 'Magna Cum Laude', 'Summa Cum Laude', 'She refuses to say'], 2, 'Summa Cum Laude. 🎓'],
        ];

        foreach ($questions as $i => [$question, $options, $correct, $response]) {
            TriviaQuestion::create([
                'question' => $question,
                'options' => $options,
                'correct_index' => $correct,
                'response' => $response,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function supportMessages(): void
    {
        $messages = [
            "You don't have to have everything figured out today.",
            'Drink some water first. Yes, I\'m serious.',
            "You've already made it through days you thought you couldn't.",
            'Take a break. The world can wait for a little while.',
            'Bad days are just days. They end. This one will too.',
            'You are allowed to rest without earning it first.',
            'If today was survived, today was a success.',
            'Go pet Kevin. Doctor\'s orders.',
            'If it helps: someone out here is genuinely glad you exist.',
        ];

        foreach ($messages as $message) {
            SupportMessage::create(['message' => $message]);
        }
    }

    private function secret(): void
    {
        SecretNote::create([
            'heading' => 'Something I Never Said',
            'body' => "There was a time when I cared about you in a way I never told you.\n\nThere were moments when I wished I could be the person who could protect you from getting hurt.\n\nWhenever someone hurt you, a part of me wished I could take that pain away.\n\nI knew, though, that some feelings are better kept quietly.\n\nSo I stayed where I was.\n\nBeside you.\n\nAs your friend.\n\nAnd maybe that was enough.",
            'sort_order' => 1,
        ]);

        SecretNote::create([
            'heading' => null,
            'body' => "This is a piece of an older version of my story.\n\nI don't expect anything from you. I don't want this to change anything.\n\nI just wanted to preserve the truth of what I once felt.",
            'sort_order' => 2,
        ]);
    }
}
