<header class="main-header">
    <a href="{{'#'}}" class="logo">
        <span class="logo-mini">LVM</span>
        <span class="logo-lg">{{config('app.name')}}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="{{'#'}}" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

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
    </nav>
</header>
