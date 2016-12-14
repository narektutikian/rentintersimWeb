@extends('layouts.app')

@section('content')
    <div class="layout">
        <div class="container">
            <div id="orders_list" class="no-print">
                <section class="filter_status">
                    <div class="orders_list_wrapper">
                        <div class="filter_text">Filter by status:</div>
                        <div class="filter_buttons">
                            <a class="filter_option  {{ (Request::is('home')) ? 'blue' : 'light_blue' }}" href="{{url('/home')}}">
                                <i class="icon-company_status"></i>All ({{$counts['All']}})
                            </a>
                            <a class="filter_option  {{ (Request::is('filter-orderlist/active')) ? 'blue' : 'light_blue' }}" href="{{url('filter-orderlist/active')}}">
                                <span class="status active blue" ></span>active ({{$counts['active']}})
                            </a>
                            <a class="filter_option  {{ (Request::is('filter-orderlist/pending')) ? 'blue' : 'light_blue' }}" href="{{url('filter-orderlist/pending')}}">
                                <span class="status inactive"></span> pending ({{$counts['pending']}})
                            </a>
                            <a class="filter_option  {{ (Request::is('filter-orderlist/waiting')) ? 'blue' : 'light_blue' }} last" href="{{url('filter-orderlist/waiting')}}">
                                        <span class="status waiting"></span> waiting ({{$counts['waiting']}}) </a>
                                    </a>
                            <div class="search_management_option">
                                <form action="/" class="search_form_option">
                                    <input type="text" class="block_btn_30 search_input" value="search">
                                    <button type="submit" class="search_button"><i class="icon-search"></i></button>
                                </form>
                                <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                                <a href="#" class="add_new_btn" data-toggle="modal" data-target="#modal_new_order"><i class="icon-new_order"></i>New Order</a>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>
                </section>
                <section class="section_table">
                    <!--rwd-table responsive_table table-->
                    <table class="rwd-table responsive_table table" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="Phone">Phone</th>
                                <th data-field="SIM Number">SIM Number</th>
                                <th data-field="provider" data-sortable="true" data-th="Provider">Provider</th>
                                <th data-field="from" data-sortable="true" data-th="From">From</th>
                                <th data-field="to" data-sortable="true" data-th="To">To</th>
                                <th data-field="dealer" data-sortable="true" data-th="Dealer">Dealer </th>

                                <th data-th="Reference N">Reference #</th>
                                <th data-th="action">Action</th>
                                <th data-field="status" data-sortable="true" data-th="Status">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ordersArray as $order)
                        <tr>
                            <!--<td class="rwd-td0 table_id_cell editable_cell" data-form="#modal_edit_sim" data-th="Id">1</td>-->
                            <td class="rwd-td0 table_id_cell editable_cell" data-th="Phone">
                                @if($order['phone_id']==0)
                                    <a href="{{url('get-number/'.$order['id'])}}">Get Number</a>
                                @else
                                {{$order['phone_id']}}
                                @endif
                            </td>
                            <td class="rwd-td1 editable_cell" data-th="SIM Number">
                                {{$order['sim_id']}}
                            </td>
                            <td class="rwd-td2 editable_cell" data-th="Provider">
                                {{$order['provider']}}
                            </td>
                            <td class="rwd-td3 table_time_cell_large" data-field="From">
                                {{$order['from']}}
                            </td>
                            <td class="rwd-td4 table_time_cell_large" data-field="To">
                                {{$order['to']}}
                            </td>
                            <td class="rwd-td5" data-field="Created by">
                                {{$order['created_by']}}
                            </td>
                            <td class="rwd-td6 ref_number" data-content="{{$order['reference_number']}}" data-field="Reference Number">
                                <span class="hint">i</span>
                                <span class="hint_text">
                                    {{substr($order['reference_number'], 0, 9)}}
                                </span>

                            </td>
                            <td class="rwd-td7 table_action_cell table_action_cell_large" data-field="Action">
                                <span class="table_icon edit" data-toggle="modal" data-target="#modal_edit_order" data-form="#modal_edit_order">
                                    <i class="icon-edit"></i>
                                </span>
                                <span class="table_icon print" data-toggle="modal" data-target="#modal_print_order" data-form="modal_print_order">
                                    <i class="icon-print"></i>
                                </span>
                                <span class="table_icon"  data-toggle="modal" data-target="#modal_order_email">
                                    <i class="icon-email"></i>
                                </span>
                            </td>
                            <td class="rwd-td8" data-field="Status">
                                <span class="table_status_text not_used">{{$order['status']}}</span>
                            </td>
                            <td class="rwd-td9 table_status_cell">
                                <div class="vdf_radio">
                                    <div class="toggle_container {{ ((!$order['is_active']) ? 'disabled' : '') }}">
                                        <label class="label_unchecked">
                                            <input type="radio" name="toggle" value="1"><span></span>
                                        </label>
                                        <label class="label_checked">
                                            <input type="radio" name="toggle" value="0"><span></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$ordersArray->links()}}
                </section>
            </div>
        </div>
    </div>


    <!-- Add Order Modal -->
    <div class="modal fade" id="modal_new_order" tabindex="-1" role="dialog" aria-labelledby="modal_new_order">
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
                                        <label class="table_label">Enter a SIM number</label>
                                        <input type="text" name="sim1" id="sim" class="block_btn_30 modal_input_without_icon vd_number" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">SIM provider</label>
                                        <input type="text" name="sim_prv1" class="block_btn_30 modal_input_without_icon" value="Vodafone"/>
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
                                <label class="table_label">Destination flight details</label>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="landing_date" id="landing_date" class="inline_block_btn landing_date vd_required" data-date-format="DD/MM/YYYY">
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <div class="time_picker">
                                                <input type="text" name="landing_hour1" class="inline_block_btn numeric_input vdf_time vdf_hour">
                                                <span class="arrow-down"><i></i></span>
                                                <span class="arrow-up"><i></i></span>
                                            </div>
                                            <div class="time_picker">
                                                <input type="text" name="landing_hour2" class="inline_block_btn numeric_input vdf_time vdf_min">
                                                <span class="arrow-down"><i></i></span>
                                                <span class="arrow-up"><i></i></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date" id="departure_date" class="inline_block_btn departure_date vd_required" data-date-format="DD/MM/YYYY">
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <div class="time_picker">
                                                <input type="text" name="departure_hour1" class="inline_block_btn numeric_input vdf_time vdf_hour">
                                                <span class="arrow-down"><i></i></span>
                                                <span class="arrow-up"><i></i></span>
                                            </div>
                                            <div class="time_picker">
                                                <input type="text" name="departure_hour2" class="inline_block_btn numeric_input vdf_time vdf_min">
                                                <span class="arrow-down"><i></i></span>
                                                <span class="arrow-up"><i></i></span>

                                            </div>
                                        </div>

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
                                        <div class="select_wrapper">
                                            <select name="customer_phone1" class="block_btn_30 modal_input">
                                                <option value=""></option>
                                                <option value="1">1111111111</option>
                                                <option value="2">22222222222</option>
                                                <option value="3">333333333333</option>
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Order Status</label>
                                        <input type="text" name="order_status1" class="block_btn_30 modal_input_without_icon" value="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Create order</button>--}}
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Create Order</a>

                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end Add Order Modal -->

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
                                        <input type="text" name="sim2" id="sim2" class="block_btn_30 modal_input_without_icon vd_number" data-th="SIM Number" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">SIM provider</label>
                                        <input type="text" name="sim_prv2" class="block_btn_30 modal_input_without_icon vd_required" data-th="Provider" value="Vodafone"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="wrap_package_list_edit"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="single_package">
                                            <label class="table_label">Selected Package </label>
                                            <a class="selected_package" title="Basic Package">
                                                <h4>Basic Package</h4>
                                                <span>8 Mb Data Unlimited local Call + SMS</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Enter remarks</label>
                                        <textarea name="rem_txt2" id="remark2" class="modal_textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <label class="table_label">Destination flight details</label>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date2" class="inline_block_btn departure_date vd_required" data-date-format="DD/MM/YYYY HH:mm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="landing_date2" class="inline_block_btn vd_required landing_date" data-date-format="DD/MM/YYYY HH:mm">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Reference Number</label>
                                        <input type="text" id="reference_number" class="block_btn_30 modal_input_without_icon vd_number" value="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Customer phone number</label>
                                        <div class="select_wrapper">
                                            <select name="customer_phone1" class="block_btn_30 modal_input">
                                                <option value=""></option>
                                                <option value="1">1111111111</option>
                                                <option value="2">22222222222</option>
                                                <option value="3">333333333333</option>
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Order Status</label>
                                        <input type="text" name="order_status1" class="block_btn_30 modal_input_without_icon" value="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Edit order</button>--}}
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Edit order</a>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end dit Order Modal -->


    <!--Email Modal-->
    <div class="modal fade" id="modal_order_email" tabindex="-1" role="dialog" aria-labelledby="modal_order_email">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <div class="col-md-7">
                            <h3>Mail message: Order <span class="mail_order">#124875</span></h3>
                        </div>
                        <div class="col-md-5">
                            <div class="point_to">
                                <span class="point_to_text">To</span>
                                <div class="relative point_to_input">
                                    <input type="text" name="type_name4" class="block_btn_30 modal_input vd_number" value=""/>
                                    <i class="input_icon icon-special"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <label class="table_label">Phone Number </label>
                                        <div class="relative">
                                            <input type="text" name="type_name4" class="block_btn_30 modal_input vd_number" value=""/>
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single_package">
                                            <label class="table_label">Selected Package </label>
                                            <a class="selected_package" title="Basic Package">
                                                <h4>Basic Package</h4>
                                                <span>8 Mb Data Unlimited local Call + SMS</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Active Period</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure">From</div>
                                        <div class="email_date_time">13/12/2016 17:05</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"> To</div>
                                        <div class="email_date_time">14/01/2017 10:20</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Description</label>
                                        <textarea name="print_xtx_nnm"  class="modal_textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <img src="img/print_image.jpg" class="print_image" alt="print image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <span class="c_support">Customer support: +373 95 728 147</span>
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit">Send</a>

                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end of Email Modal-->


    <!--Print Modal-->
    <div class="modal fade" id="modal_print_order" tabindex="-1" role="dialog" aria-labelledby="modal_print_order">
        <div class="modal-dialog vdf_email_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header modal_print_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="form-group">
                        <div class="col-md-12">
                            <h3>Mail message: Order <span class="mail_order">#124875</span></h3>
                        </div>
                    </div>
                </div>

                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <img src="img/print_image.jpg" class="print_image" alt="print image">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="form-group">

                                    <div class="email_phone_num">Phone Number : 044 758 34 22</div>

                                    <div class="clear"></div>
                                </div>
                                <div class="form-group">
                                    <div class="email_print">
                                        <div class="single_package email_print">
                                            <label class="table_label">Selected Package </label>
                                            <a class="selected_package" title="Basic Package">
                                                <h4>Basic Package</h4>
                                                <span>8 Mb Data Unlimited local Call + SMS</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="email_message">
                                            <h3>Dear Username,</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Active Period</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure">From : <div class="email_date_time">13/12/2016 17:05</div></div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"> To : <div class="email_date_time">14/01/2017 10:20</div></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <span class="c_support">Customer support: +373 95 728 147</span>

                        <span class="email_send_print no-print">
                            <i class="icon-print"></i>
                        </span>
                    </div>

            </div>
        </div>
    </div>
    <!--end Print Modal-->

@endsection
