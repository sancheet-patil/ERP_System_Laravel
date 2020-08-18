<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{config('app.name')}}</title>

    @include('layouts.links')

</head>
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{route('home')}}" class="navbar-brand">{{config('app.name')}}</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="{{'#'}}" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('images/profile.png')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }} <i class="fa fa-caret-square-o-down fa-4"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{asset('images/profile.png')}}" class="img-circle" alt="User Image">

                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>{{ Auth::user()->email }}</small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{route('profile')}}" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <input type="submit" name="signout" id="signout" class="btn btn-default" value="Log Out"/>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1>
                    {{config('app.name')}}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Change Password</li>
                </ol>
            </section>

            <section class="content">
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Change Login Password</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-3"></div>
                            <form method="post" id="change_login_password_form" class="col-md-6">
                                <span id="login_result"></span>
                                <div class="form-group">
                                    <label for="cpass">Current Password</label>
                                    <input type="password" class="form-control" id="cpass" name="current_password" placeholder="Enter current password" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword">New Password</label>
                                    <input type="password" class="form-control" id="newpassword" name="new_password" placeholder="Enter new password" required />
                                </div>
                                <div class="form-group">
                                    <label for="cnewpass">Confirm Password</label>
                                    <input type="password" class="form-control" id="cnewpass" name="confirm_password" placeholder="Confirm new password" required />
                                </div>
                                <div class="form-group">
                                    @csrf
                                    <input type="submit" name="changepass" id="changepass" class="btn btn-primary center-block" value="Change Password" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.13
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
        </div>
    </footer>
</div>
@include('layouts.scripts')

<script>
    $('#change_login_password_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: '{{ url('/changeloginpassword') }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#login_result').html('');
            },
            success:function(data)
            {
                if(data.response === 'success'){
                    $('#login_result').html('<div class="alert alert-success">'+data.success+'</div>');
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
                else if(data.response === 'error'){
                    $('#login_result').html('<div class="alert alert-error">'+data.error+'</div>');
                }
            }
        });
    });
</script>

</body>
</html>
