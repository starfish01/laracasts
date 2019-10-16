@extends('layout')

@section('content')
<h1 class="title">Project - {{ $project->title }}</h1>
<div class="content">
    <p>{{ $project->description }}</p>
    <a href="/projects/{{ $project->id }}/edit">Edit</a>
</div>

<hr>

@if($project->tasks->count())
<div class="box">
    @foreach($project->tasks as $task)
    <div>

        <form method="POST" action="/tasks/{{ $task->id }}">
            @method('PATCH')
            @csrf
            <label for="completed" class="checkbox {{ $task->completed ? 'is-done':''}}">
                <input {{ $task->completed ? 'checked':''}} type="checkbox" name="completed"
                    onChange="this.form.submit()">
                {{ $task->description }}
            </label>
        </form>


    </div>
    @endforeach
</div>
@endif

{{-- add new task --}}


<form class="box" method="POST" action="/projects/{{ $project->id }}/tasks">
    @csrf

    <div class="field">
        <label for="description" class="label">Task</label>
        <div class="control">
            <input required type="text" placeholder="Task" name="description" class="input">
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-link" type="submit">Add Task</button>
        </div>
    </div>
    @include('errors')
</form>



@endsection
