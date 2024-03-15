<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Concern;
use Tests\TestCase;

class ConcernControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->data = Concern::factory()->make(['description' => 'New Concern'])->toArray();
    }

    public function test_the_application_fails_when_not_logged_in(): void
    {
        $response = $this->post(route('admin.concern.store'), $this->data);
        $response->assertRedirectToRoute('login');

        $response = $this->patch(route('admin.concern.update', Concern::factory()->create()), $this->data);
        $response->assertRedirectToRoute('login');

        $response = $this->delete(route('admin.concern.delete', Concern::factory()->create()));
        $response->assertRedirectToRoute('login');
    }

    public function test_the_application_stores_a_new_concern_when_logged_in(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.concern.store'), $this->data);

        $this->assertCount(1, Concern::all());

    }

    public function test_the_application_updates_a_concern_when_logged_in(): void
    {
        $user = User::factory()->create();
        $concern = Concern::factory()->create();

        $this->actingAs($user)
            ->patch(route('admin.concern.update', $concern), array_merge($this->data, ['description' => 'Updated Concern']));

        $this->assertNotEquals($concern->description, $concern->refresh()->description);
    }

    public function test_the_application_deletes_a_concern_when_logged_in(): void
    {
        $user = User::factory()->create();
        $concern = Concern::factory()->create();

        $this->actingAs($user)->delete(route('admin.concern.delete', $concern));

        $this->assertFalse(Concern::where(['description' => $concern->description])->exists());

    }

    public function test_adding_a_tag_to_a_concern() : void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $concern = Concern::factory()->create();

        $this->actingAs($user)->patch(route('admin.concern.tag.associate', ['concern' => $concern, 'tag' => $tag]), []);

        $this->assertTrue($concern->refresh()->tags->contains($tag));
    }

    public function test_adding_a_tag_to_a_concern_when_passed_in_request() : void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $concern = Concern::factory()->create();

        $this->actingAs($user)->patch(route('admin.concern.tag.store'), ['concern' => $concern->id, 'tag' => $tag->id]);

        $this->assertTrue($concern->refresh()->tags->contains($tag));
    }

    public function test_adding_a_tag_to_a_concern_when_passed_in_request_does_not_add_twice() : void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $concern = Concern::factory()->create();
        $concern->tags()->attach($tag->id);

        $this->actingAs($user)->patch(route('admin.concern.tag.store'), ['concern' => $concern->id, 'tag' => $tag->id]);

        $this->assertTrue($concern->refresh()->tags->containsOneItem());
    }

    public function test_removing_a_tag_from_a_concern() : void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $concern = Concern::factory()->create();
        $concern->tags()->save($tag);

        $this->actingAs($user)->delete(route('admin.concern.tag.delete', ['concern' => $concern, 'tag' => $tag]), []);

        $this->assertFalse($concern->refresh()->tags->contains($tag));
    }
}
