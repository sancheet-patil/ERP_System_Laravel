<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <link rel="stylesheet" href="{{asset('loginpanel1/fonts/material-design-iconic-font/css/material-design-iconic-font.css')}}">
    <link rel="stylesheet" href="{{asset('loginpanel1/css/style.css')}}">
</head>
{{--<body oncopy="return false" onpaste="return false" oncut="return false" onmousedown="return false" onselectstart="return false">--}}
<body>
<div class="wrapper">
    <div class="image-holder">
        <img style="margin: 0 25px" src="{{asset('loginpanel/images/bgnew.jpeg')}}" alt="">
    </div>
    <form action="{{'/log1n'}}" method="post">
        <div id="wizard">
            <section>
                <div class="form-row">
                    <label for="aadhar">
                        AADHAR Number
                    </label>
                    <input class="form-control" id="aadhar" type="text" placeholder="AADHAR number" @error('aadhar') is-invalid  @enderror name="aadhar" value="{{ old('aadhar') }}" required autocomplete="email" autofocus>
                </div>
                <div class="form-row">
                    <label for="password">
                        Password
                    </label>
                    <input class="form-control" id="password" type="password" placeholder="Password" @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                </div>
                <div class="form-row">
                    <label for="registerfor">
                        Register for
                    </label>
                    <div class="form-holder">
                        <select name="registerfor" id="registerfor" class="form-control" required>
                            <option value="">Select</option>
                            <option value="School">School</option>
                            <option value="College">College</option>
                            <option value="School Form 17">School Form 17</option>
                            <option value="College Form 17">College Form 17</option>
                        </select>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </div>
                <div class="form-row">
                    <label for="academicyear">
                        Academic year
                    </label>
                    <div class="form-holder">
                        <select class="form-control" id="academicyear" name="academicyear" required>
                            <option value="">Select</option>
                            <?php
                            $yearlist = \App\AcademicYearList::orderBy('academicyear','desc')->get();
                            ?>
                            @foreach($yearlist as $year)
                                <option value="{{$year->academicyear}}">{{$year->academicyear}}</option>
                            @endforeach
                        </select>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </div>
                <div class="form-row">
                    @csrf
                    <button type="submit" style="padding: 0 0 0 45px; border: none; display: inline-flex;height: 51px;width: 135px;align-items: center;background: #f3d4b7;cursor: pointer;position: relative;">Login</button>
                </div>
            </section>
        </div>
    </form>
</div>
<script src="{{asset('loginpanel1/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('loginpanel1/js/main.js')}}"></script>

<script type='text/javascript'>
    $(document).keydown(function(event) {
        var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();

        if((event.ctrlKey && event.shiftKey && event.keyCode === 73)){ // inspect disable - Ctrl+Shift+I
            alert('This is Function Disabled');
            return false;
        }
        if((event.ctrlKey && event.keyCode === 85)){ // view source disable - Ctrl+U
            alert('This is Function Disabled');
            return false;
        }
        if(event.keyCode === 123){ // inspect disable - F12
            alert('This is Function Disabled');
            return false;
        }
    });

    // right click disable
    function mischandler(){
        alert('This is Function Disabled');
        return false;
    }
    function mousehandler(e){
        var myevent = (isNS) ? e : event;
        var eventbutton = (isNS) ? myevent.which : myevent.button;
        if((eventbutton===2)||(eventbutton===3)) return false;
    }
    document.oncontextmenu = mischandler;
    document.onmousedown = mousehandler;
    document.onmouseup = mousehandler;

    //select content disable
    function killCopy(e){
        // return false
    }
    function reEnable(){
        // return true
    }
    document.onselectstart=new Function ("return false")
    if (window.sidebar){
        document.onmousedown=killCopy
        document.onclick=reEnable
    }
</script>
</body>
</html>