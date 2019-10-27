<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;


class ProjectTasksController extends Controller
{
    public function update(Task $task)
    {
      $method = request()->has('completed') ? 'complete' : 'incomplete';
      $task->$method();
      return back();
    }


    public function store(Project $project)
    {

        $attributes = request()->validate(['description' => ['required', 'min:3', 'max:255']]);

        $project->addTask($attributes);
        return back();
    }
}
