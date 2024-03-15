<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Observation;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class ObservationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->data = Observation::factory()->make(['name' => 'New Observation'])->toArray();
    }

    public function test_the_application_fails_when_not_logged_in(): void
    {
        $response = $this->post(route('admin.observation.store'), $this->data);
        $response->assertRedirectToRoute('login');

        $response = $this->patch(route('admin.observation.update', Observation::factory()->create()), $this->data);
        $response->assertRedirectToRoute('login');

        $response = $this->delete(route('admin.observation.delete', Observation::factory()->create()));
        $response->assertRedirectToRoute('login');
    }

    public function test_the_application_stores_a_new_observation_when_logged_in(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.observation.store'), $this->data);

        $this->assertCount(1, Observation::all());

    }

    public function test_the_application_updates_a_observation_when_logged_in(): void
    {
        $user = User::factory()->create();
        $observation = Observation::factory()->create();

        $this->actingAs($user)
            ->patch(route('admin.observation.update', $observation), array_merge($this->data, ['name' => 'Updated Observation']));

        $this->assertNotEquals($observation->name, $observation->refresh()->name);

    }

    public function test_the_application_deletes_a_observation_when_logged_in(): void
    {
        $user = User::factory()->create();
        $observation = Observation::factory()->create();

        $this->actingAs($user)->delete(route('admin.observation.delete', $observation));

        $this->assertFalse(Observation::where(['name' => $observation->name])->exists());

    }

}
