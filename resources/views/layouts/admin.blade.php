<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>SIM Rent</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="/js/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="/js/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="/css/style.css?v=2">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>;
        var USER = <?php echo Auth::user()->toJson(); ?>;
    </script>
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
                    <li class="{{ ($viewName == 'dashboard') ? 'active' : '' }}"><a href="{{url('/dashboard')}}" title="DashboardUser Management">Dashboard</a></li>
                    @endif
                    <li class="{{ ($viewName == 'user') ? 'active' : '' }}"><a href="{{url('/user')}}" title="User Management">User Management</a></li>
                    <li class="{{ ($viewName == 'price-list') ? 'active' : '' }}"><a href="{{url('/price-list')}}" title="Price Lists">Price Lists</a></li>
                        @if(Auth::user()->level == 'Super admin')
                    <li class="{{ ($viewName == 'number') ? 'active' : '' }}"><a href="{{url('/number')}}" title="Number Management">Number Management</a></li>
                    <li class="{{ ($viewName == 'sim') ? 'active' : '' }}"><a href="{{url('/sim')}}" title="SIM Management">SIM Management</a></li>
                    <li class="{{ ($viewName == 'type') ? 'active' : '' }}"><a href="{{url('/type')}}" class="type_management " title="Type Management">Type Management</a></li>
                    <li class="{{ ($viewName == 'cli') ? 'active' : '' }}"><a href="{{url('/cli')}}" title="CLI Check">CLI Check</a></li>

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
            <form action="/" class="form-horizontal">
                <div class="modal-body">
                    Are you sure?

                    <input type="hidden" value="" id="hidden-req-id">
                    <input type="hidden" value="" id="hidden-req-url">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="confirm_recover" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm_recover">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/" class="form-horizontal">
                <div class="modal-body">
                    Are you sure?
                    <input type="hidden" value="" id="recover-req-id">
                    <input type="hidden" value="" id="recover-req-url">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="recover">Recover</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </form>
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
<script src="/js/scripts.js?v=3"></script>
<script src="/js/validation.js"></script>
<script src="/js/requests.js?v=2"></script>
<script src="/js/order-requests.js?v=2"></script>
<script src="/js/tables.js?v=2"></script>
<script src="/js/price-list.js"></script>
</body>
</html>