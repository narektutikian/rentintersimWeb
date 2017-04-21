@extends('layouts.admin')

@section('dashboard')
    <div id="dashboard">
        <section class="distributors">
            <div class="row">
                <div class="col-md-4 col-sm-4 align_first">
                    <div class="distributor_item">
                        <div class="distributor_icon">
                            <i class="icon-distributor"></i>
                        </div>
                        <div class="distributor_item_options">
                            <span class="number">{{$net['distributors']}}</span>
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
                            <span class="number">{{$net['dealers']}}</span>
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
                            <span class="number">{{$net['subdealers']}}</span>
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
                            <div id="chart_active"  class="pie-title-center" data-percent="{{($counts['active'] != 0) ? ($counts['active']/$counts['All'])*100 : '0' }}">
                                <span class="pie-value"></span>
                            </div>
                            <span class="phone_chart_status">active</span>
                        </div>
                        <div class="phone_charts middle">
                            <div id="chart_pending"  class="pie-title-center" data-percent="{{($counts['pending'] != 0) ? ($counts['pending']/$counts['All'])*100 : '0' }}">
                                <span class="pie-value"></span>
                            </div>
                            <span class="phone_chart_status">pending</span>
                        </div>
                        <div class="phone_charts">
                            <div id="chart_not_used"  class="pie-title-center" data-percent="{{($counts['not in use'] != 0) ? ($counts['not in use']/$counts['All'])*100 : '0' }}">
                                <span class="pie-value"></span>
                            </div>
                            <span class="phone_chart_status">not in use</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="average_numbers">
                        <h2 class="total_numbers_title">Efficiency (monthly in percent)</h2>
                        <div class="wrap_average">
                            <div class="average_value">
                                <span class="value"></span>
                                <span class="av_status">active</span>
                            </div>
                            <div class="phone_charts">
                                <div id="chart_average"  class="pie-title-center" data-percent="{{$avgMonthlyTime}}">
                                    <span class="pie-value"></span>
                                </div>
                            </div>
                            <div class="remainder_value">
                                <span class="value"></span>
                                <span class="av_status">Inactive</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection