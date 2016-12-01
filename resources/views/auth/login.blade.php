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

    <div class="login_form tall">
        <h3>User login </h3>
        <form method="POST" action="{{ url('/login') }}">
            <div class="form-group form_row {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="block_btn login_input" placeholder="Username" value="{{ old('login') }}"  name="login" required autofocus/>
                <i class="input_icon icon-username"></i>
                {{ csrf_field() }}
            </div>

                @if ($errors->has('login'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                @endif

            <div class="form-group form_row {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="block_btn login_input" placeholder="Password" name="password"/>
                <i class="input_icon icon-password"></i>
            </div>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
            <div class="form-group form_row short_bottom">
                <input type="submit" class="block_btn light_green_btn" value="Login"/>
            </div>
            <a class="login_hint" href="{{ url('/password/reset') }}">forgot your password?</a>
        </form>
    </div>
</div>

</body>
</html>

