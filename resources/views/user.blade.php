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


@endsection