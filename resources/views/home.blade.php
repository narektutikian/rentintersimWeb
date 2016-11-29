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
                                        <i class="icon-company_status"></i><a href="{{url('/home')}}"> All (7) </a>
                                    </span>
                            <span class="filter_option light_blue">
                                        <span class="status active"></span><a href="{{url('filter-orderlist/Active')}}"> active (2)</a>
                                    </span>
                            <span class="filter_option light_blue">
                                        <span class="status inactive"></span><a href="{{url('filter-orderlist/Pending')}}"> Pending (3) </a>
                                    </span>
                            <span class="filter_option light_blue last">
                                        <span class="status waiting"></span><a href="{{url('filter-orderlist/Waiting')}}"> Waiting (2) </a>
                                    </span>
                            <div class="search_management_option">
                                <form action="/" class="search_form_option">
                                    <input type="text" class="block_btn_30 search_input" value="search">
                                    <button type="submit" class="search_button"><i class="icon-search"></i></button>
                                </form>
                                <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                                <a href="{{url('/order/create')}}" class="add_new_user"><i class="icon-new_order"></i>New Order</a>
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
@endsection
