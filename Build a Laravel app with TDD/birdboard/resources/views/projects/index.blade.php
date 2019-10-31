@extends('layouts.app')

@section('content')

<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between item-center w-full">
        <h2 class="text-grey">My Projects</h2>

        <a class="button" href="/projects/create">New Project</a>
    </div>

</header>

<div class="lg:flex lg:flex-wrap -mx-3">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        <div class="bg-white rounded shadow p-5" style="height:200px">
            <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-300 pl-4 mb-3">
                <a href="{{ $project->path() }}">
                    {{ $project->title }}
                </a>
            </h3>
            <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
        </div>

    </div>

    @endforeach
</div>

@endsection
