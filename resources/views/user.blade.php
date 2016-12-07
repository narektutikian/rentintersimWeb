@extends('layouts.admin')

@section('dashboard')
    <div id="orders_list">
        <section class="filter_status">
            <div class="orders_list_wrapper">
                <div class="filter_text">Filter by status:</div>
                <div class="filter_buttons">
                    <span class="filter_option blue">
                        <i class="icon-company_status"></i> All (7)
                    </span>
                    <span class="filter_option light_blue">
                        <span class="status active"></span> active (2)
                    </span>
                    <span class="filter_option light_blue">
                        <span class="status inactive"></span> pending (3)
                    </span>
                    <span class="filter_option light_blue last">
                        <span class="status waiting"></span> waiting (2)
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
@endsection