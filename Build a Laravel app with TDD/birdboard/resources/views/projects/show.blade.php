@extends('layouts.app')

@section('content')

<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-grey"><a href="/projects">My Projects</a> / {{ $project->title }}</p>

        <a class="button" href="{{ $project->path() . '/edit/' }}">Edit Project</a>
    </div>

</header>

<main>
    <div class="lg:flex -m-3">
        <div class="lg:w-3/4 px-3 mb-8">
            <div class="mb-6">
                <h2 class="text-grey font-normal mb-3">Tasks</h2>
                @foreach($project->tasks as $task)
                <div class="card mb-3">
                    <form action="{{ $task->path() }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="flex">
                            <input name="body" require class="w-full {{ $task->completed ? 'text-grey' : '' }}" value="{{$task->body}}">
                            <input name="completed" type="checkbox" {{ $task->completed ? 'checked' : '' }} onChange="this.form.submit()">

                        </div>

                    </form>

                </div>
                @endforeach
                <div class="card mb-3">
                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input name="body" require class="w-full" placeholder="Add a new task...">

                    </form>
                </div>

            </div>
            <div>
                <h2 class="text-grey font-normal mb-3">General Notes</h2>
                <form action="{{ $project->path() }}" method="POST">
                    @method('patch')
                    @csrf
                    <textarea name="notes" placeholder="Are there any notes you would like to make?" class="card w-full mb-3">{{ $project->notes }}
                    </textarea>

                    <button type="submit" class="button">Update</button>

                </form>

                @include('errors')

            </div>

        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>

    </div>


</main>
@endsection