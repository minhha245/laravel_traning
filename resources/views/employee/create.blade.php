@extends('layouts.app')
@section('title', 'Create Employee')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Employee</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{route('employee.create-confirm')}}">
                            @csrf
                            <div class="form-group ">
                                <label for="avatar">Avatar*</label>
                                <label class="file-upload"><input class="avatar" type="text" name="avatar"
                                                                  onchange="readURL(this);" value="12346.png"></label>

                            </div>
                            @error('Avatar')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teams*</label>
                                <select name="team_id" id="team_id" class="custom-select">
                                    @foreach($teams as $value)
                                        <option value="{{$value->id}}"
                                            {{ old('team_id') == $value->id ? 'selected' : '' }}
                                        >{{$value->name}}
                                        </option>
                                    @endforeach
                                    @error('team')
                                    <small class="form-text text-danger"> {{ $message }}</small>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First name*</label>
                                <input type="text" name="first_name" class="form-control"
                                       value="{{ old('first_name')}}">

                            </div>
                            @error('first_name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last name*</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name')}}">
                            </div>
                            @error('last_name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email*</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email')}}">
                            </div>
                            @error('email')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gender* </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                           value="{{config('constant.GENDER_MALE')}}"
                                        {{ old('gender') == config('constant.GENDER_MALE') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                           value="{{config('constant.GENDER_FEMALE')}}"
                                        {{ old('gender') == config('constant.GENDER_FEMALE') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                            @error('gender')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Birthday</label>
                                <input type="date" name="birthday" class="form-control" value="{{ old('birthday')}}">
                            </div>
                            @error('birthday')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address*</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address')}}">
                            </div>
                            @error('address')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Salary*</label>
                                <input type="text" name="salary" class="form-control" value="{{ old('salary')}}">
                            </div>
                            @error('salary')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Position*</label>
                                <select name="position" id="position" class="custom-select">
                                    <option value="{{ config('constant.POSITION_MANAGER') }}"
                                        {{old('position') == config('constant.POSITION_MANAGER') ? 'selected' : '' }}
                                    >Manager
                                    </option>
                                    <option value="{{ config('constant.POSITION_TEAM_LEADER') }}"
                                        {{old('position') == config('constant.POSITION_TEAM_LEADER') ? 'selected' : '' }}
                                    >Team Leader
                                    </option>
                                    <option value="{{ config('constant.POSITION_BSE') }}"
                                        {{old('position') == config('constant.POSITION_BSE') ? 'selected' : '' }}
                                    >BSE
                                    </option>
                                    <option value="{{ config('constant.POSITION_DEV') }}"
                                        {{old('position') == config('constant.POSITION_DEV') ? 'selected' : '' }}
                                    >DEV
                                    </option>
                                    <option value="{{ config('constant.POSITION_TESTER') }}"
                                        {{old('position') == config('constant.POSITION_TESTER') ? 'selected' : '' }}
                                    >Tester
                                    </option>
                                </select>
                                @error('position')
                                <small class="form-text text-danger"> {{ $message }}</small>
                                @enderror
                                </select>
                            </div>
                            @error('position')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type of work*</label>
                                <select name="type_of_work" id="type_of_work" class="custom-select">
                                    <option value="{{ config('constant.TYPE_OF_WORK_FULL_TIME') }}"
                                        {{ old('type_of_work') == config('constant.TYPE_OF_WORK_FULL_TIME') ? 'selected' : '' }}
                                    >Full Time
                                    </option>
                                    <option value="{{ config('constant.TYPE_OF_WORK_PART_TIME') }}"
                                        {{ old('type_of_work') == config('constant.TYPE_OF_WORK_PART_TIME') ? 'selected' : '' }}
                                    >Part Time
                                    </option>
                                    <option value="{{ config('constant.TYPE_OF_WORK_PROBATIONARY_STAFF') }}"
                                        {{old('type_of_work') == config('constant.TYPE_OF_WORK_PROBATIONARY_STAFF') ? 'selected' : '' }}
                                    > Probationary Staff
                                    </option>
                                    <option value="{{ config('constant.TYPE_OF_WORK_INTERN') }}"
                                        {{ old('type_of_work') == config('constant.TYPE_OF_WORK_INTERN') ? 'selected' : '' }}
                                    >Intern
                                    </option>
                                    @error('type_of_work')
                                    <small class="form-text text-danger"> {{ $message }}</small>
                                    @enderror
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                           value="{{config('constant.STATUS_ON_WORKING')}}"
                                        {{ old('status') == config('constant.STATUS_ON_WORKING') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="inlineRadio1">On working</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                           value="{{config('constant.STATUS_RETIRED')}}"
                                        {{ old('status') == config('constant.STATUS_RETIRED') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="inlineRadio2"> Retired</label>
                                </div>
                            </div>
                            @error('status')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                            <div class="form-group d-flex mt-4" style="justify-content: space-between">
                                <span class="btn btn-secondary"><a href="{{route('employee.create')}}">Reset</a></span>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
