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
    <link rel="stylesheet" href="/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="/js/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="/js/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/js/timepicki/css/timepicki.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="loader">
    <div class="loader_inner"></div>
</div>
<div class="wrapper">
    @include('header')
         @yield('content')
        @yield('content_admin')

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





<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/jquery-validation/jquery.validate.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/pie-chart/pie-chart.js"></script>
<script src="/js/bootstrap-table.min.js"></script>
<script src="/js/bootstrap-table-en-US.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<script src="/js/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/bootstrap-datetimepicker.js"></script>
<script src="/js/owl-carousel/owl.carousel.js"></script>
<script src="/js/timepicki/js/timepicki.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/validation.js"></script>
<script src="/js/requests.js"></script>
<script src="/js/order-requests.js"></script>

</body>
</html>

