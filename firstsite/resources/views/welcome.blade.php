@extends('layout')


@section('content')
<h1>My First Website - {{$foo}}</h1>

<ul>

    @foreach($tasks as $task)
        <li>{{$task}}</li>
    @endforeach

</ul>
@endsection('content')
