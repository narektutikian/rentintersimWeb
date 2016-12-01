<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Vodafone</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="/js/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="wrapper">
@include('header')
    <div class="layout">
        <div class="container">
            <!-- content navigation -->
            <nav class="layout_nav">
                <ul>
                    <li class="active"><a href="{{url('/dashboard')}}" title="DashboardUser Management">DashboardUser Management</a></li>
                    <li><a href="{{url('/user')}}" title="User Management">User Management</a></li>
                    <li><a href="{{url('/number')}}" title="Number Management">Number Management</a></li>
                    <li><a href="{{url('/sim')}}" title="SIM Management">SIM Management</a></li>
                    <li class="show_settings">
                        <a href="#" title="Settings" class="show_settings">Settings <i class="icon-dropdown"></i></a>
                        <ul class="setting_types">
                            <li><a href="{{url('/type')}}" title="Type Management">Type Management</a></li>
                            <li><a href="#" title="">Submenu 1-2</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="content">
                @yield('dashboard')
            </div>
        </div>

    </div>



</div>


<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/pie-chart/pie-chart.js"></script>
<script src="/js/bootstrap-table.min.js"></script>
<script src="/js/bootstrap-table-zh-CN.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>