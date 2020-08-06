<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Queenshera Infotech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{asset('errors/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('errors/css/jquery.countdown.css')}}" />
    <!--js-->
    <script src="{{asset('errors/js/jquery.min.js')}}"></script>
    <script src="{{asset('errors/js/jquery.countdown.js')}}"></script>
    <script src="{{asset('errors/js/script.js')}}"></script>
    <!--js-->
</head>
<body>
<div class="header">
    <h1>This Website Is Under Construction</h1>
</div>
<div class="content">
    <div class="content1">
        <img src="{{asset('errors/images/work.png')}}" alt="under-construction">
    </div>
    <div class="content2">
        <div class="timer_wrap">
            <div id="counter"></div>
        </div>
    </div>
    {{--<div class="content3">
        <p>Subscribe To Our News Letter!</p>
        <ul class="form">
            <li>
                <form>
                    <input type="text" class="email" placeholder="Enter your email address" required="">
                    <input type="submit" value="SUBSCRIBE">
                    <div class="clear"> </div>
                </form>
            </li>
        </ul>
    </div>--}}
</div>
<div class="footer">
{{--    <p>Copyright © Queenshera Infotech. All Rights Reserved | Design by <a href="https://www.queensherainfotech.com" target="_blank">Queenshera Infotech</a></p>--}}
</div>
</body>
</html>
