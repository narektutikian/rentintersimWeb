@extends('layouts.admin')

@section('dashboard')

    <div id="user_management">
        <section class="filter_status">
            <div class="user_management_wrapper">
                <div class="filter_buttons">
                    <div class="search_management_option">
                        <form action="/" class="search_form_option">
                            <input type="text" class="block_btn_30 search_input" value="search">
                            <button type="submit" class="search_button"><i class="icon-search"></i></button>
                        </form>
                        <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                        <a href="#" class="add_new_btn" data-toggle="modal" data-target="#modal_add_user"><i class="icon-new_order"></i>New User</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <section class="section_table">
            <div class="row">
                <div class="col-md-12">
                    <div id="wrap_tree_table"></div>
                </div>
            </div>
        </section>
    </div><!---#user_management-->


    <!--Add Use Modal -->
    <div class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="modal_add_user">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>New User</h3>
                    </div>
                </div>
                <div class="modal-body vdf_modal_body">
                    <form action="/" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form_row form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Name</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                        <label class="table_label">Type</label>
                                        <div class="form_row">
                                            <div class="select_wrapper">
                                                <select class="block_btn_30 modal_input">
                                                    <option value=""></option>
                                                    <option value="Admin">type 1</option>
                                                    <option value="Dealer">type 2</option>
                                                    <option value="Sub-Dealer">type 3</option>
                                                </select>
                                                <i class="input_icon icon-username"></i>
                                            </div>

                                        </div>
                                        <label class="table_label">Primary Email</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-email"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Level</label>
                                        <div class="form_row">
                                            <div class="select_wrapper">
                                                <select class="block_btn_30 modal_input">
                                                    <option value=""></option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Dealer">Dealer</option>
                                                    <option value="Sub-Dealer">SubDealer</option>
                                                </select>
                                                <i class="input_icon icon-level"></i>
                                            </div>

                                        </div>
                                        <label class="table_label">Parent Username</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                        <label class="table_label">Secondary Email</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-email"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <div class="form_row form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Username</label>
                                        <div class="form_row">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Password</label>
                                        <div class="form_row">
                                            <input type="password" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-password"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                    <a href="#" class="inline_block_btn light_green_btn vd_form_submit">Create User</a>

                    <span class="success_response"></span>
                    <span class="error_response"></span>
                </div>
            </div>
        </div>
    </div><!-- end Add User Modal -->

    <!--Edit User Modal -->
    <div class="modal fade" id="modal_edit_user" tabindex="-1" role="dialog" aria-labelledby="modal_edit_user">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <h3>New User</h3>
                    </div>
                </div>
                <div class="modal-body vdf_modal_body">
                    <form action="/" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 vdf_modal_left">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Name</label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input" data-th="Name" value=""/>
                                            <i class="input_icon icon-username"></i>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Level</label>
                                        <div class="select_wrapper">
                                            <select class="block_btn_30 modal_input" data-th="Level">
                                                <option value=""></option>
                                                <option value="Admin">Admin</option>
                                                <option value="Dealer">Dealer</option>
                                                <option value="Sub-Dealer">SubDealer</option>
                                            </select>
                                            <i class="input_icon icon-level"></i>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">

                                        <label class="table_label">Type</label>
                                        <div class="select_wrapper">
                                            <select class="block_btn_30 modal_input" data-th="Type">
                                                <option value=""></option>
                                                <option value="Admin">type 1</option>
                                                <option value="Dealer">type 2</option>
                                                <option value="Sub-Dealer">type 3</option>
                                            </select>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Parent Username</label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">

                                        <label class="table_label">Primary Email</label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input" value="" data-th="Primary Email"/>
                                            <i class="input_icon icon-email"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <label class="table_label">Secondary Email</label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-email"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 vdf_modal_right">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="table_label">Username</label>
                                        <div class="relative">
                                            <input type="text" class="block_btn_30 modal_input" data-th="Username" value=""/>
                                            <i class="input_icon icon-username"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="table_label">Password</label>
                                        <div class="relative">
                                            <input type="password" class="block_btn_30 modal_input" value=""/>
                                            <i class="input_icon icon-password"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer vdf_modal_footer">
                    <a href="#" class="inline_block_btn light_gray_btn close vd_form_reset" data-dismiss="modal" aria-label="Close">Cancel</a>
                    <a href="#" class="inline_block_btn light_green_btn vd_form_submit">Edit User</a>

                    <span class="success_response"></span>
                    <span class="error_response"></span>
                </div>
            </div>
        </div>
    </div><!-- end Add User Modal -->

@endsection