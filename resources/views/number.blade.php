@extends('layouts.admin')

@section('dashboard')
    <div id="number_management">
        <section class="filter_status">
            <div class="number_management_wrapper">
                <div class="filter_text">Filter by status:</div>
                <div class="filter_buttons">
                    <a class="filter_option blue">
                        <i class="icon-company_status"></i> All (7)
                    </a>
                    <a class="filter_option light_blue">
                        <span class="status active"></span> active (2)
                    </a>
                    <a class="filter_option light_blue">
                        <span class="status inactive"></span> inactive (1)
                    </a>
                    <a class="filter_option light_blue last">
                        <span class="status disabled"></span> not in use (4)
                    </a>
                    <div class="search_management_option">
                        <form action="/" class="search_form_option">
                            <input type="text" class="block_btn_30 search_input" value="search">
                            <button type="submit" class="search_button"><i class="icon-search"></i></button>
                        </form>
                        <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                        <a href="#" class="add_new_user" data-toggle="modal" data-target="#modal_add_number"><i class="icon-add_number"></i>Add number</a>
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
                            <th data-field="phone number" data-sortable="true" data-th="Phone Number">Phone Number</th>
                            <th>SIM Number</th>
                            <th data-field="provider" data-sortable="true" data-th="Provider">Provider </th>
                            <th data-field="type" data-sortable="true" data-th="Type">Type</th>
                            <th>Action </th>
                            <th class="w_160_status" data-field="status" data-sortable="true" data-th="Status">Status </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="rwd-td0 table_id_cell" data-toggle="modal" data-target="#modal_edit_number" data-th="Id">1</td>
                            <td class="rwd-td1" data-toggle="modal" data-target="#modal_edit_number" data-th="Phone Number">052 8388422</td>
                            <td class="rwd-td2" data-toggle="modal" data-target="#modal_edit_number" data-th="SIM Number">5457100145122458729</td>
                            <td class="rwd-td3" data-toggle="modal" data-target="#modal_edit_number" data-th="Provider">Vodafone</td>
                            <td class="rwd-td4" data-toggle="modal" data-target="#modal_edit_number" data-th="Type">Package name 1</td>
                            <td class="rwd-td5 table_action_cell" data-th="Action">
                                <span class="table_icon"><i class="icon-edit"></i></span>
                                <span class="table_icon"><i class="icon-special"></i></span>
                            </td>
                            <td class="rwd-td6 w_160_status" data-th="Status">
                                <span class="table_status_text not_used">Not in use</span>
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
                            </td>
                        </tr>
                        <tr>
                            <td class="rwd-td0 table_id_cell" data-toggle="modal" data-target="#modal_edit_number" data-th="Id">2</td>
                            <td class="rwd-td1" data-toggle="modal" data-target="#modal_edit_number" data-th="Phone Number">093 5381482</td>
                            <td class="rwd-td2" data-toggle="modal" data-target="#modal_edit_number" data-th="SIM Number">2457100145212458721</td>
                            <td class="rwd-td3" data-toggle="modal" data-target="#modal_edit_number" data-th="Provider">Vodafone</td>
                            <td class="rwd-td4" data-toggle="modal" data-target="#modal_edit_number" data-th="Type">Package name 2</td>
                            <td class="rwd-td5 table_action_cell" data-th="Action">
                                <span class="table_icon"><i class="icon-edit"></i></span>
                                <span class="table_icon"><i class="icon-special"></i></span>
                            </td>
                            <td class="rwd-td6 w_160_status" data-th="Status">
                                <span class="table_status_text not_used">Not in use</span>
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
                            </td>
                        </tr>
                        <tr>
                            <td class="rwd-td0 table_id_cell" data-toggle="modal" data-target="#modal_edit_number" data-th="Id">3</td>
                            <td class="rwd-td1" data-toggle="modal" data-target="#modal_edit_number" data-th="Phone Number">093 1281473</td>
                            <td class="rwd-td2" data-toggle="modal" data-target="#modal_edit_number" data-th="SIM Number">0124571001452124588</td>
                            <td class="rwd-td3" data-toggle="modal" data-target="#modal_edit_number" data-th="Provider">Vodafone</td>
                            <td class="rwd-td4" data-toggle="modal" data-target="#modal_edit_number" data-th="Type">Package name 3</td>
                            <td class="rwd-td5 table_action_cell" data-th="Action">
                                <span class="table_icon"><i class="icon-edit"></i></span>
                                <span class="table_icon active"><i class="icon-special"></i></span>
                            </td>
                            <td class="rwd-td6 w_160_status" data-th="Status">
                                <span class="table_status_text active">Active</span>
                                <div class="vdf_radio">
                                    <div class="toggle_container">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span class="input-checked"></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="rwd-td0 table_id_cell" data-toggle="modal" data-target="#modal_edit_number" data-th="Id">4</td>
                            <td class="rwd-td1" data-toggle="modal" data-target="#modal_edit_number" data-th="Phone Number">093 1281473</td>
                            <td class="rwd-td2" data-toggle="modal" data-target="#modal_edit_number" data-th="SIM Number">0124571001452124588</td>
                            <td class="rwd-td3" data-toggle="modal" data-target="#modal_edit_number" data-th="Provider">Vodafone</td>
                            <td class="rwd-td4" data-toggle="modal" data-target="#modal_edit_number" data-th="Type">Package name 3</td>
                            <td class="rwd-td5 table_action_cell" data-th="Action">
                                <span class="table_icon"><i class="icon-edit"></i></span>
                                <span class="table_icon"><i class="icon-special"></i></span>
                            </td>
                            <td class="rwd-td6 w_160_status" data-th="Status">
                                <span class="table_status_text pending">Pending</span>
                                <div class="vdf_radio">
                                    <div class="toggle_container">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span class="input-checked"></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="rwd-td0 table_id_cell" data-toggle="modal" data-target="#modal_edit_number" data-th="Id">5</td>
                            <td class="rwd-td1" data-toggle="modal" data-target="#modal_edit_number" data-th="Phone Number">093 1281473</td>
                            <td class="rwd-td2" data-toggle="modal" data-target="#modal_edit_number" data-th="SIM Number">0124571001452124588</td>
                            <td class="rwd-td3" data-th="Provider">Vodafone</td>
                            <td class="rwd-td4" data-toggle="modal" data-target="#modal_edit_number" data-th="Type">Package name 3</td>
                            <td class="rwd-td5 table_action_cell" data-th="Action">
                                <span class="table_icon"><i class="icon-edit"></i></span>
                                <span class="table_icon"><i class="icon-special"></i></span>
                            </td>
                            <td class="rwd-td6 w_160_status" data-th="Status">
                                <span class="table_status_text pending">Pending</span>
                                <div class="vdf_radio">
                                    <div class="toggle_container">
                                        <label>
                                            <input type="radio" name="toggle" value="1"><span class="input-checked"></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="toggle" value="0"><span></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div><!--#number_management-->

@endsection