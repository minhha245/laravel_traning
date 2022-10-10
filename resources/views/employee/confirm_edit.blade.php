@extends('layouts.app')
@section('title', 'Create Employee')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Employee</div>
                    <div class="card-body">


                        @csrf
                        <div class="form-group ">
                            <label class="col col-md-3" for="avatar">Avatar*</label>
                            <label class="file-upload"><input class="avatar" type="file" name="avatar"
                                                              onchange="readURL(this);" value=""></label>

                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Teams*</label>
                            <span> @if(session()->get('editEmployee')['team_id'])
                                    {{$teams->name}}
                                @endif
                                </span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">First name*</label>
                            <span> {{session()->get('editEmployee')['first_name']}}</span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Last name*</label>
                            <span> {{session()->get('editEmployee')['last_name']}}</span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Email*</label>
                            <span> {{session()->get('editEmployee')['email']}}</span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Gender* </label>
                            <span>
                                        {{ session()->get('editEmployee')['gender'] == config('constant.GENDER_MALE') ? 'Male' : 'Female' }}
                                  </span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Birthday</label>
                            <span> {{session()->get('editEmployee')['birthday']}}</span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Address*</label>
                            <span> {{session()->get('editEmployee')['address']}}</span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Salary*</label>
                            <span> {{session()->get('editEmployee')['salary']}}</span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Position*</label>
                            <span>
                                        @if(session()->get('editEmployee')['position'] == config('constant.POSITION_MANAGER'))
                                    Manager
                                @elseif(session()->get('editEmployee')['position'] == config('constant.POSITION_TEAM_LEADER'))
                                    Team Leader
                                @elseif(session()->get('editEmployee')['position'] == config('constant.POSITION_BSE'))
                                    BSE
                                @elseif(session()->get('editEmployee')['position'] == config('constant.POSITION_DEV'))
                                    DEV
                                @elseif(session()->get('editEmployee')['position'] == config('constant.POSITION_TEAM_TESTER'))
                                    Tester
                                @endif
                                </span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Type of work*</label>
                            <span>
                                    @if(session()->get('editEmployee')['type_of_work'] == config('constant.TYPE_OF_WORK_FULL_TIME'))
                                    Full Time
                                @elseif(session()->get('editEmployee')['type_of_work'] == config('constant.TYPE_OF_WORK_PART_TIME'))
                                    Part Time
                                @elseif(session()->get('editEmployee')['type_of_work'] == config('constant.TYPE_OF_WORK_PROBATIONARY_STAFF'))
                                    Probationary Staff
                                @elseif(session()->get('editEmployee')['type_of_work'] == config('constant.TYPE_OF_WORK_INTERN'))
                                    Intern
                                @endif
                                </span>
                        </div>

                        <div class="form-group">
                            <label class="col col-md-3" for="exampleInputEmail1">Status</label>
                            <span> {{ session()->get('editEmployee')['status'] == config('constant.STATUS_ON_WORKING') ? 'On working' : 'Retired' }}</span>
                        </div>

                        <div class="form-group d-flex mt-4" style="justify-content: space-between">
                            <span class="btn btn-secondary"><a href="{{ url()->previous() }}">Back</a></span>
                            <button type="button"
                                    class="btn btn-primary __web-inspector-hide-shortcut__ btn btn-primary"
                                    style="float: right; color: white;" data-toggle="modal" data-target="#modal-sm">Save
                            </button>
                            <div class="modal fade" id="modal-sm">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm</h5>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure ?
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                            </button>
                                            <form
                                                action="{{ route('employee.update', request()->id) }}"
                                                method="POST" style="display: inline-block">
                                                @csrf

                                                <button type="submit" class="btn btn-primary">OK</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
