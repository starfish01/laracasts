<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    public function test_a_user_can_view_their_project()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee(str_limit($project->description, 100));
    }

    public function test_an_authenticated_user_cannot_view_the_project_of_others()
    {
        $this->signIn();
        // $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
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
        // $this->withoutExceptionHandling();
        $this->signIn();
        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }
}
