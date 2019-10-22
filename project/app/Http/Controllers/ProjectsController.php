<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        auth()->id(); // returns id eg. 4
        auth()->user(); // returns the User
        auth()->check(); // checks if the user is signed in Bool
        auth()->guest(); // checks if the user is a guest Bool


        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }
    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3']
        ]);

        $attributes['owner_id'] = auth()->id();

        Project::create($attributes);
        return redirect('/projects');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $project->update(request(['title', 'description']));
        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('/projects');
    }

    public function show(Project $project)
    {

        // abort_unless(auth()->user()->owns($project), 403);
        // abort_if($project->owner_id !== auth()->id(), 403);

        return view('projects.show', compact('project'));
    }
}
