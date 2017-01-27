@extends('layouts.admin')

@section('dashboard')
    <div id="number_management">
        <section class="filter_status">
            <div class="number_management_wrapper">
                <div class="filter_text">Filter by status:</div>
                <div class="filter_buttons">
                    <a class="filter_option {{ (Request::is('number')) ? 'blue' : 'light_blue' }} " href="{{url('/number')}}">
                        <i class="icon-company_status"></i> All ({{$counts['All']}})
                    </a>
                    <a class="filter_option {{ (Request::is('filter-numberlist/active')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-numberlist/active')}}">
                        <span class="status active"></span> active ({{$counts['active']}})
                    </a>
                        <a class="filter_option {{ (Request::is('filter-numberlist/pending')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-numberlist/pending')}}">
                        <span class="status inactive"></span> pending ({{$counts['pending']}})
                    </a>
                    <a class="filter_option {{ (Request::is('filter-numberlist/not in use')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-numberlist/not in use')}}">
                        <span class="status disabled"></span> not in use ({{$counts['not in use']}})
                    </a>
                    <a class="filter_option {{ (Request::is('filter-numberlist/special')) ? 'blue' : 'light_blue' }} last" href="{{url('/filter-numberlist/special')}}">
                        <span class="status done"></span> Special ({{$counts['specials']}})
                    </a>
                    <div class="search_management_option">
                        <form action="{{url('search/number')}}" class="search_form_option">
                            <input type="text" class="block_btn_30 search_input" name="query" placeholder="Search" value="">
                            <button type="submit" class="search_button"><i class="icon-search"></i></button>
                        </form>
                        <a href="{{url('/exportnumber')}}" class="export_user"><i class="icon-export"></i>Export</a>
                        <a href="#" class="add_new_btn" data-toggle="modal" data-target="#modal_add_number"><i class="icon-add_number"></i>Add number</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <section class="section_table">
            <div class="row">
                <div class="col-md-12">
                    <table class="rwd-table responsive_table table" data-toggle="table" data-page="number">
                        <thead>
                            <tr>
                                <th class="table_id_cell" data-field="id" data-sortable="true">Id</th>
                                <th data-field="phone number" data-sortable="true">Phone Number</th>
                                <th>SIM Number</th>
                                <th data-field="provider" data-sortable="true">Provider </th>
                                <th data-field="type" data-sortable="true">Type</th>
                                <th>Action </th>
                                <th data-field="status" data-sortable="true">Status </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($phonesArray as $number)
                            <tr>
                                <td class="rwd-td0 table_id_cell editable_cell" data-th="Id">{{$number['id']}}</td>
                                <td class="rwd-td1 editable_cell" data-th="Phone Number">{{$number['phone']}}</td>
                                    <td class="rwd-td2 editable_cell {{ ($number['state'] == 'not in use') ? 'disable' : '' }}" data-th="SIM Number">{{$number['current_sim_id']}} </td>
                                <td class="rwd-td3 editable_cell" data-th="Provider">{{$number['provider_id']}}</td>
                                <td class="rwd-td4 editable_cell" data-th="Type">{{$number['package_id']}}</td>
                                <td class="rwd-td5 table_action_cell" data-th="Action" data-row-id="{{$number['id']}}">
                                    <span class="table_icon edit number_edit {{ ($number['state'] != 'not in use') ? 'disable' : '' }}" data-toggle="modal" data-target="#modal_edit_number" data-form="#modal_edit_number">
                                        <i class="icon-edit"></i>
                                    </span>

                                    <label class="vdf_checkbox disable">
                                        <input type="checkbox" name="num_chkb{{$number['id']}}" value="" {{ ($number['is_special'] == 1) ? 'checked' : '' }}/>
                                        <i class="icon-special"></i>
                                    </label>
                                </td>
                                <td class="rwd-td6 " data-th="Status">
                                    <span class="table_status_text not_used ">{{$number['state']}}</span>
                                </td>
                                <td class="rwd-td7 table_status_cell" data-th="Remove">
                                    @if (!Request::is('filter-numberlist/deleted'))
                                    <span class="remove_row {{ ($number['state'] != 'not in use') ? 'disable' : '' }}" data-toggle="modal" data-target="#confirm_delete" data-row-id="{{$number['id']}}">
                                        <i class="icon-delete"></i>
                                    </span>
                                    @elseif(Request::is('filter-numberlist/deleted'))
                                        <span class="recover_row {{ ($number['state'] != 'not in use') ? 'disable' : '' }}" data-toggle="modal" data-target="#confirm_recover" data-row-id="{{$number['id']}}">
                                        <i class="icon-delete"></i>
                                    </span>
                                    @endif
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    {{$phonesArray->links()}}
                </div>
            </div>
        </section>
    </div><!--#number_management-->



    <!-- Add Number Modal -->
    <div class="modal fade" id="modal_add_number" tabindex="-1" role="dialog" aria-labelledby="modal_add_number">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header vdf_two_titles">
                        <h3>Add number</h3>
                        <h3>Add from file</h3>
                    </div>
                </div>
                <form method="post" action="{{url('/number')}}" id="add-number-form" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">

                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Phone Number <span class="required_mark">*</span></label>
                                        <div class="relative">
                                            <input type="text" name="phone_number" id="number" class="block_btn_30 modal_input vd_number" value=""/>
                                            {{csrf_field()}}
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Parking SIM number <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="prk_sim_num" id="sim_id" class="block_btn_30 modal_input vd_select">
                                                <option value=""></option>
                                                @foreach($sims as $sim)
                                                <option value="{{$sim->id}}">{{$sim->number}}</option>
                                                @endforeach
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Provider <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="some_prov_num" id="provider_id" class="block_btn_30 modal_input vd_select">
                                                <option value=""></option>
                                                <option value="1">Vodafone</option>
                                            </select>
                                            <i class="input_icon icon-provider"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Type <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="prk_sim_num2" id="package_id" class="block_btn_30 modal_input vd_select">
                                                <option value=""></option>
                                                @foreach($packages as $package)
                                                    <option value="{{$package['id']}}">{{$package['name']}}</option>
                                                @endforeach
                                            </select>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="special_number">
                                            <label class="vdf_checkbox">
                                                <input type="checkbox" id="is_special" value="b" />
                                                <i class="icon-special"></i>
                                            </label>
                                            <span class="vdf_checkbox_text">Special number</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="or">OR</span>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <div class="form_row form-group">
                                    <div class="col-md-12">
                                        <label class="table_label moved_label">Add from file</label>
                                        <span class="uploaded_files">
                                            <span class="keep_file_name"></span>
                                            <span class="file_container"> Browse
                                                <input class="modal_image_name" name="number-file" id="number-file" type="file" />
                                            </span>
                                        </span>
                                        <span class="uploaded_file_links"> File example
                                            <a href="{{url('/storage/number.xlsx')}}" class="download_file" download=""><i class="icon-download"></i></a>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="add-number">Add Number</a>

                        <span class="required_mark_description">* Required field</span>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end Add User Modal -->


    <!-- Edit Number Modal -->
    <div class="modal fade" id="modal_edit_number" tabindex="-1" role="dialog" aria-labelledby="modal_edit_number">

        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>Edit number</h3>
                    </div>
                </div>
                <form action="/" id="edit-number-form" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Phone Number <span class="required_mark">*</span></label>
                                        <div class="relative">
                                            <input type="hidden" name="some_numb_edit_id" data-th="Id" id="id" value=""/>
                                            <input type="text" name="phone" id="number-edit" class="block_btn_30 modal_input vd_number" data-th="Phone Number" value=""/>
                                            {{csrf_field()}}
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Parking SIM number</label>
                                        <div class="select_wrapper">
                                            <select name="initial_sim_id"  id="sim_id-edit" class="block_btn_30 modal_input" data-th="SIM Number">
                                                <option value=""></option>
                                                @foreach($sims as $sim)
                                                <option value="{{$sim->id}}">{{$sim->number}}</option>
                                                @endforeach
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Provider <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="provider_id" id="provider_id-edit" class="block_btn_30 modal_input vd_select" data-th="Provider">
                                                <option value=""></option>
                                                <option value="1">Vodafone</option>

                                            </select>
                                            <i class="input_icon icon-provider"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Type <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="package_id" class="block_btn_30 modal_input vd_select" id="package_id-edit" data-th="Type">
                                                <option value=""></option>
                                                @foreach($packages as $package)
                                                    <option value="{{$package['id']}}">{{$package['name']}}</option>
                                                @endforeach
                                            </select>
                                            <i class="input_icon icon-provider"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="special_number">
                                            <label class="vdf_checkbox">
                                                <input type="checkbox" id="is_special-edit" value="b" />
                                                <i class="icon-special"></i>
                                            </label>
                                            <span class="vdf_checkbox_text">Special number</span>
                                        </div>
                                    </div>
                                </div>
                                {{--<span class="or">OR</span>--}}
                            </div>
                            {{--<div class="col-md-6 vdf_modal_right">--}}
                                {{--<div class="form_row form-group">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<label class="table_label">Add from file</label>--}}
                                        {{--<div class="form_row">--}}
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

                            {{--</div>--}}
                        </div>

                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="edit-number">Update Number</a>

                        <span class="required_mark_description">* Required field</span>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of Edit Number Modal -->

@endsection