@extends('layouts.app')

@section('content')

<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-grey"><a href="/projects">My Projects</a> / {{ $project->title }}</p>

        <div class="flex item-center">

            @foreach($project->members as $member)
            <img src="{{ gravater_url($member->email) }}" alt="{{ $member->name  }}" class="rounded-full w-10 mr-2">
            @endforeach

            <img src="{{ gravater_url($project->owner->name) }}" alt="{{ $project->owner->name  }}"
                class="rounded-full w-10 mr-2">

            <a class="button" href="{{ $project->path() . '/edit/' }}">Edit Project</a>

        </div>
    </div>

</header>

<main>
    <h2 class="text-grey font-normal mb-5">Tasks</h2>
    <div class="lg:flex -m-3">
        <div class="lg:w-3/4 px-3 mb-8">
            <div class="mb-6">
                @foreach($project->tasks as $task)
                <div class="card mb-3">
                    <form action="{{ $task->path() }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="flex">
                            <input name="body" require class="w-full {{ $task->completed ? 'text-grey' : '' }}"
                                value="{{$task->body}}">
                            <input name="completed" type="checkbox" {{ $task->completed ? 'checked' : '' }}
                                onChange="this.form.submit()">

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
                    <textarea name="notes" placeholder="Are there any notes you would like to make?"
                        class="card w-full mb-3">{{ $project->notes }}
                    </textarea>

                    <button type="submit" class="button">Update</button>

                </form>

                @include('errors')

            </div>

        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
            @include('projects.activity.activity_card')


            <div class="card flex flex-col mt-3">
                <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-300 pl-4 mb-3">
                    Invite a user
                </h3>

                <form method="POST" action="{{ $project->path() . '/invitations' }}">
                    @csrf

                    <div class="mb-3">
                        <input class="border border-grey rounded py-3 py=t-3" placeholder="Enter Email" type="email" name="email" id="email">
                    </div>

                    <button type="submit" class="button">Invite</button>
                </form>
                @include('errors', ['bag' => 'invitations'])
            </div>



        </div>


    </div>


</main>
@endsection
