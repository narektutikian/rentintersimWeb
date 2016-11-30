@extends('layouts.admin')

@section('dashboard')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-horizontal" method="post" action="/user">
        <fieldset>

            <!-- Form Name -->
            <legend>Create new user</legend>
                {{csrf_field()}}
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="name" placeholder="full name" class="form-control input-md" required="" type="text">
                    <span class="help-block">required</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Primary Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" placeholder="Primary Email" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email2">Secundary Email</label>
                <div class="col-md-4">
                    <input id="email2" name="email2" placeholder="Secundary Email" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="level">Level</label>
                <div class="col-md-4">
                    <select id="level" name="level" class="form-control">
                        <option value="">Select Level</option>
                        <option value="Distributor">Distributor</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Subdealer">Subdealer</option>
                    </select>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="type">Type</label>
                <div class="col-md-4">
                    <select id="type" name="type" class="form-control">
                        <option value="">Select user type</option>
                        <option value="admin">Administrator</option>
                        <option value="manager">Manager</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="parent_id">Parent usernasme</label>
                <div class="col-md-4">
                    <select id="parent_id" name="supervisor_id" class="form-control">
                        <option value="">Select username</option>
                        @foreach($supervisors as $supervisor)
                        <option value="{{$supervisor['id']}}">{{$supervisor['login']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">Username</label>
                <div class="col-md-4">
                    <input id="login" name="username" placeholder="Username" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password" name="password" placeholder="Password" class="form-control input-md" required="" type="password">

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">save</label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Save</button>
                </div>
            </div>

        </fieldset>
    </form>

@endsection