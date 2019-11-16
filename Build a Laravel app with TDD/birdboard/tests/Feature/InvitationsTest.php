<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;


class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    function test_a_project_can_invite_a_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => $userToInvite->email
        ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    function test_invited_users_may_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(\App\User::class)->create());

        $this->signIn($newUser);
        $this->post(action('ProjectsTasksController@store', $project), $task = ['body' => 'Foo Task']);


        $this->assertDatabaseHas('tasks', $task);
    }

    function test_the_invited_email_should_be_part_of_the_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => 'not@gamil.com'
        ])->assertSessionHasErrors(['email' => 'The user your inviting must have a bird board account']);

    }

    function test_non_owners_may_not_invite_users()
    {
//        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post($project->path() . '/invitations')
            ->assertStatus(403);


    }

}
