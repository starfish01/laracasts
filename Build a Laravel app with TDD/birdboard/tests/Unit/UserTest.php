<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;


class UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_has_projects()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    public function test_a_user_has_accessible_projects()
    {
        $john = $this->signIn();

        ProjectFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->accessibleProjects());

        $sally = factory(User::class)->create();
        $nick =  factory(User::class)->create();

        $sallyProject = tap(ProjectFactory::ownedBy($sally)->create())->invite($nick);

        $this->assertCount(1, $john->accessibleProjects());

        $sallyProject->invite($john);

        $this->assertCount(2, $john->accessibleProjects());

     }
}
