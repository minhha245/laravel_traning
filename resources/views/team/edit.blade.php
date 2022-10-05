@extends('layouts.app')

@section('content')

    <title>Admin - Edit</title>
    <link rel="stylesheet" href="{{ asset('resources/css/create.css') }}">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div id="wrapper-create">
        <h4>Admin - Edit</h4>
        <form method="POST" action="{{ route('teams.edit-confirm', $teams->id) }}" enctype="multipart/form-data">
            @csrf
            <div id="wrapper-create-sub">
                <div id="wrapper-create-form">
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">ID</label>
                        {{$teams->id}}
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name*</label>
                        <input type="text" maxlength="255" class="form-control" id="name" name="name"
                               value="{{old('name', isset($teams) ? $teams->name : '' ) }}">
                    </div>

                    <div class="form-group d-flex mt-4" style="justify-content: space-between">
                        <!-- <button type="submit" class="btn btn-secondary">Reset</button> -->
                        <span class="btn btn-secondary"><a href="{{route('teams.edit',[$teams->id])}}">Reset</a></span>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
        </form>
    </div>

@endsection



