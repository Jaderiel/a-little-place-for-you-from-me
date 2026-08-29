<?php

namespace Tests\Feature;

use App\Models\TriviaQuestion;
use Database\Seeders\FriendshipSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(FriendshipSeeder::class);
    }

    public function test_every_public_page_renders(): void
    {
        foreach (['home', 'story', 'memories', 'lore', 'about'] as $route) {
            $this->get(route($route))->assertOk();
        }

        $this->get(route('wrapped'))->assertOk()->assertSee('Our Friendship Wrapped');
        $this->get(route('wrapped', 2024))->assertOk()->assertSee('The year it started.');
    }

    public function test_home_shows_the_friendship_counter(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee("We've been part of each other's story for", false);
    }

    public function test_lore_and_bad_day_endpoints_return_content(): void
    {
        $this->getJson(route('lore.random'))->assertOk()->assertJsonStructure(['label', 'value']);
        $this->getJson(route('bad-day'))->assertOk()->assertJsonStructure(['message']);
    }

    public function test_trivia_answers_are_graded_on_the_server(): void
    {
        $question = TriviaQuestion::firstOrFail();

        $this->postJson(route('trivia.check'), [
            'question_id' => $question->id,
            'answer' => $question->correct_index,
        ])->assertOk()->assertJson(['correct' => true]);

        $this->get(route('lore'))->assertOk()->assertDontSee('correct_index');
    }

    public function test_navigation_never_links_to_the_secret_page(): void
    {
        $this->get(route('home'))->assertOk()->assertDontSee('Something I Never Said');
    }
}
