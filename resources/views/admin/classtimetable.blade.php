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
                <li class="active">Class Timetable</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Class Timetable</h3>
                        </div>
                        <div class="box-body">
                            @if($message = Session::get('success'))
                                <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                            @endif
                            {!! Session::forget('success') !!}
                            <div class="form-group col-md-4">
                                <label for="classname">Class</label><small class="req"> *</small>
                                <select id="classname" name="classname" class="form-control select2" required autofocus>
                                    <option value="">Select</option>
                                    <?php
                                    $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                    ?>
                                    @foreach($classlist as $class)
                                        <option value="{{$class->classname}}">{{$class->classname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="division">Division</label><small class="req"> *</small>
                                <select id="division" name="division" class="form-control select2" required>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="subjectname">Subject</label><small class="req"> *</small>
                                <select id="subjectname" name="subjectname" class="form-control select2" required>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            @csrf
                            <button id="search_timetable" class="btn btn-primary pull-right">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="add_timetable_div" style="display: none;">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Class Timetable</h3>
                        </div>
                        <form method="post" action="{{route('classtimetable.add')}}" id="add_timetable_form">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="add_timetable_table">
                                        <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Hall No.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
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
    $('#classname').change(function(){
        var classname = $(this).val();
        $.ajax({
            type:"GET",
            url:"{{url('divisionlist')}}?classname="+classname,
            beforeSend:function(){
                $('#division').empty().append('<option value="">Select</option>')
            },
            success:function(data){
                if(data){
                    $.each(data,function(index,value){
                        $("#division").append('<option value="'+value+'">'+value+'</option>');
                    });
                }
            }
        });
    });
    $('#division').change(function(){
        document.getElementById('add_timetable_div').style.display = 'none';
        $.ajax({
            type:"GET",
            url:"{{url('classsubjectlist')}}",
            data:{
                'classname': $('#classname').val(),
                'division': $('#division').val(),
            },
            beforeSend:function(){
                $("#subjectname").empty().append('<option value="">Select</option>');
            },
            success:function(data){
                if(data){
                    for (var i=0; i<data.length ; i++)
                    {
                        $("#subjectname").append('<option value="'+data[i].subjectid+'">'+data[i].subjectname+'</option>');
                    }
                }
            }
        });
    });

    $('#search_timetable').click(function(){
        $.ajax({
            type:"GET",
            url:"{{url('/timetablecalender')}}",
            data:{
                'classname': $('#classname').val(),
                'division': $('#division').val(),
                'subjectname': $('#subjectname').val(),
            },
            success:function(res){
                if(res){
                    html = '';
                    for (var i=0; i<res.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td>'+res[i].dayofweek+'</td>';
                        html += '<td hidden><input type="text" id="classname" name="classname[]" class="form-control" value="'+document.getElementById('classname').value+'" required/></td>';
                        html += '<td hidden><input type="text" id="division" name="division[]" class="form-control" value="'+document.getElementById('division').value+'" required/></td>';
                        html += '<td hidden><input type="text" id="subjectname" name="subjectname[]" class="form-control" value="'+document.getElementById('subjectname').value+'" required/></td>';
                        html += '<td hidden><input type="text" id="dayofweek" name="dayofweek[]" class="form-control" value="'+res[i].dayofweek+'" required/></td>';
                        html += '<td><div class="input-group"><input type="text" id="starttime'+i+'" onblur="onstartclose('+i+')" name="starttime[]" class="form-control mytimepicker" value="'+res[i].starttime+'" required/><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td>';
                        html += '<td><div class="input-group"><input type="text" id="endtime'+i+'" onblur="onendclose('+i+')" name="endtime[]" class="form-control mytimepicker" value="'+res[i].endtime+'" required/><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td>';
                        html += '<td><input type="number" min="1" id="hallno" name="hallno[]" class="form-control" value="'+res[i].hallno+'" required/></td>';
                        html += '</tr>';
                    }
                    $('tbody').html(html);
                    document.getElementById('add_timetable_div').style.display = "block";
                }
            }
        });
    });

    $(document).on('focus', '.mytimepicker', function(){
        $(this).timepicker({
            showInputs: false,
            showMeridian: false,
            minuteStep: 5,
            autoclose: true
        }).on('changeTime', function (ev) {
            $(this).timepicker('hide');
        });
    });

    function onstartclose(id) {
        $('#starttime'+id).timepicker("hideWidget");
    }

    function onendclose(id) {
        $('#endtime'+id).timepicker("hideWidget");
    }
</script>
</body>
</html>
