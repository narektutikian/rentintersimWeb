@extends('layouts.admin')

@section('dashboard')

    <div id="type_management">
        <section class="filter_status">
            <div class="type_management_wrapper">


                <div class="clear"></div>
            </div>
        </section>
        <section class="">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal vd_form" id="cli_check">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>CLI Check</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Phone number</label>
                                <div class="col-md-4">
                                    <input id="cli_phone" name="phone" placeholder="phone number"
                                           class="form-control input-md vd_number" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton"></label>
                                <div class="col-md-4">
                                    <button id="cli_button" type="button" class="btn btn-primary vd_form_submit">Send
                                    </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                    <div class="row">
                        <div class="col-md-3" ></div>
                        <div class="col-md-6" id="response"></div>
                    </div>
                </div>
            </div>
        </section>

    </div><!--end of Type management-->


@endsection