<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    public function test_updating_a_project_records_activity()
    {
        $project = ProjectFactory::create();
        $project->update(['title' => 'changed']);
        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }

    public function test_a_new_task_records_project_activity()
    {
        $project = ProjectFactory::create();
        $project->addTask('some Task');
        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    public function test_a_completing_task_records_project_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);
    }
}
