@extends('layouts.app')

@section('content')
    <script>
        var auth_level = "{{Auth::user()->level}}";
        //        console.log(auth_level);
    </script>
    <div class="layout">
        <div class="container">
            <div id="orders_list" class="no-print">

                <section class="section_table">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="wrap_orders_table">
                                <section class="filter_status" id="toolbar">
                                    <div class="orders_list_wrapper">
                                        <div class="filter_text">Filter by status:</div>
                                        <div class="filter_buttons">
                                            <a class="filter_option filter_all light_blue blue" onclick="filter('')">
                                                <i class="icon-company_status"></i>All ({{$counts['All']}})
                                            </a>
                                            <a class="filter_option filter_active light_blue"
                                               onclick="filter('active')">
                                                <span class="status active blue"></span>active ({{$counts['active']}})
                                            </a>
                                            <a class="filter_option filter_pending light_blue"
                                               onclick="filter('pending')">
                                                <span class="status inactive"></span> pending ({{$counts['pending']}})
                                            </a>
                                            <a class="filter_option filter_waiting light_blue"
                                               onclick="filter('waiting')">
                                                <span class="status waiting"></span> waiting ({{$counts['waiting']}})
                                            </a>
                                            </a>
                                            <a class="filter_option filter_done light_blue" onclick="filter('done')">
                                                <span class="status done"></span> done ({{$counts['done']}}) </a>
                                            </a>
                                            <div class="search_management_option">
                                                <div class="search_form_option">
                                                    <div class="pull-right search">
                                                        <input type="text" style="display: inline-block"
                                                               class="block_btn_30 search_input" name="" value=""
                                                               placeholder="Search">
                                                    </div>
                                                    {{csrf_field()}}
                                                    <button type="button" class="search_button"><i
                                                                class="icon-search"></i></button>
                                                </div>
                                                <a href="{{url('/exportorders')}}" class="export_user"><i
                                                            class="icon-export"></i>Export</a>
                                                <a href="#" class="add_new_btn" data-toggle="modal"
                                                   data-target="#modal_new_order"><i class="icon-new_order"></i>New
                                                    Order</a>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </section>

                                <table id="order_table_html" class="rwd-table responsive_table table"
                                       data-toggle="table"
                                       data-url="/api/order"
                                       data-pagination="true"
                                       data-side-pagination="server"
                                       data-page-list="[15, 30, 60, 100]"
                                       data-unique-id="id"
                                       data-page-size="15"
                                       data-pagination-h-align="left"
                                       data-pagination-detail-h-align="right"
                                       data-search="true"
                                       data-toolbar="#toolbar"
                                       data-toolbar-align="left"

                                       data-page="order">
                                    <thead>
                                    <tr>
                                        <th data-field="phone.phone" data-formatter="formatNumber" data-halign="center"
                                            data-align="left" data-sortable="true">Phone
                                        </th>
                                        <th data-field="sim.number" data-halign="center" data-align="left"
                                            data-sortable="true">SIM number
                                        </th>
                                        <th data-field="sim.provider.name" data-halign="center" data-align="center"
                                            data-sortable="true">Provider
                                        </th>
                                        <th data-field="landing" data-halign="center" data-align="center"
                                            data-sortable="true">From
                                        </th>
                                        <th data-field="departure" data-halign="center" data-align="center"
                                            data-sortable="true">To
                                        </th>
                                        <th data-field="creator.login" data-halign="center" data-align="center"
                                            data-sortable="true">Dealer
                                        </th>
                                        <th data-field="reference_number" data-halign="center" data-align="center"
                                            data-formatter="formatReference">Reference #
                                        </th>
                                        <th data-field="" data-formatter="formatActions" data-events="operateEvent">
                                            Action
                                        </th>
                                        <th data-field="status" data-halign="center" data-align="center"
                                            data-sortable="true">Status
                                        </th>
                                        <th data-field="" data-formatter="formatDelete"></th>

                                    </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    @include('ordermodal.add')
    @include('ordermodal.edit')
    @include('ordermodal.view')


    <!--Email Modal-->
    <div class="modal fade" id="modal_order_email" tabindex="-1" role="dialog" aria-labelledby="modal_order_email">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close close_print" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <div class="col-md-7">
                            <h3>Mail message: Order <span class="mail_order">error</span></h3>
                        </div>
                        <div class="col-md-5">
                            <div class="point_to">
                                <span class="point_to_text">To</span>
                                <div class="relative point_to_input">
                                    <form action="/" class="vd_form">
                                        <input type="text" name="email" id="email"
                                               class="block_btn_30 modal_input vd_email vd_required" value=""/>
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
                                            <input type="text" name="number"
                                                   class="block_btn_30 modal_input vd_number phone" value="" disabled/>
                                            <input id="refresh" type="hidden" name="refresh" value="not-refresh">
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
                                        <img src="/img/print_image.png" class="print_image" alt="print image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <span class="c_support">Customer service: +44 2031501573 Ext. 1</span>
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset close_print"
                           data-dismiss="modal" aria-label="Close">Cancel</a>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>Order <span class="mail_order">#</span></h3>
                    </div>
                </div>

                <div class="modal-body vdf_modal_body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{--<div class="col-md-12">--}}
                                {{--<img  src="/img/print_image.jpg" class="print_image" alt="print image">--}}
                                {{--</div>--}}
                                <div class="clear"></div>
                            </div>
                            <div class="form-group">

                                <div class="email_phone_num"></div>
                                <div class="email_sim_num"></div>

                                <div class="clear"></div>
                            </div>
                            <div class="form-group">
                                <div class="email_print">
                                    <div class="single_package email_print selected_package_print">

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
                                    <div class="departure">From :
                                        <div class="email_date_time from_print"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="departure"> To :
                                        <div class="email_date_time to_print"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <span class="c_support">Customer service: +44 2031501573 Ext. 1</span>

                    <span class="email_send_print no-print">
                        <i class="icon-print"></i>
                    </span>
                </div>

            </div>
        </div>
    </div>
    <!--end Print Modal-->


    <!--New Mail Modal 1-->
    <!--end of New Mail Modal 1-->


@endsection
