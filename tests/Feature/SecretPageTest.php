<?php

namespace Tests\Feature;

use Database\Seeders\FriendshipSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecretPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(FriendshipSeeder::class);
        config(['friendship.secret_password' => 'kevin']);
    }

    public function test_secret_content_is_hidden_until_unlocked(): void
    {
        $this->get(route('secret'))
            ->assertOk()
            ->assertSee('This one is locked.')
            ->assertDontSee('Something I Never Said');
    }

    public function test_a_wrong_password_keeps_the_page_locked(): void
    {
        $this->post(route('secret.unlock'), ['password' => 'nope'])->assertSessionHasErrors('password');

        $this->get(route('secret'))->assertDontSee('Something I Never Said');
    }

    public function test_the_right_password_unlocks_and_locking_reverses_it(): void
    {
        $this->post(route('secret.unlock'), ['password' => 'kevin'])->assertRedirect(route('secret'));

        $this->get(route('secret'))->assertOk()->assertSee('Something I Never Said');

        $this->post(route('secret.lock'))->assertRedirect(route('home'));

        $this->get(route('secret'))->assertSee('This one is locked.');
    }
}
