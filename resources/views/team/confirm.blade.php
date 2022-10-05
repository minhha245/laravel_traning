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

        <div id="wrapper-create-sub">
                <div id="wrapper-create-form">
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">ID</label>
                        {{request()->id}}
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name*</label>
                        {{session('editTeam')['name']}}
                    </div>
                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            <div class="form-group d-flex mt-4" style="justify-content: space-between">
                <a href="{{ url()->previous() }} " class="btn btn-secondary">Back</a>
                <button type="button" class="btn btn-primary __web-inspector-hide-shortcut__ btn btn-primary" style="float: right; color: white;" data-toggle="modal" data-target="#modal-sm">Save</button>
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
                                    action="{{ route('teams.update', request()->id) }}"
                                    method="POST" style="display: inline-block">
                                    @csrf
                                    <input type="hidden" class="form-control" name="name"
                                           value="{{ session('editTeam')['name'] }}"
                                           id="name"
                                           aria-describedby="name">
                                    <button type="submit" class="btn btn-primary">OK</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

    </div>
@endsection



