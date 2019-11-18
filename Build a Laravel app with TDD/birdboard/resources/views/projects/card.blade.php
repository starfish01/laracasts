<div class="card flex flex-col" style="height:200px">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-300 pl-4 mb-3">
        <a href="{{ $project->path() }}">
            {{ $project->title }}
        </a>
    </h3>
    <div class="text-grey mb-3 flex-1">{{ str_limit($project->description, 100) }}</div>
    <footer>

        <form class="text-right text-xs" method="POST" action="{{ $project->path() }}">
            @method('DELETE')
            @csrf
            <button type="submit">Delete</button>
        </form>
    </footer>
</div>
