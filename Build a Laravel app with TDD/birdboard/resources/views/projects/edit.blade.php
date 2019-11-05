@extends('layouts.app')

@section('content')
<h1>Edit your project</h1>

<form method="POST" action="{{ $project->path() }}">
    {{ csrf_field() }}
    @method('PATCH')

    <div class="field">
        <label for="title" class="label">Title</label>
        <div class="control">
            <input value="{{ $project->title }}" required type="text" placeholder="title" name="title" class="input {{$errors->has('title') ? 'is-danger' :''}}">
        </div>
    </div>

    <div class="field">
        <label for="description" class="label">Description</label>
        <div class="control">
            <textarea required placeholder="description" name="description" class="textarea {{$errors->has('description') ? 'is-danger' :''}}">{{ $project->description }}</textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-link" type="submit">Update Project</button>
        <a href="{{ $project->path() }}">Cancel</a>
        </div>
    </div>
</form>
@endsection
