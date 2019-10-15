@extends('layout')

@section('content')
<h1 class="title">Edit Project</h1>

<form method="POST" action="/projects/{{ $project->id }}">

    @method('PATCH')
    @csrf

    <div class="field">
        <label for="title" class="label">Title</label>
        <div class="control">
            <input type="text" placeholder="title" name="title" class="input" value="{{ $project->title }}">
        </div>
    </div>

    <div class="field">
        <label for="description" class="label">Description</label>
        <div class="control">
            <textarea placeholder="description" name="description" class="textarea">{{ $project->description }}</textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-link" type="submit">Update Project</button>
        </div>
    </div>

</form>
<form method="POST" action="/projects/{{ $project->id }}">
    @method('DELETE')
    @csrf

    <div class="field">
        <div class="control">
            <button class="button" type="submit">Delete Project</button>
        </div>
    </div>
</form>

@endsection('content')
