@extends('layout')
@section('content')
<h1 class="title">Projects</h1>
<hr>

<h4 class="title is-4">Projects Created</h4>
<table class="table is-hoverable">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->description }}</td>
            <td><a href="projects/{{ $project->id }}/edit">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="projects/create" class="btn is-link">Create Project</a>


@endsection('content')
