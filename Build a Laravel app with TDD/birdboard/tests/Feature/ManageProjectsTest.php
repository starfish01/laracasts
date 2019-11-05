<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function guests_cannot_manage_projects()
    {
        $project = factory('App\Project')->create();

        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/edit')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    public function test_a_user_can_view_their_project()
    {
        // $this->signIn();
        // $this->withoutExceptionHandling();
        // $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $project = factory('App\Project')->create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee(str_limit($project->description, 100));
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();
        // $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }


    public function test_an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();
        // $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();
        $this->patch($project->path())->assertStatus(403);
    }


    public function test_a_project_requires_a_title()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_only_authenticated_users_can_create_projects()
    {
        // $this->withoutExceptionHandling();

        $attributes = factory('App\Project')->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => $this->faker->sentence,
        ];

        $response = $this->post('/projects', $attributes);

        $project = \App\Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    public function test_a_user_can_update_a_project()
    {

        $project = ProjectFactory::create();

        $attributes = [
            'notes' => 'Changed Notes',
            'title' => 'Changed',
            'description' => 'Changed description'
        ];
        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes)
            ->assertRedirect($project->path());

           $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }
}
