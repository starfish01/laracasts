<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageIntegrationTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_may_not_create_a_integration()
    {

        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $this->get('/integrations/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->title
        ];

        $this->post('/integrations', $attributes)->assertRedirect('integrations');

        $this->assertDatabaseHas('integrations', $attributes);

        $this->get('integrations')->assertSee($attributes['title']);

     }
}
