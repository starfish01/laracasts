<?php

namespace Tests\Feature;

use App\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectsTasksTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);


        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);
        $this->get($project->path())
            ->assertSee('Test Task');
    }

    public function test_only_the_owner_may_add_tasks()
    {
        $this->signIn();
        $project = factory(Project::class)->create();
        $this->post($project->path() . '/tasks', ['body' => 'Test Task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
    }

    public function test_a_task_requires_a_body()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);
        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }

    public function test_a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();


        $project =  app(ProjectFactory::class)->ownedBy($this->signIn())->withTasks(1)->create();

        // $this->signIn();
        // $project = factory(Project::class)->create(['owner_id' => auth()->id()]);
        // $task = $project->addTask('task task');

        $attributes = [
            'body' => 'changed',
            'completed' => true
        ];

        $this->patch($project->path() . '/tasks/' . $project->tasks[0]->id, $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    public function test_only_an_owner_of_a_task_can_update()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();
        $project = factory(Project::class)->create();
        $task = $project->addTask('task task');

        $attributes = [
            'body' => 'changed',
            'completed' => true
        ];

        $this->patch($task->path(), $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $attributes);
    }
}
