@extends('layouts.admin')

@section('content-admin')
    <div role="tabpanel" class="tab-pane fade" id="user_management">
        <div class="user_management_wrapper">
            <div class="search_management_option">
                <form action="/" class="search_form_option">
                    <input type="text" class="block_btn_30 search_input" value="search">
                    <button type="submit" class="search_button"><i class="icon-search"></i></button>
                </form>
                <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                @if (Auth::user()->type == 'admin')
                    <a href="#" class="add_new_user"><i class="icon-add_user"></i>Add new user</a>
                @endif
            </div>
            <div class="clear"></div>
        </div>

    </div>
    @endsection