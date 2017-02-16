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
                            <legend>CLI Check:</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Phone number</label>
                                <div class="col-md-4">
                                    <input id="cli_phone" name="phone" placeholder="Enter CLI"
                                           class="block_btn_30 modal_input_without_icon vd_number" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="singlebutton"></label>
                                    <div class="col-md-1">
                                        <button id="cli_button" type="button" class="btn btn-primary vd_form_submit">
                                            Send
                                        </button>
                                    </div>
                                    <div class="col-md-2" id="response">

                                    </div>
                                </div>
                                </div>


                        </fieldset>
                    </form>
                    <form class="form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Current SIM number</label>
                            <div class="col-md-4">
                                <input id="response_text" class="block_btn_30 modal_input_without_icon " type="text" disabled>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                        </form>
                </div>
            </div>
        </section>

    </div><!--end of Type management-->


@endsection