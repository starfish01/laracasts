@extends('layout')
@section('content')

<h1>Create a new project</h1>

<form method="POST" action="/projects">
    {{ csrf_field() }}

    <div>
        <input type="text" placeholder="Project title" name="title">
    </div>
    <div>
        <textarea placeholder="description" name="description"></textarea>
    </div>
    <div>
        <button type="submit">Create Project</button>
    </div>
</form>
@endsection('content')
