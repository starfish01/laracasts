@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title is-4">Integration - {{ $integration->title }}</h4>
                </div>

                <div class="card-body">

                    <div class="tabs">
                        <ul>
                            @if($integration->data->count())
                            @foreach($integration->data as $data)
                            <li @if(isset($integration_data) && $integration_data->id === $data->id ) class="is-active"
                                @endif><a
                                    href="/integrations/{{ $integration->id }}/data/{{$data->id}}">{{$data->title}}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    @if(isset($integration_data))

                    <form class="box" method="POST" action="/data/{{ $integration_data->id }}">
                        @csrf
                        @method('PATCH')

                        <div class="field">
                            <div class="control">
                                <textarea name="description"
                                    class="textarea is-success">{{$integration_data->description}}</textarea>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-link" type="submit">
                                    Update
                                </button>

                            </div>
                        </div>

                    </form>

                    <a target="_blank" href="/data/{{ $integration_data->id }}/output">Outputdata</a>

                    <hr>
                    <form method="POST" action="/data/{{ $integration_data->id }}">
                        @method('DELETE')
                        @csrf
                        <div class="field is-pulled-right">
                            <div class="control">
                                <button class="button is-danger" type="submit">Delete Integration</button>
                            </div>
                        </div>
                    </form>

                    @endif


                </div>
            </div>


            <form class="box" method="POST" action="/integrations/{{ $integration->id }}/data">
                @csrf

                <div class="field">
                    <label for="title" class="label">Integration</label>
                    <div class="control">
                        <input required type="text" placeholder="title" name="title" class="input">
                    </div>
                </div>

                <input type="hidden" name="integration_id" value="{{ $integration->id }}">

                <div class="field">
                    <div class="control">
                        <button class="button is-link" type="submit">Add Integration</button>
                    </div>
                </div>
                @include('layouts.core.errors')
            </form>


        </div>
    </div>
</div>

@endsection
