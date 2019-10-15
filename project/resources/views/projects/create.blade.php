@extends('layout')
@section('content')

<h1>Create a new project</h1>

<form method="POST" action="/projects">
    {{ csrf_field() }}

    <div class="field">
        <label for="title" class="label">Title</label>
        <div class="control">
            <input type="text" placeholder="title" name="title" class="input">
        </div>
    </div>

    <div class="field">
        <label for="description" class="label">Description</label>
        <div class="control">
            <textarea placeholder="description" name="description" class="textarea"></textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-link" type="submit">Create Project</button>
        </div>
    </div>
</form>
@endsection('content')
