@extends('layouts.app')
@section('title', 'Search Employee')
<link rel="stylesheet" href="{{ asset('resources/css/search.css') }}">
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

                <div class="form-group row">
                    <span class="input-space">
                        <label for="team">Team</label>
                                <select name="team_id" id="team">
                                       @foreach($teams as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                     </span>
                </div>
                <div class="form-group row">
                    <span class="input-space">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="" id="email" maxlength="50">
                     </span>
                </div>
                <div class="form-group row">
                    <span class="input-space">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="" id="name">
                     </span>
                </div>

                <div class="form-group d-flex mt-4" style="justify-content: space-between">
                    {{--                        <button type="submit" class="btn btn-secondary" name="reset">Reset</button>--}}
                    <span><a class="btn btn-secondary" href="{{route('employee.search')}}">Reset</a></span>

                    <button type="submit" class="btn btn-primary">Search</button>
                </div>

            </form>
        </div>
        <!--            Pagging-->
        @include('layouts.pagging')
        <!--            Data Table-->
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-auto">
                    <div class="card">
                        <div class="card-header"></div>

                        <div class="card-body">

                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col"><a href="">ID <i class="fas fa-sort"></i></a></th>
                                    <th><a href="">Name <i class="fas fa-sort"></i></a></th>
                                    <th><a href="">Team <i class="fas fa-sort"></i></a></th>
                                    <th><a href="">Email <i class="fas fa-sort"></i></a></th>

                                    <th style="color: #0d6efd" scope="col">Gender</th>
                                    <th style="color: #0d6efd" scope="col">Birthday</th>
                                    <th style="color: #0d6efd" scope="col">Address</th>
                                    <th style="color: #0d6efd" scope="col">Avatar</th>
                                    <th style="color: #0d6efd" scope="col">Salary</th>
                                    <th style="color: #0d6efd" scope="col">Action</th>
                                </tr>

                                </thead>


                                <tbody>
                                @if(count($result)==0)

                                    <td colspan='6'>Not found data!</td>

                                @else
                                @endif

                                @foreach($result as $key => $employee)
                                    <tr>
                                        <th scope="row">{{$employee->id}}</th>
                                        <td>{{"$employee->first_name"." "."$employee->last_name"}}</td>
                                        <td>{{$employee->team_id}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->gender == config('constant.GENDER_MALE') ? 'Male':'Female'}}</td>
                                        <td>{{$employee->birthday}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{number_format($employee->salary,0,'','.'). "vnđ"}}</td>
                                        <td>
                                            <span><a class="btn btn-danger" href="{{route('employee.edit',[$employee->id])}}">Edit</a></span><span>
            <a class="btn btn-success" href="{{ route('employee.delete',[$employee->id]) }}"
               onclick="return confirm('Are you sure');">Delete</a>
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

