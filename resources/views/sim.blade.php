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
                        <span class="status active"></span> active ({{$counts['Active']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/pending')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-simlist/pending')}}">
                        <span class="status inactive"></span> Pending ({{$counts['Pending']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/available')) ? 'blue' : 'light_blue' }}" href="{{url('/filter-simlist/available')}}">
                        <span class="status available"></span> Available ({{$counts['Available']}})
                    </a>
                    <a class="filter_option  {{ (Request::is('filter-simlist/parking')) ? 'blue' : 'light_blue' }} last" href="{{url('/filter-simlist/parking')}}">
                        <span class="status disabled"></span> Parking ({{$counts['Parking']}})
                    </a>
                    <div class="search_management_option">
                        <form action="/" class="search_form_option">
                            <input type="text" class="block_btn_30 search_input" value="search">
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
                    <table class="rwd-table responsive_table table" data-toggle="table">
                        <thead>
                        <tr>
                            <th class="table_id_cell" data-field="id" data-sortable="true" data-th="Id">Id</th>
                            <th data-th="Sim Number">Sim Number</th>
                            <th data-field="provider" data-sortable="true" data-th="Provider">Provider</th>
                            <th>Action </th>
                            <th data-field="status" data-sortable="true" data-th="Status">Status </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($simsArray as $sim)
                        <tr>
                            <td class="rwd-td0 table_id_cell editable_cell {{ ((!$sim['is_active']) ? 'disable' : '') }}" data-toggle="modal" data-form="#modal_edit_sim" data-th="Id">{{$sim['id']}}</td>
                            <td class="rwd-td1 editable_cell {{ ((!$sim['is_active']) ? 'disable' : '') }}" data-toggle="modal" data-form="#modal_edit_sim" data-th="SIM Number">{{$sim['number']}}</td>
                            <td class="rwd-td2 editable_cell {{ ((!$sim['is_active']) ? 'disable' : '') }}" data-toggle="modal" data-form="#modal_edit_sim" data-th="Provider">{{$sim['provider_id']}}</td>
                            <td class="rwd-td3 table_action_cell {{ ((!$sim['is_active']) ? 'disable' : '') }}" data-th="Action">
                                <span class="table_icon edit" data-toggle="modal" data-target="#modal_edit_sim">
                                    <i class="icon-edit"></i>
                                </span>
                            </td>
                            <td class="rwd-td4 table_status_cell" data-th="Status">
                                <div class="vdf_radio">
                                    <div class="toggle_container {{ ((!$sim['is_active']) ? 'disabled' : '') }}">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                        </label>
                                    </div>
                                </div>
                                <span class="table_status_text not_used ">{{$sim['state']}}</span>

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
                    <div class="vdf_modal_sub_header">
                        <h3>Add SIM number</h3>
                    </div>
                </div>
                <div class="modal-body vdf_modal_body">
                    <form action="/" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form_row form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">SIM Number</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>

                                        <div class="special_number">
                                            <span class="table_icon"><i class="icon-parking_sim"></i></span>
                                            <span>Parking SIM</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Provider</label>
                                        <div class="form_row">
                                            <div class="select_wrapper">
                                                <select class="block_btn_30 modal_input">
                                                    <option value=""></option>
                                                    @foreach($providers as $provider)
                                                    <option value="{{$provider['id']}}">{{$provider['name']}}</option>
                                                        @endforeach
                                                </select>
                                                <i class="input_icon icon-sim"></i>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <span class="or">OR</span>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <div class="form_row form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Add from file</label>
                                        <div class="form_row">
                                            <span class="uploaded_files">
                                                <span class="keep_file_name"></span>
                                                <span class="file_container"> Browse
                                                    <input class="modal_image_name" type="file" />
                                                </span>
                                                <span class="uploaded_file_links"> File example
                                                    <a href="#" class="download_file disable" download=""><i class="icon-download"></i></a>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close" data-dismiss="modal" aria-label="Close">Cancel</a>
                    <input type="submit" class="inline_block_btn light_green_btn" value="Add SIM">
                </div>
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
                        <h3>Edit SIM number AAA</h3>
                    </div>
                </div>
                <div class="modal-body vdf_modal_body">
                    <form action="sim/" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form_row form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">SIM Number FFF</label>
                                        <div class="form_row">
                                            <input type="hidden" class="block_btn_30 modal_input" data-th="Id" value=""/>
                                            <input type="text" class="block_btn_30 modal_input" data-th="SIM Number" value=""/>
                                            <i class="input_icon icon-phone_number"></i>
                                        </div>

                                        <div class="special_number">
                                            <span class="table_icon"><i class="icon-parking_sim"></i></span>
                                            <span>Parking SIM</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Provider</label>
                                        <div class="form_row">
                                            <div class="select_wrapper">
                                                <select class="block_btn_30 modal_input"  data-th="Provider">
                                                    <option value=""></option>
                                                    @foreach($providers as $provider)
                                                        <option value="{{$provider['id']}}">{{$provider['name']}}</option>
                                                    @endforeach
                                                </select>

                                                <i class="input_icon icon-sim"></i>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <span class="or">OR</span>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <div class="form_row form-group">
                                    <div class="col-md-12">
                                        <label class="table_label">Add from file</label>
                                        <div class="form_row">
                                            <span class="uploaded_files">
                                                <span class="keep_file_name"></span>
                                                <span class="file_container"> Browse
                                                    <input class="modal_image_name" type="file" />
                                                </span>
                                                <span class="uploaded_file_links"> File example
                                                    <a href="#" class="download_file disable" download=""><i class="icon-download"></i></a>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close" data-dismiss="modal" aria-label="Close">Cancel</a>
                    <input type="submit" class="inline_block_btn light_green_btn" value="Edit SIM">
                </div>
            </div>
        </div>
    </div>
    <!-- end of Edit SIM Modal -->

@endsection