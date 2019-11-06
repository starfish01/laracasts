<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class ProjectsTasksController extends Controller
{
    //
    public function store(Project $project)
    {

        $this->authorize('update', $project);

        request()->validate([
            'body' => 'required'
        ]);
        $project->addTask(request('body'));
        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        // abort_unless(auth()->user()->is($project->owner), 403);

        $this->authorize('update', $task->project);

        request()->validate([
            'body' => 'required'
        ]);

        $task->update([
            'body' => request('body'),
        ]);

        if (request()->has('completed')) {
            $task->complete();
        }

        return redirect($project->path());
    }
}
