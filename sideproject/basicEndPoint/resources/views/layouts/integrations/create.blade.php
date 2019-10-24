@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title is-4">{{ $integration->title ?? 'Create' }}</h4>
                </div>
                <div class="card-content">
                    <form method="POST" @if(isset($integration)) action="/integrations/{{ $integration->id }}" @else
                        action="/integrations" @endif)>

                        @if(isset($integration))
                            @method('PATCH')
                        @endif

                        {{ csrf_field() }}

                        <div class="field">
                            <label for="title" class="label">Title</label>
                            <div class="control">
                                <input
                                    value="{{ old('title') }}@if(isset($integration) && empty(old('title')) ){{$integration->title }}@endif"
                                    required type="text" placeholder="title" name="title"
                                    class="input {{$errors->has('title') ? 'is-danger' :''}}">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-link" type="submit">
                                    @if(isset($integration))
                                    Update
                                    @else
                                    Create
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(isset($integration))
                    <form method="POST" action="/integrations/{{ $integration->id }}">
                        @method('DELETE')
                        @csrf

                        <div class="field">
                            <div class="control">
                                <button class="button" type="submit">Delete Project</button>
                            </div>
                        </div>
                    </form>
                    @endif

                    @include('layouts.core.errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
