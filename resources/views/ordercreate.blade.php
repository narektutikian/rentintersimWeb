@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="order-create-div"></div>
    <form class="form-horizontal" method="post" action="/user">
        <fieldset>

            <!-- Form Name -->
            <legend>Create new user</legend>
        {{csrf_field()}}
        <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Sim</label>
                <div class="col-md-4">
                    <input id="sim" name="sim" placeholder="full name" class="form-control input-md" required="" type="text">
                    <span class="help-block">required</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">landing</label>
                <div class="col-md-4">
                    <input id="landing" name="landing" placeholder="Primary Email" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email2">departure</label>
                <div class="col-md-4">
                    <input id="departure" name="departure" placeholder="Secundary Email" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="level">package_id</label>
                <div class="col-md-4">
                    <select id="package_id" name="package_id" class="form-control">
                        <option value="">Select package_id</option>
                        <option value="28">Package 1</option>
                        <option value="22">Package 2</option>
                        <option value="23">Package 3</option>
                    </select>
                </div>
            </div>



            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">provider_id</label>
                <div class="col-md-4">
                    <input id="provider_id" name="provider_id" placeholder="Username" class="form-control input-md"  type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">reference_number</label>
                <div class="col-md-4">
                    <input id="reference_number" name="reference_number" placeholder="reference_number" class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">remark</label>
                <div class="col-md-4">
                    <input id="remark" name="remark" placeholder="reference_number" class="form-control input-md" type="text">

                </div>
            </div>


            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">save</label>
                <div class="col-md-4">
                    <button id="create-order" name="singlebutton" class="btn btn-primary">Save</button>
                </div>
            </div>

        </fieldset>
    </form>

@endsection
