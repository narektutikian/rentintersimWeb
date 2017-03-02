<!-- View Order Modal -->
<div class="modal fade" id="modal_view_order" tabindex="-1" role="dialog" aria-labelledby="modal_view_order">
    <div class="modal-dialog vdf_modal" role="document">
        <div class="modal-content vdf_modal_content">
            <div class="modal-header vdf_modal_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="vdf_modal_sub_header">
                    <h3>View Order</h3>
                </div>
            </div>
            <form action="/" class="form-horizontal vd_form">
                <div class="modal-body vdf_modal_body">

                    <div class="form-group">
                        <div class="col-md-6 vdf_modal_left ovh">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="table_label">SIM number</label>
                                    <input type="text" name="sim-edit" class="block_btn_30 modal_input_without_icon vd_number sim-edit" data-th="SIM Number" value="" disabled/>
                                </div>
                                <div class="col-md-6">
                                    <label class="table_label">SIM provider</label>
                                    <input type="text" name="sim_prv2" class="block_btn_30 modal_input_without_icon vd_required" data-th="Provider" value="Vodafone" disabled/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="single_package email_print" id="wrap_package_list_view"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="table_label">Remarks</label>
                                    <textarea name="rem_txt2" class="modal_textarea remark-view" disabled></textarea>
                                </div>
                            </div>
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
                                            <input type="text" name="departure_date" class="inline_block_btn landing_date vd_date_required" id="landing_date_view" data-date-format="DD/MM/YYYY" disabled>
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker5" class="inline_block_btn time_element vd_time_required landing_time_val" disabled/>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="departure"><i class="icon-departure"></i> Departure date and time</div>

                                    <div class="wrap_date">
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text"  class="inline_block_btn departure_date vd_date_required" id="departure_date_view" data-date-format="DD/MM/YYYY" disabled>
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker6" class="inline_block_btn time_element vd_time_required departure_time_val" disabled/>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="table_label">Reference Number</label>
                                    <input type="text" id="reference_number-edit" class="block_btn_30 modal_input_without_icon reference_number-view" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="table_label">Customer phone number</label>
                                    <div class="relative">
                                        <input type="test" id="phone_number-view2" class="block_btn_30 modal_input" name="phone_number-edit2" value="" disabled>
                                        <i class="input_icon icon-sim"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="table_label">Order Status</label>
                                    <input type="text" name="order_status-edit" id="order_status-view" class="block_btn_30 modal_input_without_icon" value="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="order_key">Created by: </span><span class="order_value creator">Vallie Champlin 15/12/2016 12:40</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="order_key">Updated by: </span><span class="order_value editor" >Deleted User</span> <span class="edited_at"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Close</a>
                    {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Edit order</button>--}}
                    {{--<a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="edit-order">Edit order</a>--}}
                    <span class="success_response"></span>
                    <span class="error_response"></span>
                </div>
            </form>
        </div>
    </div>
</div><!-- end View Order Modal -->