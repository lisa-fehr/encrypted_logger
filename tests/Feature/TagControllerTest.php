<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tag;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->data = Tag::factory()->make(['name' => 'New Tag'])->toArray();
    }

    public function test_the_application_fails_when_not_logged_in(): void
    {
        $response = $this->post(route('admin.tag.store'), $this->data);
        $response->assertRedirectToRoute('login');

        $response = $this->patch(route('admin.tag.update', Tag::factory()->create()), $this->data);
        $response->assertRedirectToRoute('login');

        $response = $this->delete(route('admin.tag.delete', Tag::factory()->create()));
        $response->assertRedirectToRoute('login');
    }

    public function test_the_application_stores_a_new_tag_when_logged_in(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.tag.store'), array_merge($this->data, ['name' => 'New Tag']));

        $this->assertCount(1, Tag::all());

    }

    public function test_the_application_updates_a_tag_when_logged_in(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();

        $this->actingAs($user)
            ->patch(route('admin.tag.update', $tag), ['name' => 'Updated Tag']);

        $this->assertTrue(Tag::where(['name' => 'Updated Tag'])->exists());

    }

    public function test_the_application_deletes_a_tag_when_logged_in(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.tag.delete', $tag));

        $this->assertFalse(Tag::where(['name' => $tag->name])->exists());

    }
}
