@extends('layouts.admin')

@section('dashboard')

    <div id="type_management">
        <section class="filter_status">
            <div class="type_management_wrapper">
                <div class="filter_text">Filter by status:</div>
                <div class="filter_buttons">
                    <a class="filter_option light_blue  blue">
                        <i class="icon-company_status"></i> All ({{$counts['All']}})
                    </a>
                    {{--<a class="filter_option {{ (Request::is('filter-packagelist/Enable')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-packagelist/Enable')}}">--}}
                        {{--<span class="status active"></span> enable ({{$counts['Enable']}})--}}
                    {{--</a>--}}
                    {{--<a class="filter_option {{ (Request::is('filter-packagelist/Disable')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-packagelist/Disable')}}">--}}
                        {{--<span class="status disabled"></span> disable ({{$counts['Disable']}})--}}
                    {{--</a>--}}
                    <div class="search_management_option">
                        <div class="search_form_option">
                            <div class="pull-right search">
                                <input type="text" style="display: inline-block" class="block_btn_30 search_input " name="query" placeholder="Search" value="{{ (isset($_GET['query'])) ? $_GET['query'] : '' }}">
                            </div>
                            <button type="button" class="search_button"><i class="icon-search"></i></button>
                        </div>
                        <a href="{{url('/exporttypes')}}" class="export_user"><i class="icon-export"></i>Export</a>
                        <a href="#" class="add_new_btn" data-toggle="modal" data-target="#modal_add_new_type"><i class="icon-add_number"></i>Add new type</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <section class="section_table">
            <div class="row">
                <div class="col-md-12">
                    <table id="type_table"  class="rwd-table responsive_table table"
                           data-toggle="table"
                           data-pagination="true"
                           data-side-pagination="server"
                           data-page-list="[15, 30, 60, 100]"
                           data-unique-id="id"
                           data-page-size="15"
                           data-pagination-h-align="left"
                           data-pagination-detail-h-align="right"
                           data-search="true"
                           data-toolbar=".filter_status"
                           data-toolbar-align="left"
                           data-page="type">
                    </table>
                </div>
            </div>
        </section>

    </div><!--end of Type management-->

    <!-- Add new type Modal -->
    <div class="modal fade" id="modal_add_new_type" tabindex="-1" role="dialog" aria-labelledby="modal_add_new_type">

        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header vdf_two_titles">
                        <h3>Add new type number</h3>
                        <h3>Add from file</h3>
                    </div>
                </div>
                <form action="{{url('type')}}" method="post" id="insert-type" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Type Name <span class="required_mark">*</span></label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input vd_required" id="name" name="name" value=""/>
                                            <i class="input_icon icon-add_type"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Provider <span class="required_mark">*</span></label>

                                        <div class="select_wrapper">
                                            <select name="provider_id" class="block_btn_30 modal_input vd_select" id="provider_id" >
                                                <option value=""></option>
                                                <option value="1">Vodafone</option>
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Type Code </label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input" id="type_code" name="type_code" value=""/>
                                            <i class="input_icon icon-type"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Description <span class="required_mark">*</span></label>
                                        <textarea class="modal_textarea vd_required" id="description" name="description"></textarea>
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
                                                <input class="modal_image_name" id="type-file" name="type-file" type="file" />
                                            </span>
                                            <span class="uploaded_file_links"> File example
                                                <a href="{{url('/storage/type.xlsx')}}" class="download_file" download=""><i class="icon-download"></i></a>
                                            </span>
                                        </span>

                                    </div>
                                </div>

                            </div>
                            {{--<button type="submit">Submit</button>--}}
                        </div>

                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#"  class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" id="add-type" class="inline_block_btn light_green_btn vd_form_submit">Create New Type</a>

                        <span class="required_mark_description">* Required field</span>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
                <div id="ajaxResponse">

                </div>
            </div>
        </div>
    </div>
    <!-- end of Add new type Modal -->

    <!-- Edit new type Modal -->
    <div class="modal fade" id="modal_edit_new_type" tabindex="-1" role="dialog" aria-labelledby="modal_edit_new_type">

        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>Edit type</h3>
                    </div>
                </div>
                <form action="{{url('type')}}" id="type-edit-form" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">

                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Type Name <span class="required_mark">*</span></label>
                                        <div class="relative">
                                        <input type="hidden" name="some_type_edit_id" data-th="Id" id="id-edit" value=""/>
                                            <input type="text" name="name" id="name-edit" class="block_btn_30 modal_input vd_required" data-th="Type Name" value=""/>
                                            {{csrf_field()}}
                                            <i class="input_icon icon-add_type"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Provider <span class="required_mark">*</span></label>
                                        <div class="select_wrapper">
                                            <select name="provider_id" id="provider_id-edit" class="block_btn_30 modal_input vd_select" data-th="Provider">
                                                <option value=""></option>
                                                <option value="1">Vodafone</option>
                                            </select>
                                            <i class="input_icon icon-sim"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Type Code </label>
                                        <div class="relative">
                                            <input type="text" name="type_code" id="type_code-edit" class="block_btn_30 modal_input" data-th="Type Code" value=""/>
                                            <i class="input_icon icon-type"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Description <span class="required_mark">*</span></label>
                                        <textarea class="modal_textarea vd_required" id="description-edit" data-th="Description"></textarea>
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
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="type-edit">Update type</a>

                        <span class="required_mark_description">* Required field</span>
                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of Edit new type Modal -->


@endsection