@extends('layouts.app')

@section('content')
    <div class="layout">
        <div class="container">
            <div id="orders_list">
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
                                <th data-th="Phone">Phone</th>
                                <th data-th="SIM Number">SIM Number</th>
                                <th data-field="provider" data-sortable="true" data-th="Provider">Provider</th>
                                <th data-field="from" data-sortable="true" data-th="From">From</th>
                                <th data-field="to" data-sortable="true" data-th="To">To</th>
                                <th data-field="dealer" data-sortable="true" data-th="Dealer">Dealer </th>
                                <th data-field="updated by" data-sortable="true" data-th="Updated by">Updated by</th>
                                <th data-th="Reference N">Reference #</th>
                                <th data-th="action">Action</th>
                                <th data-field="status" data-sortable="true" data-th="Status">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ordersArray as $order)
                        <tr>
                            <!--<td class="rwd-td0 table_id_cell editable_cell" data-form="#modal_edit_sim" data-th="Id">1</td>-->
                            <td class="rwd-td0 table_id_cell editable_cell">
                                @if($order['phone_id']==0)
                                    <a href="{{url('get-number/'.$order['id'])}}">Get Number</a>
                                @else
                                {{$order['phone_id']}}
                                @endif
                            </td>
                            <td class="rwd-td1">
                                {{$order['sim_id']}}
                            </td>
                            <td class="rwd-td2">
                                {{$order['provider']}}
                            </td>
                            <td class="rwd-td3">
                                {{$order['from']}}
                            </td>
                            <td class="rwd-td4">
                                {{$order['to']}}
                            </td>
                            <td class="rwd-td5">
                                {{$order['created_by']}}
                            </td>
                            <td class="rwd-td6">
                                {{$order['updated_by']}}
                            </td>
                            <td>
                                {{$order['reference_number']}}
                            </td>
                            <td class="rwd-td7 table_action_cell_large ">
                                <span class="table_icon" data-toggle="modal" data-target="#modal_edit_order">
                                    <i class="icon-edit"></i>
                                </span>
                                <span class="table_icon" data-toggle="modal" data-target="#modal_order_print">
                                    <i class="icon-print"></i>
                                </span>
                                <label class="vdf_checkbox">
                                    <input type="checkbox" name="num_chkb_ol" value="" />
                                    <i class="icon-special"></i>
                                </label>
                            </td>
                            <td class="rwd-td8 table_id_cell table_status_cell">
                                {{$order['status']}}
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
                                        <input type="text" name="sim_prv1" class="block_btn_30 modal_input_without_icon" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Choose a SIM package </label>
                                        <div class="wrap_package_list" class="always_visible"></div>
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
                                            <input type="text" name="landing_date" class="inline_block_btn vd_required" id="landing_date" data-date-format="DD/MM/YYYY HH:mm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" name="departure_date" class="inline_block_btn vd_required" id="departure_date" data-date-format="DD/MM/YYYY HH:mm">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Reference Number</label>
                                        <input type="text" id="reference_number" class="block_btn_30 modal_input_without_icon vd_number" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Order Status</label>
                                        <input type="text" name="order_status1" class="block_btn_30 modal_input_without_icon" value="">
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
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Create order</button>
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
                                        <input type="text" name="sim2" id="sim2" class="block_btn_30 modal_input_without_icon vd_number" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">SIM provider</label>
                                        <input type="text" name="sim_prv2" class="block_btn_30 modal_input_without_icon vd_required" value="Vodafone"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Choose a SIM package </label>
                                        <div class="wrap_package_list" class="always_visible"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Enter remarks</label>
                                        <textarea name="rem_txt2" id="remark" class="modal_textarea"></textarea>
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
                                    <div class="col-md-6">
                                        <label class="table_label">Reference Number</label>
                                        <input type="text" id="reference_number" class="block_btn_30 modal_input_without_icon vd_number" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Order Status</label>
                                        <input type="text" name="order_status1" class="block_btn_30 modal_input_without_icon" value="">
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
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Edit order</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end dit Order Modal -->


    <!--Print Modal-->
    <div class="modal fade" id="modal_order_print" tabindex="-1" role="dialog" aria-labelledby="modal_order_print">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>Mail message: Order <span class="mail_order">#124875</span></h3>
                        div.point_
                        <div class="relative">
                            <input type="text" name="type_name4" class="block_btn_30 modal_input vd_number" value=""/>
                            <i class="input_icon icon-special"></i>
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
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" class="inline_block_btn departure_date vd_required" name="some_departure_1" data-date-format="DD/MM/YYYY HH:mm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="departure"> To</div>
                                        <div class="input-group date flight_dates" data-provide="datepicker">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                            <input type="text" class="inline_block_btn landing_date vd_required" name="some_departure_2" data-date-format="DD/MM/YYYY HH:mm">
                                        </div>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end of Print Modal-->

@endsection
