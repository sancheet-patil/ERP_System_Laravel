<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{config('app.name')}}</title>

    @include('layouts.links')

</head>
<body class="hold-transition skin-purple fixed sidebar-mini">
<div class="wrapper">

    @include('admin.header')
    @include('admin.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{config('app.name')}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Student Scholarship Apply</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Students</h3>
                        </div>
                        <form method="post" action="{{route('resetpassword.reset')}}">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4">
                                    <label for="aadhar">AADHAR</label>
                                    <input type="number" class="form-control" name="aadhar" id="aadhar" value="" required/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">New Password</label>
                                    <input type="text" class="form-control" name="password" id="password" value="" required/>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="submit" id="studentsearch" class="btn btn-primary pull-right" value="Search"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @include('admin.footer')
    <div class="control-sidebar-bg"></div>
</div>
@include('layouts.scripts')
<script>
    $('#aadhar').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/aadhardetails')}}?aadhar="+$('#aadhar').val(),
            beforeSend: function () {
                $("#name").val('');
            },
            success: function (data) {
                $("#name").val(data['name']);
            }
        });
    });
</script>
</body>
</html>
