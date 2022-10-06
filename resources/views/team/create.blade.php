@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Team</div>
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
                        <form method="POST" action="{{route('teams.create-confirm')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name*</label>
                                <input type="text" maxlength="255" class="form-control" id="name" name="name" value="{{old('name')}}">
                            </div>

                            <div class="form-group d-flex mt-4" style="justify-content: space-between">

                                <span class="btn btn-secondary"><a href="{{route('teams.create')}}">Reset</a></span>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
