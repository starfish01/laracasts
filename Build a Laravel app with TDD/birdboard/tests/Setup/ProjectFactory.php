<?php

namespace Tests\Setup;

class ProjectFactory {

    protected $taskCount = 0;
    protected $user;

    public function withTasks($count){
        $this->taskCount = $count;
        return $this;
    }

    public function ownedBy($user) {
        $this->user = $user;
        return $user;
    }

    public function create() {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class)
        ]);
        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id
        ]);
        return $project;
    }
}
