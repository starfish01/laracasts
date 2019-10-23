@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title is-4">Create Integration</h4>
                </div>
                <div class="card-content">
                    <form method="POST" action="/integrations">

                        {{ csrf_field() }}

                        <div class="field">
                            <label for="title" class="label">Title</label>
                            <div class="control">
                                <input value="{{ old('title') }}" required type="text" placeholder="title" name="title" class="input {{$errors->has('title') ? 'is-danger' :''}}">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-link" type="submit">Create Integration</button>
                            </div>
                        </div>

                    </form>

                    @include('layouts.core.errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
