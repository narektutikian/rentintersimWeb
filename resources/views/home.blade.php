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
                                <form action="{{url('/search/order')}}" method="get" class="search_form_option">
                                    <input type="text" class="block_btn_30 search_input" name="query" value="" placeholder="Search">
                                    {{csrf_field()}}
                                    <button type="submit" class="search_button"><i class="icon-search"></i></button>
                                </form>
                                <a href="{{url('/exportorders')}}" class="export_user"><i class="icon-export"></i>Export</a>
                                <a href="#" class="add_new_btn" data-toggle="modal" data-target="#modal_new_order"><i class="icon-new_order"></i>New Order</a>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>
                </section>
                <section class="section_table">
                    <!--rwd-table responsive_table table-->
                    <div class="row">
                        <div class="col-md-12">

                            <div id="wrap_orders_table">
                                <table class="rwd-table responsive_table table" data-toggle="table" data-page="order">
                                    <thead>
                                        <tr>
                                            {{--<th data-field="id">ID</th>--}}
                                            <th data-field="Phone" data-sortable="true">Phone</th>
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
                                        {{--<td>{{$order['id']}}</td>--}}
                                        <td class="rwd-td0 table_id_cell editable_cell" data-th="Phone" data-row-id="{{$order['id']}}"  data-cell-id="{{$order['id']}}">
                                            @if($order['phone_id']==0)
                                                <a id= "{{$order['id']}}" href="#" onClick = "getNumber({{$order['id']}});">Get Number</a>
                                            @else
                                            {{$order['phone_id']}}
                                            @endif
                                        </td>
                                        <td class="rwd-td1 editable_cell" data-th="SIM Number" data-row-id="{{$order['id']}}" data-form="#modal_view_order">
                                            <a href="#modal_view_order" role="button" class="link">
                                                {{$order['sim_id']}}
                                            </a>
                                        </td>
                                        <td class="rwd-td2 editable_cell align_order" data-th="Provider" data-row-id="{{$order['id']}}" data-target="#modal_view_order" data-form="#modal_view_order">
                                            <a href="#modal_view_order" role="button" class="link">
                                                {{$order['provider']}}
                                            </a>
                                        </td>
                                        <td class="rwd-td3 table_time_cell_large from align_order" data-field="From" data-th="From" data-row-id="{{$order['id']}}" data-target="#modal_view_order" data-form="#modal_view_order">
                                            <a href="#modal_view_order" role="button" class="link">
                                                {{$order['landing']}}
                                            </a>
                                        </td>
                                        <td class="rwd-td4 table_time_cell_large to align_order" data-field="To" data-th="To" data-toggle="modal" data-row-id="{{$order['id']}}" data-target="#modal_edit_order" data-form="#modal_edit_order">
                                            {{$order['departure']}}
                                        </td>
                                        <td class="rwd-td5 editable_cell align_order" data-field="Created by" data-th="Created by" data-row-id="{{$order['id']}}" data-target="#modal_view_order" data-form="#modal_view_order">
                                            <a href="#modal_view_order" role="button" class="link">
                                                {{$order['created_by']}}
                                            </a>
                                        </td>
                                        <td class="rwd-td6 {{ ($order['reference_number'] != '') ? 'ref_number' : '' }} align_order" data-content="{{$order['reference_number']}}" data-field="Reference Number" data-th="Reference Number">
                                            @if ($order['reference_number'] != '')
                                            <span class="hint_text">
                                                {{substr($order['reference_number'], 0, 9)}}
                                            </span>
                                            <span class="hint">i</span>
                                            @endif
                                        </td>
                                        <td class="rwd-td7 table_action_cell_large" data-field="Action" data-th="Action">
                                            <span class="table_icon call_edit {{ ($order['status'] == 'active') ? 'disable' : '' }}" data-toggle="modal" data-row-id="{{$order['id']}}" data-target="#modal_edit_order" data-form="#modal_edit_order">
                                                <i class="icon-edit"></i>
                                            </span>
                                            <span class="table_icon print" data-toggle="modal" data-target="#modal_print_order" data-form="modal_print_order">
                                                <i class="icon-print"></i>
                                            </span>
                                            <span class="table_icon call_mail"  data-toggle="modal" data-target="#modal_order_email" data-row-id="{{$order['id']}}">
                                                <i class="icon-email"></i>
                                            </span>
                                        </td>
                                        <td class="rwd-td8" data-field="Status" data-th="Status">
                                            <span class="table_status_text not_used">{{$order['status']}}</span>
                                        </td>
                                        <td class="rwd-td9 table_status_cell" data-th="Remove">
                                            <span class="remove_row {{ ($order['status'] == 'active') ? 'disable' : '' }}" data-toggle="modal" data-target="#confirm_delete" data-row-id="{{$order['id']}}">
                                                <i class="icon-delete"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                    {{$ordersArray->links()}}
                            </div><!--#wrap_orders_table-->
                        </div>
                    </div>
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
                                <label class="table_label">Destination flight details</label>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                        <div class="wrap_date">
                                            <div class="input-group date flight_dates" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </div>
                                                <input type="text" name="landing_date" id="landing_date" class="inline_block_btn landing_date vd_date_required" data-date-format="DD/MM/YYYY">
                                            </div>
                                            <div class="wrap_time">
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
                                            <div class="input-group date flight_dates" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </div>
                                                <input type="text" name="departure_date" id="departure_date" class="inline_block_btn departure_date vd_date_required" data-date-format="DD/MM/YYYY">
                                            </div>
                                            <div class="wrap_time">
                                                <i class="departure_time icon-time"></i>
                                                <input type="text" name="timepicker2" id="time_element2" class="inline_block_btn time_element vd_time_required"/>
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
                                            <select  name="phone_number" id="phone_number" class="block_btn_30 modal_input">
                                                <option value=""></option>
                                                @foreach($specials as $special)
                                                    <option value="{{$special['id']}}">{{$special['phone']}}</option>
                                                @endforeach
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
                                        <input type="text" name="sim-edit" id="sim-edit" class="block_btn_30 modal_input_without_icon vd_number sim-edit" data-th="SIM Number" value="" disabled/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">SIM provider</label>
                                        <input type="text" name="sim_prv2" class="block_btn_30 modal_input_without_icon vd_required" data-th="Provider" value="Vodafone" disabled/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="wrap_package_list_edit"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Enter remarks</label>
                                        <textarea name="rem_txt2" id="remark-edit" class="modal_textarea"></textarea>
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
                                            <input type="text" name="landing_date-edit" id="landing_date-edit"class="inline_block_btn landing_date vd_date_required" data-date-format="DD/MM/YYYY" disabled>
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker3" class="inline_block_btn time_element vd_time_required"/>
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
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date-edit" id="departure_date-edit"  class="inline_block_btn vd_date_required departure_date" data-date-format="DD/MM/YYYY" disabled>
                                        </div>
                                        <div class="wrap_time">
                                            <i class="departure_time icon-time"></i>
                                            <input type="text" name="timepicker4" class="inline_block_btn time_element vd_time_required"/>
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
                                        <span class="order_key">Created by: </span><span class="order_value" id="creator">Vallie Champlin 15/12/2016 12:40</span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="order_key">Updated by: </span><span class="order_value" id="editor">Alexanne Robel 07/03/2017 15:22</span>
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
                                        <label class="table_label">Enter a SIM number</label>
                                        <input type="text" name="sim-edit" id="sim-edit" class="block_btn_30 modal_input_without_icon vd_number" data-th="SIM Number" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">SIM provider</label>
                                        <input type="text" name="sim_prv2" class="block_btn_30 modal_input_without_icon vd_required" data-th="Provider" value="Vodafone" disabled/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="wrap_package_list_edit"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Enter remarks</label>
                                        <textarea name="rem_txt2" id="remark-edit" class="modal_textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <label class="table_label">Destination flight details</label>
                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>cvcvcv
                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>cvcv
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="landing_date-edit" id="landing_date-edit"class="inline_block_btn landing_date vd_required" data-date-format="DD/MM/YYYY">
                                        </div>
                                        <div class="wrap_time from">
                                            <i class="departure_time icon-time"></i>
                                            <div class="time_picker">
                                                <div  class="inline_block_btn numeric_input vdf_time vdf_hour" id="landing_hour-edit">0</div>
                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                            <div class="time_picker">
                                                <div class="inline_block_btn vdf_minute_picker vdf_time vdf_min" id="landing_minute-edit">0</div>
                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date-edit" id="departure_date-edit"  class="inline_block_btn vd_required departure_date" data-date-format="DD/MM/YYYY">
                                        </div>
                                        <div class="wrap_time to">
                                            <i class="departure_time icon-time"></i>
                                            <div class="time_picker">
                                                <div  class="inline_block_btn numeric_input vdf_time vdf_hour" id="departure_hour-edit">0</div>
                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                            <div class="time_picker">
                                                <div class="inline_block_btn vdf_minute_picker vdf_time vdf_min" id="departure_minute-edit">0</div>
                                                <span class="arrow-down"><i class="icon-arrow_down"></i></span>
                                                <span class="arrow-up"><i class="icon-arrow_up"></i></span>
                                            </div>
                                        </div>
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
                                                <select  name="phone_number" id="phone_number-edit" class="block_btn_30 modal_input">
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
                                        <span class="order_key">Created by: </span><span class="order_value" id="creator">Vallie Champlin 15/12/2016 12:40</span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="order_key">Updated by: </span><span class="order_value" id="editor">Alexanne Robel 07/03/2017 15:22</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Edit order</button>--}}
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="edit-order">Edit order</a>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end View Order Modal -->


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
                                    <form action="/" class="vd_form">
                                    <input type="text" name="email" id="email" class="block_btn_30 modal_input vd_email vd_required" value="" />
                                        </form>
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
                                            <input type="text" name="number" class="block_btn_30 modal_input vd_number phone" value="" disabled/>
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single_package">
                                            <label class="table_label">Selected Package </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Active Period</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure">From</div>
                                        <div class="email_date_time from"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"> To</div>
                                        <div class="email_date_time to"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Description</label>
                                        <textarea name="print_xtx_nnm" id="send_text" class="modal_textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <img src="/img/print_image.jpg" class="print_image" alt="print image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <span class="c_support">Customer support: +(972)-52-890-7711</span>
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="send-order">Send</a>

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
                                        <img  src="/img/print_image.jpg" class="print_image" alt="print image">
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
                                            {{--<h3>Dear Username,</h3>--}}
                                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}

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
