<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Vodafone</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="/js/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="/js/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="loader">
    <div class="loader_inner"></div>
</div>
<div class="wrapper">
@include('header')
    <div class="layout">
        <div class="container">
            <!-- content navigation -->
            <nav class="layout_nav">
                <ul>
                    @if(Auth::user()->level == 'Super admin')
                    <li class="{{ ($viewName == 'dashboard') ? 'active' : '' }}"><a href="{{url('/dashboard')}}" title="DashboardUser Management">DashboardUser Management</a></li>
                    @endif
                    <li class="{{ ($viewName == 'user') ? 'active' : '' }}"><a href="{{url('/user')}}" title="User Management">User Management</a></li>
                        @if(Auth::user()->level == 'Super admin')
                    <li class="{{ ($viewName == 'number') ? 'active' : '' }}"><a href="{{url('/number')}}" title="Number Management">Number Management</a></li>
                    <li class="{{ ($viewName == 'sim') ? 'active' : '' }}"><a href="{{url('/sim')}}" title="SIM Management">SIM Management</a></li>
                    <li class="{{ ($viewName == 'type') ? 'active' : '' }}"><a href="{{url('/type')}}" class="type_management " title="Type Management">Type Management</a></li>
                    {{--<li><a href="{{url('/type')}}" title="Settings">Settings</a></li>--}}

                    <!--<li  class="show_settings {{ ($viewName == 'type') ? 'active' : '' }}">
                        <a href="#" title="Settings" class="show_settings_link">Settings <i class="icon-dropdown"></i></a>
                        <ul class="setting_types">

                            <li><a href="#" title="">Submenu 1-2</a></li>
                        </ul>
                    </li>-->
                        @endif
                </ul>
            </nav>
            <div class="content">
                @yield('dashboard')
            </div>
        </div>

    </div>

</div>

<div id="confirm_delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm_delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>

    </div>
</div>

<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery-validation/jquery.validate.min.js"></script>
<script src="/js/pie-chart/pie-chart.js"></script>
<script src="/js/bootstrap-table.min.js"></script>
<script src="/js/bootstrap-table-en-US.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/bootstrap-datetimepicker.js"></script>
<script src="/js/owl-carousel/owl.carousel.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/validation.js"></script>
<script src="/js/requests.js"></script>
<script src="{{ asset('js/order-requests.js') }}"></script>


</body>
</html>