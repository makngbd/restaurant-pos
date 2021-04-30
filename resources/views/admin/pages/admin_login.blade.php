<!DOCTYPE html>
<html lang="en">

<head>
    <title>Royal Restaurant</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/matrix-login.css')}}" />
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <div id="loginbox">
        <form id="loginform" class="form-vertical" action="{{route('login')}}" method="POST">
            {{ csrf_field() }}
            <div class="control-group normal_text">
                <h3><img src="{{asset('admin/img/logo.png')}}" alt="Logo" /></h3>
            </div>

            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        @if ($errors->has('email'))
                        <p><strong>{{ $errors->first('email') }}</strong></p>
                        @endif
                        @if ($errors->has('password'))
                        <p><strong>{{ $errors->first('password') }}</strong></p>
                        @endif
                        <span class="add-on bg_lg"><i class="fa fa-user"> </i></span><input name="username" type="text" placeholder="Username" autofocus />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="fa fa-lock"></i></span><input name="password" type="password" placeholder="Password" />

                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                <span class="pull-right"><button type="submit" class="btn btn-success" /> Login</button></span>
            </div>
        </form>
        <form id="recoverform" action="" class="form-vertical" method="POST">
            {{ csrf_field() }}
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

            <div class="controls">
                <div class="main_input_box">
                    @if ($errors->has('email'))
                    <p><strong>{{ $errors->first('email') }}</strong></p>
                    @endif
                    <span class="add-on bg_lo"><i class="fa fa-envelope"></i></span><input type="email" name="email" placeholder="E-mail address" />
                </div>
            </div>

            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                <span class="pull-right"><button type="submit" class="btn btn-info" />Reecover</button></span>
            </div>
        </form>
    </div>

    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.login.js')}}"></script>
</body>

</html>