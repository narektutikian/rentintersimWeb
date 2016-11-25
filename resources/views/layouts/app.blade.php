<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>Vodafone</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-2 col-xs-2">
                    <div class="logo">
                        <a href="{{url('/dashboard')}}"><img src="/{{Auth::user()->logo}}" alt="Logo"></a>
                    </div>
                    <nav class="main_nav">
                        <ul>
                            <li><a href="{{url('home')}}">Orders List</a></li>
                            <li><a href="#">Reports</a></li>
                            @if (Auth::user()->type != 'employee')
                            <li><a href="#">Admin Panel</a></li>
                             @endif
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-10 col-sm-offset-0 col-xs-10 col-xs-offset-0">
                    <ul class="personal_info">
                        <li class="date_time"><data value="October 26, 2016 17:12">October 26, 2016 <i class="icon-time"></i> 17:13</data></li>
                        <li class="profile">
                            <span class="profile_name">{{ Auth::user()->name }} <i class="icon-dropdown"></i></span>
                            <ul class="header_dropdown choose_user">
                                <li><a href="#">Profile</a></li>
                                <li> <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Log Out
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form></li>
                            </ul>
                        </li>
                        <li class="languages">
                            <span class="current_language">english <i class="icon-dropdown"></i></span>
                            <ul class="header_dropdown choose_language">
                                <li><a href="#">english</a></li>
                                {{--<li><a href="#">french</a></li>--}}
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

                </div>
            </div>
        </div>
        <ul class="mobile_nav">
            <li><a href="#">Orders List</a></li>
            <li><a href="#">Reports</a></li>
            @if (Auth::user()->type != 'employee')
            <li><a href="#">Admin Panel</a></li>
            @endif
        </ul>
    </header>
         @yield('content')

</div>
<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/pie-chart/pie-chart.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>

