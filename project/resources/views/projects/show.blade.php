@extends('layout')

@section('content')
<h1 class="title">Project - {{ $project->title }}</h1>
<div class="content">
    <p>{{ $project->description }}</p>
    <a href="/projects/{{ $project->id }}/edit">Edit</a>
</div>

<hr>

@if($project->tasks->count())
<div>
    @foreach($project->tasks as $task)
    <div>

        <form method="POST" action="/tasks/{{ $task->id }}">
            @method('PATCH')
            @csrf
            <label for="completed" class="checkbox">
                <input {{ $task->completed ? 'checked':''}} type="checkbox" name="completed"
                    onChange="this.form.submit()">
                {{ $task->description }}
            </label>
        </form>


    </div>
    @endforeach
</div>
@endif


@endsection
