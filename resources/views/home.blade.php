@extends('layouts.app')

@section('content')
    <div class="layout">
        <div class="container">
            <div id="orders_list">
                <section class="filter_status">
                    <div class="orders_list_wrapper">
                        <div class="filter_text">Filter by status:</div>
                        <div class="filter_buttons">
                                    <span class="filter_option blue">
                                        <i class="icon-company_status"></i><a href="{{url('/home')}}"> All ({{$counts['All']}}) </a>
                                    </span>
                            <span class="filter_option light_blue">
                                        <span class="status active blue" ></span><a href="{{url('filter-orderlist/Active')}}"> active ({{$counts['Active']}})</a>
                                    </span>
                            <span class="filter_option light_blue">
                                        <span class="status inactive"></span><a href="{{url('filter-orderlist/Pending')}}"> Pending ({{$counts['Pending']}}) </a>
                                    </span>
                            <span class="filter_option light_blue last">
                                        <span class="status waiting"></span><a href="{{url('filter-orderlist/Waiting')}}"> Waiting ({{$counts['Waiting']}}) </a>
                                    </span>
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
                    <div>
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                            <tr>
                                <td>
                                    Phone
                                </td>
                                <td>
                                    Sim Number
                                </td>
                                <td>
                                    Provider
                                </td>
                                <td>
                                    From
                                </td>
                                <td>
                                    To
                                </td>
                                <td>
                                    Dealer
                                </td>
                                <td>
                                    Updated By
                                </td>
                                <td>
                                    Reference Number
                                </td>
                                <td>
                                    Action
                                </td>
                                <td>
                                    Status
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ordersArray as $order)
                            <tr>
                                <td>
                                    @if($order['phone_id']==0)
                                        <a href="#">Get Number</a>
                                    @else
                                    {{$order['phone_id']}}
                                    @endif
                                </td>
                                <td>
                                    {{$order['sim_id']}}
                                </td>
                                <td>
                                    {{$order['provider']}}
                                </td>
                                <td>
                                    {{$order['from']}}
                                </td>
                                <td>
                                    {{$order['to']}}
                                </td>
                                <td>
                                    {{$order['created_by']}}
                                </td>
                                <td>
                                    {{$order['updated_by']}}
                                </td>
                                <td>
                                    {{$order['reference_number']}}
                                </td>
                                <td>
                                    Buttons
                                </td>
                                <td>
                                    {{$order['status']}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>




    <!-- Add User Modal -->
    <div class="modal fade" id="modal_new_order" tabindex="-1" role="dialog" aria-labelledby="modal_new_order">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>New Order</h3>
                    </div>
                </div>
                <div class="modal-body vdf_modal_body">
                    <form action="/" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left ovh">
                                <div class="form_row form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Enter a SIM number</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input_without_icon" value=""/>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">SIM provider</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input_without_icon" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_row form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Choose a SIM package </label>
                                        <div id="wrap_package_list" class="always_visible">
                                            <ul class="choose_package_list">
                                                <li>
                                                    <a href="#" title="Basic Package">
                                                        <h4>Basic Package</h4>
                                                        <span>8 Mb Data</span>
                                                        <span>Unlimited local</span>
                                                        <span>Call + SMS</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" title="Cruiser">
                                                        <h4>Cruiser</h4>
                                                        <span>8 Mb Data</span>
                                                        <span>Unlimited local</span>
                                                        <span>Call + SMS</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" title="De Luxe">
                                                        <h4>De Luxe</h4>
                                                        <span>8 Mb Data</span>
                                                        <span>Unlimited local</span>
                                                        <span>Call + SMS</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" title="Cruiser">
                                                        <h4>Cruiser</h4>
                                                        <span>8 Mb Data</span>
                                                        <span>Unlimited local</span>
                                                        <span>Call + SMS</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" title="De Luxe">
                                                        <h4>De Luxe</h4>
                                                        <span>8 Mb Data</span>
                                                        <span>Unlimited local</span>
                                                        <span>Call + SMS</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="form_row form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Enter remarks</label>
                                        <textarea class="modal_textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <label class="table_label">Destination flight details</label>
                                <div class="form_row form-group">

                                    <div class="col-md-6">
                                        <div class="form_row">
                                            <div class="departure"><i class="icon-landing"></i> Landing date and time</div>
                                            <div class="input-group date flight_dates" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </div>
                                                <input type="text" class="inline_block_btn" id="departure_date">
                                            </div>
                                        </div>
                                        <div class="form_row">
                                            <label class="table_label">Reference Number</label>
                                            <input type="text" class="block_btn_30 modal_input_without_icon" value="">
                                        </div>
                                        <div class="form_row">
                                            <label class="table_label">Customer phone number</label>
                                            <div class="select_wrapper">
                                                <select class="block_btn_30 modal_input">
                                                    <option value=""></option>
                                                    <option value="1">1111111111</option>
                                                    <option value="2">22222222222</option>
                                                    <option value="3">333333333333</option>
                                                </select>
                                                <i class="input_icon icon-sim"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form_row">
                                            <div class="departure"><i class="icon-departure"></i> Departure date and time</div>
                                            <div class="input-group date flight_dates" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </div>
                                                <input type="text" class="inline_block_btn" id="landing_date">
                                            </div>
                                        </div>
                                        <div class="form_row">
                                            <label class="table_label">Order Status</label>
                                            <input type="text" class="block_btn_30 modal_input_without_icon" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close" data-dismiss="modal" aria-label="Close">Cancel</a>
                    <button type="submit" href="#" class="inline_block_btn light_green_btn">Create User</button>
                </div>
            </div>
        </div>
    </div><!-- end Add User Modal -->

@endsection
