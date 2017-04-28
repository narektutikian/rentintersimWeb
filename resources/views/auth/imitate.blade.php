<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>SimRent</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/perfect-scrollbar/css/perfect-scrollbar.css">
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
                <select class="block_btn login_input  username" name="login">
                    {{--<option value="{{Auth::user()->id}}" >{{Auth::user()->login}}</option>--}}
                    @foreach($net as $user)
                        <option value="{{$user['id']}}" {{ (Auth::user()->id == $user['id']) ? 'selected' : '' }}>{{$user['login']}}</option>
                    @endforeach
                 </select>
                <i class="input_icon icon-password"></i>
            </div>
            {{--styled_select--}}
            <div class="form-group form_row">
                <select class="block_btn login_input " onchange="filterLevel(this.value, '')">
                    <option value="All">All</option>
                    <option value="Super admin">Super admin</option>
                    <option value="Distributor">Distributor</option>
                    <option value="Dealer">Dealer</option>
                    <option value="Subdealer">Subdealer</option>
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
            </div>
        </form>
    </div>
</div>

<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/pie-chart/pie-chart.js')}}"></script>
<script src="{{asset('js/perfect-scrollbar/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/requests.js?v=3')}}"></script>
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


