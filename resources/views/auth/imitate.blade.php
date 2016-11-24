<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Vodafone</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="login_page">

<div class="login_wrapper">
    <h2>Welcome to InterSIM</h2>
    <div class="login_form short">
        <form role="form" method="POST" action="{{ url('/imitate') }}">
            {{ csrf_field() }}
            <h3>User imitation</h3>
            <div class="form-group form_row">
                <select class="block_btn login_input styled_select" name="login">
                    <option value="" >-- Select User --</option>
                    @foreach($net as $user)
                        <option value="{{$user['id']}}" >{{$user['login']}}</option>
                    @endforeach
                 </select>
                <i class="input_icon icon-password"></i>
            </div>
            <div class="form-group form_row">
                <select class="block_btn login_input styled_select">
                    <option value="Level" style="background-color: red; border-bottom: 1px solid #ffff00;">Level</option>
                    {{--<option value="Superadmin" style="background-color: red; border-bottom: 1px solid #ffff00;">Superadmin</option>--}}
                    {{--<option value="Distributor" style="background-color: red; border-bottom: 1px solid #ffff00;">Distributor</option>--}}
                    {{--<option value="Dealer">Dealer</option>--}}
                    {{--<option value="Subdealer">Subdealer</option>--}}
                </select>
                <i class="input_icon icon-level"></i>
            </div>
            @if ($errors->has('login'))
                <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
            @endif
            <div class="form-group form_row short_bottom">
                <input type="submit" class="block_btn light_green_btn" value="Start"/>
                <a class="btn btn-link" href="{{ url('/dashboard') }}">
                    Skip Imitation
                </a>
            </div>
        </form>
    </div>
</div>

<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/pie-chart/pie-chart.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>

{{--
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/imitate') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <select name="login">
                                        <option value="" >-- Select User --</option>
                                        @foreach($net as $user)
                                             <option value="{{$user['id']}}" >{{$user['login']}}</option>
                                        @endforeach
                                             </select>
                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Imitate
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/dashboard') }}">
                                        Skip Imitation
                                    </a>
                                </div>
                            </div>

                        </form>--}}


