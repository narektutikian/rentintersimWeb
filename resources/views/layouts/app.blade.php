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
    <link rel="stylesheet" href="/js/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.css">
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
    @include('header')
         @yield('content')
        @yield('content_admin')

</div>
<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/pie-chart/pie-chart.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/bootstrap-datetimepicker.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>

