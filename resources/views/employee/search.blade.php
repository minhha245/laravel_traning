@extends('layouts.app')
@section('title', 'Search Employee')
<link rel="stylesheet" href="{{ asset('./resources/css/search.css') }}">
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
                                <select name="team_id" id="team_id">
                                       @foreach($teams as $value)
                                        <option value="{{$value->id}}" {{(isset(request()->team_id) && $value->id == request()->team_id)?'selected':''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                     </span>
                </div>
                <div class="form-group row">
                    <span class="input-space">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="{{request()->email}}" id="email" maxlength="50">
                     </span>
                </div>
                <div class="form-group row">
                    <span class="input-space">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{request()->name}}" id="name">
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
{{--        @include('layouts.pagging')--}}
            <div>
                <a href="{{route('employee.export', request()->all())}}" class="btn btn-success"
                   style="margin-bottom: 20px; margin-left:200px;"> Export CSV</a>

            </div>
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
                                    <th onclick="sortByField('id')" scope="col">ID <i class="fas fa-sort"></i></th>
                                    <th onclick="sortByField('first_name')">Name <i class="fas fa-sort"></i></th>
                                    <th onclick="sortByField('team_id')">Team <i class="fas fa-sort"></i></th>
                                    <th onclick="sortByField('email')">Email <i class="fas fa-sort"></i></th>

                                    <th scope="col">Gender</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Avatar</th>
                                    <th onclick="sortByField('salary')"scope="col">Salary <i class="fas fa-sort"></i></th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>


                                <tbody>
                                @if(count($result)==0)

                                    <td colspan='6'>Not found data!</td>

                                @else
                                @endif

                                @foreach($result as $employee)

                                    <tr>
                                        <th scope="row">{{$employee->id}}</th>
                                        <td>{{$employee->full_name}}</td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->gender == config('constant.GENDER_MALE') ? 'Male':'Female'}}</td>
                                        <td>{{$employee->birthday}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td><img width="100px" height="100px" src="{{asset(config('constant.PATH_IMG_STORAGE').($employee->avatar))}}"></td>
                                        <td>{{number_format($employee->salary,0,'','.'). " vnđ"}}</td>
                                        <td>
                                            <span><a class="btn btn-danger" href="{{route('employee.edit',[$employee->id])}}">Edit</a></span>
                                            <span> <a class="btn btn-success" href="{{ route('employee.delete',[$employee->id]) }}">Delete</a></span>
{{--            <button type="button"--}}
{{--                    class="btn btn-primary __web-inspector-hide-shortcut__ btn btn-primary"--}}
{{--                    style="float: right; color: white;" data-toggle="modal" data-target="#modal-sm">Delete--}}
{{--                            </button>--}}
{{--                            <div class="modal fade" id="modal-sm">--}}
{{--                                <div class="modal-dialog modal-sm">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title">Confirm</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            Are you sure ?--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-footer justify-content-between">--}}
{{--                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel--}}
{{--                                            </button>--}}
{{--                                                --}}
{{--                                            <a class="btn btn-success" href="{{ route('employee.delete',[$employee->id]) }}">OK</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="page-navigation" style="margin-bottom: 1px!important;">
                                {{ $result->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

