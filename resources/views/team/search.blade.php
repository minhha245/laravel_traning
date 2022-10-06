@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('resources/css/search.css') }}">
@section('title', 'SearchTeam')

@section('content')

    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
              <p>{{ session('error') }}</p>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success" role="alert">
               <p>{{session('message')}}</p>
            </div>
        @endif

        <div id="form_search">

            <form method="GET" action="">
                    <span class="input-space">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="" id="name">
                     </span>
                <div class="form-group d-flex mt-4" style="justify-content: space-between">
                    <!-- <button type="submit" class="btn btn-secondary">Reset</button> -->
                    <span class="btn btn-secondary"><a href="{{route('teams.search')}}">Reset</a></span>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!--            Pagging-->
        @include('layouts.pagging')
        <!--            Data Table-->
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header"></div>

                        <div class="card-body">

                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th><a href="">ID <i class="fas fa-sort"></i></a></th>
                                    <th><a href="">Name <i class="fas fa-sort"></i></a></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>


                                <tbody>
                                @php
                                    $count =count($result);
                                @endphp
                                @if($count==0)

                                    <td colspan='6'>Not found data!</td>

                                @else
                                @endif

                                @foreach($result as $key => $team)
                                    <tr>
                                        <th scope="row">{{$team->id}}</th>
                                        <td>{{$team->name}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="btn btn-danger"><a
                                                    href="{{ route('teams.edit',[$team->id]) }}">Edit</a></span>
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
