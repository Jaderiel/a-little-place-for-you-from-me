<?php

namespace Tests\Feature;

use App\Models\TimelineEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_admin_area_requires_a_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
        $this->get('/admin/photos')->assertRedirect(route('login'));
    }

    public function test_content_can_be_created_and_updated_without_touching_blade(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post('/admin/timeline-events', [
            'date' => '2026-08-23',
            'title' => 'IVN Training',
            'story' => 'Something happened.',
            'sort_order' => 9,
        ])->assertRedirect(route('admin.resource.index', 'timeline-events'));

        $event = TimelineEvent::firstOrFail();

        $this->put("/admin/timeline-events/{$event->id}", [
            'date' => '2026-08-23',
            'title' => 'IVN Training, day one',
            'sort_order' => 9,
        ])->assertRedirect();

        $this->assertSame('IVN Training, day one', $event->refresh()->title);
    }

    public function test_photos_accept_images_only(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());

        $this->post('/admin/photos', [
            'category' => 'Gallery',
            'image_path' => UploadedFile::fake()->create('sneaky.php', 10, 'application/x-php'),
        ])->assertSessionHasErrors('image_path');

        $this->post('/admin/photos', [
            'title' => 'SM day',
            'category' => 'Hangouts',
            'image_path' => UploadedFile::fake()->image('sm.jpg'),
        ])->assertRedirect();

        $this->assertCount(1, Storage::disk('public')->allFiles('friendship/gallery'));
    }
}
