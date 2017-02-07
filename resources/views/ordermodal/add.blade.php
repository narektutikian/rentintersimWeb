<!-- Add Order Modal -->
<div class="modal fade no-print" id="modal_new_order" data-keyboard="false" role="dialog" aria-labelledby="modal_new_order">
    <div class="modal-dialog vdf_modal" role="document">
        <div class="modal-content vdf_modal_content">
            <div class="modal-header vdf_modal_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="vdf_modal_sub_header">
                    <h3>New Order</h3>
                </div>
            </div>
            <form action="/" class="form-horizontal vd_form">
                <div class="modal-body vdf_modal_body">

                    <div class="form-group">
                        <div class="col-md-6 vdf_modal_left ovh">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="table_label">Enter a SIM number <span class="required_mark">*</span></label>
                                    <input type="text" name="sim1" id="sim" class="block_btn_30 modal_input_without_icon vd_number" value=""/>
                                </div>
                                <div class="col-md-6">
                                    <label class="table_label">SIM provider</label>
                                    <input type="text" name="sim_prv1" class="block_btn_30 modal_input_without_icon" value="Vodafone" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="table_label">Choose a SIM package </label>
                                    <div class="wrap_package_list"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="table_label">Enter remarks</label>
                                    <textarea name="rem_txt1" id="remark" class="modal_textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 vdf_modal_right">
                            <label class="table_label">Destination flight details <span class="required_mark">*</span></label>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                    <div class="wrap_date">
                                        <div id="lnd" class="input-group flight_dates lnd flight_picker" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="landing_date" id="landing_date" class="inline_block_btn landing_date vd_date_required" data-date-format="DD/MM/YYYY">
                                        </div>
                                        <div class="wrap_time" id="lnd_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker" id="time_element" class="inline_block_btn time_element vd_time_required"/>
                                        </div>
                                    </div>


                                    <!--    <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <div class="time_picker">
                                                <div  class="inline_block_btn numeric_input vdf_time vdf_hour" id="landing_hour">0</div>

                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                            <div class="time_picker">
                                                <div class="inline_block_btn vdf_minute_picker vdf_time vdf_min" id="landing_minute">0</div>

                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                        </div>-->

                                </div>
                                <div class="col-md-6">
                                    <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                    <div class="wrap_date">
                                        <div id="dpr" class="input-group flight_dates dpr flight_picker" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date" id="departure_date" class="inline_block_btn departure_date vd_date_required" data-date-format="DD/MM/YYYY">
                                        </div>
                                        <div class="wrap_time" id="dpr_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker2" id="time_element2" class="inline_block_btn time_element vd_time_required departure_time_val"/>
                                        </div>
                                    </div>


                                    <!--    <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <div class="time_picker">
                                                <div  class="inline_block_btn numeric_input vdf_time vdf_hour" id="departure_hour">0</div>

                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                            <div class="time_picker">
                                                <div class="inline_block_btn vdf_time vdf_min" id="departure_minute">0</div>

                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                        </div>-->

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="table_label">Reference Number</label>
                                    <input type="text" id="reference_number" class="block_btn_30 modal_input_without_icon" value="">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="table_label">Customer phone number</label>
                                    @if(Auth::user()->level == 'Super admin')
                                        <div class="select_wrapper">
                                            <select  name="phone_number" id="phone_number" class="block_btn_30 modal_input" >
                                                <option value=""></option>
                                                {{--@foreach($specials as $special)--}}
                                                    {{--<option value="{{$special['id']}}">{{$special['phone']}}</option>--}}
                                                {{--@endforeach--}}
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    @else
                                        <div class="relative">
                                            <input type="test" id="phone_number2" class="block_btn_30 modal_input" name="phone_number" value="" disabled>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="table_label">Order Status</label>
                                    <input type="text" name="order_status1" id="order_status" class="block_btn_30 modal_input_without_icon" value="" disabled>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <div id="new_actions" style="">
                     <span class="table_icon print_new" data-toggle="modal" data-target="#modal_print_order" data-form="modal_print_order" >
                                                <i class="icon-print"></i>
                                            </span>
                    <span class="table_icon call_mail_new"  data-toggle="modal" data-target="#modal_order_email">
                                                <i class="icon-email"></i>
                                            </span>
                    </div>
                    <a href="#" id="cancel_order" class="inline_block_btn light_gray_btn close reset_time vd_form_reset ok">Cancel</a>
                    {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Create order</button>--}}
                    <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Create Order</a>

                    <span class="required_mark_description">* Required field</span>
                    <span class="success_response"></span>
                    <span class="error_response"></span>
                </div>
            </form>
        </div>
    </div>
</div><!-- end Add Order Modal -->