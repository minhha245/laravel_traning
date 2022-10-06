@extends('layouts.app')
@section('title', 'Create Employee')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Employee</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="">
                            @csrf
                            <div class="form-group ">
                                <label for="avatar">Avatar*</label>
                                <label class="file-upload"><input class="avatar" type="file" name="avatar"
                                                                  onchange="readURL(this);" value=""></label>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teams*</label>
                                <select name="team" class="custom-select">
                                    <option value="0">Test</option>
                                    <option value="1">QA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First name*</label>
                                <input type="text" name="firstname" class="form-control" value="">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last name*</label>
                                <input type="text" name="lastname" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gender* </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Birthday</label>
                                    <input type="date" name="birthday" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address*</label>
                                    <input type="text" name="address" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Salary*</label>
                                    <input type="text" name="salary" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Position*</label>
                                    <select name="position" class="custom-select">
                                        <option value="0">Test</option>
                                        <option value="1">QA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type of work*</label>
                                    <select name="typeofwork" class="custom-select">
                                        <option value="0">Fulltime</option>
                                        <option value="1">Partime</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">On working</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Retired</label>
                                    </div>
                                </div>
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
