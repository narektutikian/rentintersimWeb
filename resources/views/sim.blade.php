@extends('layouts.admin')

@section('dashboard')

    <div id="sim_management">
        <section class="filter_status">
            <div class="sim_management_wrapper">
                <div class="filter_text">Filter by status:</div>
                <div class="filter_buttons">
                    <a class="filter_option  {{ (Request::is('sim')) ? 'blue' : 'light_blue' }}" href="{{url('/sim')}}">
                        <i class="icon-company_status"></i> All ({{$counts['All']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/active')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-simlist/active')}}">
                        <span class="status active"></span> active ({{$counts['active']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/pending')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-simlist/pending')}}">
                        <span class="status inactive"></span> pending ({{$counts['pending']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/available')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-simlist/available')}}">
                        <span class="status available"></span> Available ({{$counts['Available']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/parking')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-simlist/parking')}}">
                        <span class="status disabled"></span> Parking ({{$counts['Parking']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/deleted')) ? 'blue' : 'light_blue' }} last" href="{{url('/filter-simlist/deleted')}}">
                        <span class="status available"></span> <span class="show-deleted"><i class="icon-delete"></i></span>
                    </a>
                    <div class="search_management_option">
                        <form action="{{url('search/sim')}}" class="search_form_option vd_form">
                            <input type="text" class="block_btn_30 search_input" placeholder="Search" name="query" value="">
                            {{csrf_field()}}
                            <button type="submit" class="search_button"><i class="icon-search"></i></button>
                        </form>
                        <a href="{{url('/exportsims')}}" class="export_user"><i class="icon-export"></i>Export</a>
                        <a href="#" class="add_new_btn" data-toggle="modal" data-target="#modal_add_sim"><i class="icon-add_number"></i>Add SIM</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <section class="section_table">
            <div class="row">
                <div class="col-md-12">
                    <table class="rwd-table responsive_table table" data-toggle="table" data-page="sim">
                        <thead>
                            <tr>
                                <th class="table_id_cell" data-field="id" data-sortable="true">Id</th>
                                <th data-th="Sim Number">Sim Number</th>
                                <th data-field="provider" data-sortable="true" data-th="Provider">Provider</th>
                                <th>Action </th>
                                <th data-field="status" data-sortable="true" data-th="Status">Status </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($simsArray as $sim)
                        <tr>
                            <td class="rwd-td0 table_id_cell editable_cell" data-th="Id">{{$sim['id']}}</td>
                            <td class="rwd-td1 editable_cell" data-th="SIM Number">{{$sim['number']}}</td>
                            <td class="rwd-td2 editable_cell" data-th="Provider">{{$sim['provider_id']}}</td>
                            <td class="rwd-td3 table_action_cell" data-th="Action">
                                <span class="table_icon edit {{ (!$sim['editable'] || Request::is('filter-simlist/deleted')) ? 'disable' : '' }}" data-toggle="modal" data-target="#modal_edit_sim" data-form="#modal_edit_sim">
                                    <i class="icon-edit"></i>
                                </span>
                            </td>
                            <td class="rwd-td4 editable_cell status_td" data-th="Status">
                                <span class="table_status_text not_used ">{{$sim['state']}}</span>
                            </td>
                            <td class="rwd-td5 table_status_cell" data-th="Remove">
                                @if (!Request::is('filter-simlist/deleted'))
                                <span class="remove_row {{ ($sim['editable']) ? '' : 'disable' }}" data-toggle="modal" data-target="#confirm_delete" data-row-id="{{$sim['id']}}">
                                    <i class="icon-delete"></i>
                                </span>
                                    @elseif(Request::is('filter-simlist/deleted'))
                                    <span class="recover_row {{ ($sim['editable']) ? '' : 'disable' }}" data-toggle="modal" data-target="#confirm_recover" data-row-id="{{$sim['id']}}">
                                    <i class="icon-delete"></i>
                                </span>
                                    @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$simsArray->links()}}
                </div>
            </div>
        </section>

    </div><!--end of SIM management-->

    <!-- Add SIM Modal -->
    <div class="modal fade" id="modal_add_sim" tabindex="-1" role="dialog" aria-labelledby="modal_add_sim">

        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header vdf_two_titles">
                        <h3>Add SIM number</h3>
                        <h3>Add from file</h3>
                    </div>
                </div>
                <form action="sim/" class="form-horizontal vd_form" id="insert-sim" enctype='multipart/form-data'>
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">SIM Number <span class="required_mark">*</span></label>
                                        <div class="relative">
                                            <input type="text" name="some_sim_edit" id="sim-number" class="block_btn_30 modal_input vd_number" value=""/>
                                            {{csrf_field()}}
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Provider <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="sim_select" id="provider-id" class="block_btn_30 modal_input vd_select">
                                                <option value=""></option>
                                                @foreach($providers as $provider)
                                                <option value="{{$provider['id']}}">{{$provider['name']}}</option>
                                                    @endforeach
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 special_number">
                                        <label class="vdf_checkbox">
                                            <input type="checkbox" id="is-parking" name="num_chkb" value="" />
                                            <i class="icon-parking_sim"></i>
                                        </label>
                                        <span class="vdf_checkbox_text">Parking SIM</span>
                                    </div>
                                </div>
                                <span class="or">OR</span>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Add from file</label>
                                        <span class="uploaded_files">
                                            <span class="keep_file_name"></span>
                                            <span class="file_container"> Browse
                                                <input class="modal_image_name" type="file" name="sim-file" id="sim-file" accept=".xls,.xlsx"/>
                                            </span>
                                            <span class="uploaded_file_links"> File example
                                                <a href="/storage/Sim.xlsx" class="download_file" download=""><i class="icon-download"></i></a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        {{--<input type="submit" class="inline_block_btn light_green_btn vd_form_submit" id="add-sim" value="Add SIM">--}}
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="add-sim">Add SIM</a>

                        <span class="required_mark_description">* Required field</span>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end of Add SIM Modal -->

    <!-- Edit SIM Modal -->
    <div class="modal fade" id="modal_edit_sim" tabindex="-1" role="dialog" aria-labelledby="modal_edit_sim">

        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>Edit SIM number</h3>
                    </div>
                </div>
                <form action="sim/" id="sim-edit" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">

                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">SIM Number <span class="required_mark">*</span></label>
                                        <div class="relative">
                                            <input type="hidden" name="some_sim_edit_id" class="block_btn_30 modal_input" data-th="Id" id="id" value=""/>
                                            <input type="text" name="some_sim_edit2" class="block_btn_30 modal_input vd_number vd_number" id="number" data-th="SIM Number" value=""/>
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Provider <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="sim_select" class="block_btn_30 modal_input vd_select" id="provider_id" data-th="Provider">
                                                <option value=""></option>
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider['id']}}">{{$provider['name']}}</option>
                                                @endforeach
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 special_number">
                                        <label class="vdf_checkbox">
                                            <input type="checkbox" id="is_parking-edit" name="num_chkb" data-th="Status" value="" />
                                            <i class="icon-parking_sim"></i>
                                        </label>
                                        <span class="vdf_checkbox_text">Parking SIM</span>
                                    </div>
                                </div>
                                {{--<span class="or">OR</span>--}}
                            </div>
                            {{--<div class="col-md-6 vdf_modal_right">--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<label class="table_label">Add from file</label>--}}

                                        {{--<span class="uploaded_files">--}}
                                            {{--<span class="keep_file_name"></span>--}}
                                            {{--<span class="file_container"> Browse--}}
                                                {{--<input class="modal_image_name" type="file" />--}}
                                            {{--</span>--}}
                                            {{--<span class="uploaded_file_links"> File example--}}
                                                {{--<a href="#" class="download_file disable" download=""><i class="icon-download"></i></a>--}}
                                            {{--</span>--}}
                                        {{--</span>--}}

                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        </div>

                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                    {{--<input type="submit" class="inline_block_btn light_green_btn vd_form_submit" id="edit-sim" value="Edit SIM">--}}
                    <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="edit-sim">Update SIM</a>

                    <span class="required_mark_description">* Required field</span>
                    <span class="success_response"></span>
                    <span class="error_response"></span>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of Edit SIM Modal -->

@endsection