<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;


class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    function test_a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $project->invite( $newUser = factory(\App\User::class)->create());

        $this->signIn($newUser);
        $this->post(action('ProjectTaskController@store', $project), $task = ['body' => 'Foo Task']);


        $this->assertDatabaseHas('tasks', $task);


    }
}
