@extends('layouts.admin')
<style>
    .status_text_small{
        width: 70px;
    }
    .w25{
        width: 25px;
        text-align: center;
    }
    .w73{
        width: 73px;
        text-align: center;
    }
    .w180{
        width: 180px;
    }
    .nested_table{
        border: 1px solid red !important;
    }
</style>
@section('dashboard')

        <section class="filter_status">
            <div class="orders_list_wrapper">
                <div class="filter_buttons">
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
        <section class="section_table">
            <div class="row">
                <div class="col-md-12">
                    <table class="responsive_table table user_management_table" data-toggle="table">
                        <thead>
                        <tr>
                            <th class="w25"></th>
                            <th>Name</th>
                            <th class="w180">Username</th>
                            <th class="w110left">Level</th>
                            <th class="w65">Active</th>
                            <th class="w73">Pending</th>
                            <th class="w65">Waiting</th>
                            <th class="w65">Action</th>
                            <th class="w_160_status">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td>Michael Davidson(admin)</td>
                            <td>MikaDav</td>
                            <td>Distributor</td>
                            <td>15</td>
                            <td>24</td>
                            <td>0</td>
                            <td>
                                <span class="table_icon"><i class="icon-edit"></i></span>
                            </td>
                            <td>
                                <div class="vdf_radio">
                                    <div class="toggle_container disabled">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                        </label>
                                    </div>
                                </div>
                                <span class="status_text_small not_used">Not in use</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="open_nested" data-toggle="collapse" data-target="#demo1"><i class="icon-dropdown"></i></a>
                            </td>
                            <td>
                                Benjamin Whitehead(admin)
                            </td>
                            <td>Benji1234</td>
                            <td>Distributor</td>
                            <td>16</td>
                            <td>7</td>
                            <td>1</td>
                            <td>
                                <span class="table_icon"><i class="icon-edit"></i></span>
                            </td>
                            <td class="w_160_status" data-th="Status">
                                <div class="vdf_radio">
                                    <div class="toggle_container disabled">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                        </label>
                                    </div>
                                </div>
                                <span class="status_text_small not_used">Not in use</span>
                            </td>
                        </tr>
                        <tr class="nested_row">
                            <td></td>
                            <td colspan="8" class="nested_cell">
                                <div class="collapse nested_div" id="demo1">
                                    <table class="table table-striped nested_table">
                                        <thead></thead>
                                        <tbody>
                                        <tr>
                                            <td  class="w25"></td>
                                            <td>Edward Morison(employee)</td>
                                            <td class="w180">EdwardEdward</td>
                                            <td class="w110left">Dealer</td>
                                            <td class="w65">3</td>
                                            <td class="w73">0</td>
                                            <td class="w65">0</td>
                                            <td class="w65">
                                                <span class="table_icon"><i class="icon-edit"></i></span>
                                            </td>
                                            <td class="status_cell w_160_status" data-th="Status">
                                                <span class="status_text_small not_used">Active</span>
                                                <div class="vdf_radio">
                                                    <div class="toggle_container">
                                                        <label>
                                                            <input type="radio" name="toggle" value="1"><span></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="#" class="open_nested" data-toggle="collapse" data-target="#demo2"><i class="icon-dropdown"></i></a></td>
                                            <td>Edward Morison(employee)</td>
                                            <td class="w180">EdwardEdward</td>
                                            <td class="w110left">Dealer</td>
                                            <td class="w65">3</td>
                                            <td class="w73">0</td>
                                            <td class="w65">0</td>
                                            <td class="w65">
                                                <span class="table_icon"><i class="icon-edit"></i></span>
                                            </td>
                                            <td class="status_cell w_160_status" data-th="Status">
                                                <span class="status_text_small not_used">Active</span>
                                                <div class="vdf_radio">
                                                    <div class="toggle_container">
                                                        <label>
                                                            <input type="radio" name="toggle" value="1"><span></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="nested_row">
                                            <td style="padding: 0 !important;"></td>
                                            <td colspan="8" class="nested_cell">
                                                <div class="collapse nested_div" id="demo2">
                                                    <table class="table table-striped nested_table">
                                                        <thead></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="w25">
                                                                <a href="#" class="open_nested" data-toggle="collapse" data-target="#demo3"><i class="icon-dropdown"></i></a>
                                                            </td>
                                                            <td>Level 3 - 1</td>
                                                            <td class="w180">EdwardEdward</td>
                                                            <td class="w110left">Dealer</td>
                                                            <td class="w65">3</td>
                                                            <td class="w73">0</td>
                                                            <td class="w65">0</td>
                                                            <td class="w65">
                                                                <span class="table_icon"><i class="icon-edit"></i></span>
                                                            </td>
                                                            <td class="status_cell w_160_status" data-th="Status">
                                                                <span class="status_text_small not_used">Active</span>
                                                                <div class="vdf_radio">
                                                                    <div class="toggle_container">
                                                                        <label>
                                                                            <input type="radio" name="toggle" value="1"><span></span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="nested_row">
                                                            <td style="padding: 0 !important;"></td>
                                                            <td colspan="8" class="nested_cell">
                                                                <div class="collapse nested_div" id="demo3">
                                                                    <table class="table table-striped nested_table">
                                                                        <thead></thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>Level 3 - 1 - 1</td>
                                                                            <td class="w180">EdwardEdward</td>
                                                                            <td class="w110left">Dealer</td>
                                                                            <td class="w65">3</td>
                                                                            <td class="w73">0</td>
                                                                            <td class="w65">0</td>
                                                                            <td class="w65">
                                                                                <span class="table_icon"><i class="icon-edit"></i></span>
                                                                            </td>
                                                                            <td class="status_cell w_160_status" data-th="Status">
                                                                                <span class="status_text_small not_used">Active</span>
                                                                                <div class="vdf_radio">
                                                                                    <div class="toggle_container">
                                                                                        <label>
                                                                                            <input type="radio" name="toggle" value="1"><span></span>
                                                                                        </label>
                                                                                        <label>
                                                                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>Level 3 - 2</td>
                                                            <td class="w180">EdwardEdward</td>
                                                            <td class="w110left">Dealer</td>
                                                            <td class="w65">3</td>
                                                            <td class="w73">0</td>
                                                            <td class="w65">0</td>
                                                            <td class="w65">
                                                                <span class="table_icon"><i class="icon-edit"></i></span>
                                                            </td>
                                                            <td class="status_cell w_160_status" data-th="Status">
                                                                <span class="status_text_small not_used">Active</span>
                                                                <div class="vdf_radio">
                                                                    <div class="toggle_container">
                                                                        <label>
                                                                            <input type="radio" name="toggle" value="1"><span></span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <a href="#" class="open_nested" data-toggle="collapse" data-target="#demo4"><i class="icon-dropdown"></i></a>
                            </td>
                            <td>Michael Davidson(admin) 2</td>
                            <td>MikaDav</td>
                            <td>Distributor</td>
                            <td>15</td>
                            <td>24</td>
                            <td>0</td>
                            <td>
                                <span class="table_icon"><i class="icon-edit"></i></span>
                            </td>
                            <td>
                                <div class="vdf_radio">
                                    <div class="toggle_container">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                        </label>
                                    </div>
                                </div>
                                <span class="status_text_small not_used">Not in use</span>
                            </td>
                        </tr>
                        <tr class="nested_row">
                            <td></td>
                            <td colspan="8" class="nested_cell">
                                <div class="collapse nested_div" id="demo4">
                                    <table class="table table-striped nested_table">
                                        <thead></thead>
                                        <tbody>
                                        <tr>
                                            <td  class="w25"></td>
                                            <td>Level 4 - 1</td>
                                            <td class="w180">4444444</td>
                                            <td class="w110left">Dealer</td>
                                            <td class="w65">3</td>
                                            <td class="w73">0</td>
                                            <td class="w65">0</td>
                                            <td class="w65">
                                                <span class="table_icon"><i class="icon-edit"></i></span>
                                            </td>
                                            <td class="status_cell w_160_status" data-th="Status">
                                                <span class="status_text_small not_used">Active</span>
                                                <div class="vdf_radio">
                                                    <div class="toggle_container">
                                                        <label>
                                                            <input type="radio" name="toggle" value="1"><span></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="toggle" value="0"><span class="input-checked"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>


        <br>
            <div class="row">
                <div class="col-md-12">
                <div id="wrap_tree_table">

                </div>
            </div>
        </div>
        </section>


@endsection