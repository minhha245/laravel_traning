@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('resources/css/search.css') }}">
    <title>Team - Search</title>

    <div id="form_search">
        <form method="GET" action="{{ route('teams.search') }}">
                    <span class="input-space">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="" id="name">
                     </span>
            <div class="form-group d-flex mt-4" style="justify-content: space-between">
                <button type="submit" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <!--            Pagging-->
    @include('layouts.pagging')
    <!--            Data Table-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">

                            rehrthg

                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Action</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($teams as $key => $team)
                                <tr>
                                    <th scope="row">{{$team->id}}</th>
                                    <td>{{$team->name}}</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="btn btn-danger"><a href="{{ route('teams.edit',[$team->id]) }}">Edit</a></span>
                                        <span class="btn btn-success">
            <a href="{{ route('teams.delete',[$team->id]) }}" onclick="return confirm('Are you sure');">Delete</a>
      </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
