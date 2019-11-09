<?php

namespace Tests\Feature;

use App\Task;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creating_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);


        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('created', $activity->description);
            $this->assertNull($activity->changes);
        });
    }

    public function test_updating_a_project()
    {
        $project = ProjectFactory::create();
        $originalTitle = $project->title;
        $project->update(['title' => 'changed']);
        $this->assertCount(2, $project->activity);

        $this->assertEquals('updated', $project->activity->last()->description);

        tap($project->activity->last(), function ($activity) use ($originalTitle) {
            $this->assertEquals('updated', $activity->description);
            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'changed']
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    public function test_a_new_task()
    {
        $project = ProjectFactory::create();
        $project->addTask('some Task');
        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });

        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    public function test_a_completing_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);


        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('completed_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
    }


    public function test_a_incompleting_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $this->assertCount(4, $project->activity);

        $this->assertEquals('incomplete_task', $project->activity->last()->description);
    }

    public function test_deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->delete();


        $this->assertCount(3, $project->activity);
    }
}
