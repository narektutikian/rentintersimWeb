@extends('layouts.app')

@section('content')
    <div class="layout">
        <div class="container">
            <nav class="tab_nav">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#dashboard" aria-controls="home" role="tab" data-toggle="tab">Dashboard</a></li>
                    <li role="presentation"><a href="#user_management" aria-controls="profile" role="tab" data-toggle="tab">User Management</a></li>
                    <li role="presentation"><a href="#number_management" aria-controls="messages" role="tab" data-toggle="tab">Number Management</a></li>
                    <li role="presentation"><a href="#sim_management" aria-controls="settings" role="tab" data-toggle="tab">SIM Management</a></li>
                    <li class="dropdown" role="presentation">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu sub_menu">
                            <li><a href="#type_management" data-toggle="tab">Type management</a></li>
                            <li><a href="#tab_d2" data-toggle="tab">Submenu 1-2</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="dashboard">
                    <section class="distributors">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 align_first">
                                <div class="distributor_item">
                                    <div class="distributor_icon">
                                        <i class="icon-distributor"></i>
                                    </div>
                                    <div class="distributor_item_options">
                                        <span class="number">5</span>
                                        <span class="role">Distributors</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="distributor_item">
                                    <div class="distributor_icon">
                                        <i class="icon-distributor"></i>
                                    </div>
                                    <div class="distributor_item_options">
                                        <span class="number">14</span>
                                        <span class="role">Dealers</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 align_last">
                                <div class="distributor_item">
                                    <div class="distributor_icon">
                                        <i class="icon-distributor"></i>
                                    </div>

                                    <div class="distributor_item_options">
                                        <span class="number">6</span>
                                        <span class="role">SubDealers</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>
                    <section class="dashboard_charts">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="total_numbers">
                                    <h2 class="total_numbers_title">Total phone numbers</h2>
                                    <div class="phone_charts">
                                        <div id="chart_active"  class="pie-title-center" data-percent="28">
                                            <span class="pie-value"></span>
                                        </div>
                                        <span class="phone_chart_status">Active</span>
                                    </div>
                                    <div class="phone_charts middle">
                                        <div id="chart_pending"  class="pie-title-center" data-percent="15">
                                            <span class="pie-value"></span>
                                        </div>
                                        <span class="phone_chart_status">Pending</span>
                                    </div>
                                    <div class="phone_charts">
                                        <div id="chart_not_used"  class="pie-title-center" data-percent="14">
                                            <span class="pie-value"></span>
                                        </div>
                                        <span class="phone_chart_status">Not in use</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="average_numbers">
                                    <h2 class="total_numbers_title">Average time(monthly in percent)</h2>
                                    <div class="wrap_average">
                                        <div class="average_value">
                                            <span class="value"></span>
                                            <span class="av_status">Inactive</span>
                                        </div>
                                        <div class="phone_charts">
                                            <div id="chart_average"  class="pie-title-center" data-percent="45">
                                                <span class="pie-value"></span>
                                            </div>
                                        </div>
                                        <div class="remainder_value">
                                            <span class="value"></span>
                                            <span class="av_status">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <div role="tabpanel" class="tab-pane fade" id="user_management">
                    <div class="user_management_wrapper">
                        <div class="search_management_option">
                            <form action="/" class="search_form_option">
                                <input type="text" class="block_btn_30 search_input" value="search">
                                <button type="submit" class="search_button"><i class="icon-search"></i></button>
                            </form>
                            <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                            <a href="#" class="add_new_user"><i class="icon-add_user"></i>Add new user</a>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>

                <div role="tabpanel" class="tab-pane fade" id="number_management">

                    <section class="filter_status">
                        <div class="number_management_wrapper">
                            <div class="filter_text">Filter by status:</div>
                            <div class="filter_buttons">
                                    <span class="filter_option blue">
                                        <i class="icon-company_status"></i> All (7)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status active"></span> active (2)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status inactive"></span> inactive (1)
                                    </span>
                                <span class="filter_option light_blue last">
                                        <span class="status disabled"></span> not in use (4)
                                    </span>

                                <div class="search_management_option">
                                    <form action="/" class="search_form_option">
                                        <input type="text" class="block_btn_30 search_input" value="search">
                                        <button type="submit" class="search_button"><i class="icon-search"></i></button>
                                    </form>
                                    <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                                    <a href="#" class="add_new_user"><i class="icon-add_number"></i>Add number</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </section>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="sim_management">

                    <section class="filter_status">
                        <div class="sim_management_wrapper">
                            <div class="filter_text">Filter by status:</div>
                            <div class="filter_buttons">
                                    <span class="filter_option blue full">
                                        <i class="icon-company_status"></i> All (7)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status active"></span> active (2)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status inactive"></span> Pending (1)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status available"></span> Available (1)
                                    </span>
                                <span class="filter_option light_blue last">
                                        <span class="status disabled"></span> Parking (1)
                                    </span>

                                <div class="search_management_option">
                                    <form action="/" class="search_form_option">
                                        <input type="text" class="block_btn_30 search_input" value="search">
                                        <button type="submit" class="search_button"><i class="icon-search"></i></button>
                                    </form>
                                    <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                                    <a href="#" class="add_new_user"><i class="icon-add_number"></i>Add SIM</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </section>

                </div>

                <div class="tab-pane" id="type_management">

                    <section class="filter_status">
                        <div class="type_management_wrapper">
                            <div class="filter_text">Filter by status:</div>
                            <div class="filter_buttons">
                                    <span class="filter_option blue">
                                        <i class="icon-company_status"></i> All (7)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status active"></span> enable (2)
                                    </span>
                                <span class="filter_option light_blue">
                                        <span class="status disabled"></span> disable (1)
                                    </span>

                                <div class="search_management_option">
                                    <form action="/" class="search_form_option">
                                        <input type="text" class="block_btn_30 search_input" value="search">
                                        <button type="submit" class="search_button"><i class="icon-search"></i></button>
                                    </form>
                                    <a href="#" class="export_user"><i class="icon-export"></i>Export</a>
                                    <a href="#" class="add_new_user"><i class="icon-add_type"></i>Add new type</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane" id="tab_d2">
                    <h4 style="color: red;">Settings 2</h4>
                    <p style="color: red;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                        ac turpis egestas.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
