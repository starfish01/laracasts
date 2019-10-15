@extends('layout')
@section('content')
    <h1 class="title">Projects</h1>
<hr>
    <ul>
        @foreach ($projects as $project)
            <li>{{ $project->title }}</li>
        @endforeach
    </ul>
@endsection('content')
