<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vodafone</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="/js/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="wrapper">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-2 col-xs-2">
                    <div class="logo">
                        <a href="index.html"><img src="img/logo.jpg" alt="Logo"></a>
                    </div>
                    <nav class="main_nav">
                        <ul>
                            <li><a href="orders_list.html">Orders List</a></li>
                            <li><a href="#">Reports</a></li>
                            <li><a href="#">Admin Panel</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-10 col-sm-offset-0 col-xs-10 col-xs-offset-0">
                    <nav class="profile_nav">
                        <ul class="personal_info">
                            <li class="date_time"><data value="October 26, 2016 17:12">October 26, 2016 <i class="icon-time"></i> 17:13</data></li>
                            <li class="profile">
                                <span class="profile_name">John Smith <i class="icon-dropdown"></i></span>
                                <ul class="header_dropdown choose_user">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Log Out</a></li>
                                </ul>
                            </li>
                            <li class="languages">
                                <span class="current_language">english <i class="icon-dropdown"></i></span>
                                <ul class="header_dropdown choose_language">
                                    <li><a href="#">english</a></li>
                                    <li><a href="#">french</a></li>
                                </ul>
                            </li>
                            <li class="mobile">
                                <a class="mobile_nav_button">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </li>
                        </ul>
                    </nav>


                </div>
            </div>
        </div>
        <ul class="mobile_nav">
            <li><a href="#">Orders List</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Admin Panel</a></li>
        </ul>
    </header>
    <div class="layout">
        <div class="container">
            <!-- content navigation -->
            <nav class="layout_nav">
                <ul>
                    <li class="active"><a href="#" title="DashboardUser Management">DashboardUser Management</a></li>
                    <li><a href="user-management.html" title="User Management">User Management</a></li>
                    <li><a href="#" title="Number Management">Number Management</a></li>
                    <li><a href="#" title="SIM Management">SIM Management</a></li>
                    <li class="show_settings">
                        <a href="#" title="Settings" class="show_settings">Settings <i class="icon-dropdown"></i></a>
                        <ul class="setting_types">
                            <li><a href="#" title="Type Management">Type Management</a></li>
                            <li><a href="#" title="">Submenu 1-2</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            @yield('dashboard')
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