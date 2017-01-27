<!-- Edit Order Modal -->
<div class="modal fade" id="modal_edit_order" tabindex="-1" role="dialog" aria-labelledby="modal_edit_order">
    <div class="modal-dialog vdf_modal" role="document">
        <div class="modal-content vdf_modal_content">
            <div class="modal-header vdf_modal_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="vdf_modal_sub_header">
                    <h3>Edit Order</h3>
                </div>
            </div>
            <form action="/" class="form-horizontal vd_form">
                <div class="modal-body vdf_modal_body">

                    <div class="form-group">
                        <div class="col-md-6 vdf_modal_left ovh">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="table_label">Enter a SIM number</label>
                                    <input type="text" name="sim-edit" id="sim-edit" class="block_btn_30 modal_input_without_icon vd_number sim-edit" data-th="SIM Number" value="" disabled/>
                                </div>
                                <div class="col-md-6">
                                    <label class="table_label">SIM provider</label>
                                    <input type="text" name="sim_prv2" class="block_btn_30 modal_input_without_icon vd_required" data-th="Provider" value="Vodafone" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="single_package email_print" id="wrap_package_list_edit"></div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="table_label">Enter remarks</label>
                                        <textarea name="rem_txt2" id="remark-edit" class="modal_textarea"></textarea>
                                    </div>

                                </div>
                            </div>
                            @if(Auth::user()->level == 'Super admin')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <a href="#" class="inline_block_btn light_green_btn" onclick="" id="activate-button">Activate order</a>
                                            <a href="#" class="inline_block_btn" onclick="" id="suspend-button">Suspend order</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endif
                        </div>
                        <div class="col-md-6 vdf_modal_right">
                            <label class="table_label">Destination flight details</label>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                    <div class="wrap_date">
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="landing_date" id="landing_date" class="inline_block_btn landing_date vd_date_required" data-date-format="DD/MM/YYYY" disabled>
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker3" id="time_element2" class="inline_block_btn time_element vd_time_requiredc landing_time_val" disabled/>
                                        </div>
                                    </div>
                                    {{--<div class="wrap_time from">--}}
                                        {{--<i class="departure_time icon-time"></i>--}}
                                        {{--<div class="time_picker">--}}
                                            {{--<div  class="inline_block_btn numeric_input vdf_time vdf_hour" id="landing_hour-edit">0</div>--}}
                                            {{--<span class="arrow-down"><i class="icon-arrow_down"></i></span>--}}
                                            {{--<span class="arrow-up"><i class="icon-arrow_up"></i></span>--}}
                                            {{--</div>--}}
                                        {{--<div class="time_picker">--}}
                                            {{--<div class="inline_block_btn vdf_minute_picker vdf_time vdf_min" id="landing_minute-edit">0</div>--}}
                                            {{--<span class="arrow-down disable"><i class="icon-arrow_down"></i></span>--}}
                                            {{--<span class="arrow-up disable"><i class="icon-arrow_up"></i></span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                </div>
                                <div class="col-md-6">
                                    <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                    <div class="wrap_date">
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date" id="departure_date" class="inline_block_btn departure_date vd_date_required" data-date-format="DD/MM/YYYY" disabled>
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker4" id="time_element2" class="inline_block_btn time_element vd_time_requiredc departure_time_val" disabled/>
                                        </div>
                                    </div>
                                    {{--<div class="wrap_time to">--}}
                                        {{--<i class="departure_time icon-time"></i>--}}
                                        {{--<div class="time_picker">--}}
                                            {{--<div  class="inline_block_btn numeric_input vdf_time vdf_hour" id="departure_hour-edit">0</div>--}}
                                            {{--<span class="arrow-down"><i class="icon-arrow_down"></i></span>--}}
                                            {{--<span class="arrow-up"><i class="icon-arrow_up"></i></span>--}}
                                            {{--</div>--}}
                                        {{--<div class="time_picker">--}}
                                            {{--<div class="inline_block_btn vdf_minute_picker vdf_time vdf_min" id="departure_minute-edit">0</div>--}}
                                            {{--<span class="arrow-down"><i class="icon-arrow_down"></i></span>--}}
                                            {{--<span class="arrow-up"><i class="icon-arrow_up"></i></span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="table_label">Reference Number</label>
                                    <input type="text" id="reference_number-edit" class="block_btn_30 modal_input_without_icon" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="table_label">Customer phone number</label>
                                    @if(Auth::user()->level == 'Super admin')
                                    <div class="select_wrapper">
                                        <select  name="phone_number" id="phone_number-edit" class="block_btn_30 modal_input" disabled>
                                            <option value=""></option>
                                            @foreach($specials as $special)
                                            <option value="{{$special['id']}}">{{$special['phone']}}</option>
                                            @endforeach
                                        </select>
                                        <i class="input_icon icon-sim"></i>
                                    </div>
                                    @else
                                    <div class="relative">
                                        <input type="test" id="phone_number-edit2" class="block_btn_30 modal_input" name="phone_number-edit2" value="" disabled>
                                        <i class="input_icon icon-sim"></i>
                                    </div>
                                    @endif


                                </div>
                                <div class="col-md-6">
                                    <label class="table_label">Order Status</label>
                                    <input type="text" name="order_status-edit" id="order_status-edit" class="block_btn_30 modal_input_without_icon" value="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="order_key">Created by: </span><span class="order_value" id="creator">Deleted User 15/12/2016 12:40</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="order_key">Updated by: </span><span class="order_value" id="editor">Deleted User</span> <span id="edited_at"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                    {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Edit order</button>--}}
                    <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="edit-order">Update order</a>
                    <span class="success_response"></span>
                    <span class="error_response"></span>
                </div>
            </form>
        </div>
    </div>
</div><!-- end dit Order Modal -->
