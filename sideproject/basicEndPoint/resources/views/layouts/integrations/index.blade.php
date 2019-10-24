@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title is-4">Integrations</h4>
                </div>

                <div class="card-body">


                    <table class="table is-hoverable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                @foreach ($Integration as $item)
                            <tr>
                                <td><a href="/integrations/{{ $item->id }}">{{ $item->title }}</a></td>
                                <td></td>
                                </td>
                                <td><a href="/integrations/{{ $item->id }}/edit">Edit</a></td>
                            </tr>
                            @endforeach
                            </tr>

                        </tbody>
                    </table>

                    <a class="button" href="/integrations/create">Create Project</a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
