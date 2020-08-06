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
                <li class="active">Student Bulk ID Generate</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Bulk ID Generate</h3>
                        </div>
                        <form action="{{route('studentidgenerate.bulk.post')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4">
                                    <label for="classname">Class</label><small class="req"> *</small>
                                    <select id="classname" name="classname" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                        ?>
                                        @foreach($classlist as $class)
                                            <option value="{{$class->classname}}">{{$class->classname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(\Illuminate\Support\Facades\Session::get('registerfor') == 'College')
                                    <div class="form-group col-md-4" id="facultydiv">
                                        <label for="faculty">Faculty</label> <small class="req"> *</small>
                                        <select id="faculty" name="faculty" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Arts">Arts</option>
                                            <option value="Commerce">Commerce</option>
                                            <option value="Science">Science</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label><small class="req"> *</small>
                                    <select id="division" name="division" class="form-control select2" required>
                                    </select>
                                </div>
                                <div class="container col-md-12">
                                    <h3 style="margin: 0 0 10px 0; text-align: center;">Select students for ID print</h3>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <select name="from[]" id="undo_redo" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="unselectedstudents"></span>
                                        </div>
                                        <div class="col-xs-2">
                                            {{--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>--}}
                                            <button type="button" id="undo_redo_rightAll" class="btn btn-primary btn-block">Get all</button>
                                            <button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block">Get selected</button>
                                            <button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block">Put selected</button>
                                            <button type="button" id="undo_redo_leftAll" class="btn btn-danger btn-block">Put all</button>
                                            {{--<button type="button" id="undo_redo_redo" class="btn btn-warning btn-block">redo</button>--}}
                                        </div>
                                        <div class="col-xs-5">
                                            <select name="to[]" id="undo_redo_to" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="selectedstudents"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Print</button>
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
<script src="{{asset('js/multiselect.js')}}"></script>

<script>
    $('#classname').change(function(){
        $.ajax({
            type:"get",
            url:"{{url('divisionlist')}}?classname=" + $('#classname').val(),
            beforeSend:function(){
                $("#division").empty().append('<option value="">Select</option>');
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
        if(classname > '10'){
            $.ajax({
                type:"get",
                url:"{{url('dividedcollegestudents')}}?classname=" + $('#classname').val()+'&division='+$('#division').val()+'&faculty='+$('#faculty').val(),
                beforeSend:function(){
                    $("#undo_redo").empty();
                    $("#undo_redo_to").empty();
                },
                success:function(data){
                    if(data){
                        for(var i=0;i<data.length;i++){
                            $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].lname+' '+data[i].fname+' '+data[i].mname+'</option>');
                        }
                    }
                    if (data.length === 0){
                        alert('Student not present.');
                    }
                }
            });
            return;
        }
        $.ajax({
            type:"get",
            url:"{{url('dividedstudents')}}?classname=" + $('#classname').val()+'&division='+$('#division').val(),
            beforeSend:function(){
                $("#undo_redo").empty();
                $("#undo_redo_to").empty();
            },
            success:function(data){
                if(data){
                    for(var i=0;i<data.length;i++){
                        $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].fname+' '+data[i].mname+' '+data[i].lname+'</option>');
                    }
                }
                if (data.length === 0){
                    alert('Student not present.');
                }
            }
        });
    });

    $(document).ready(function() {
        $('#undo_redo').multiselect();
    });
    function selectall() {
        if($('#undo_redo_to option').length < 1){
            return false;
        }
        $('#undo_redo option').prop('selected', true);
        $('#undo_redo_to option').prop('selected', true);
    }

    function getboxdetails() {
        var unselectedmale = 0;
        var unselectedfemale = 0;
        var selectedmale = 0;
        var selectedfemale = 0;
        $('#undo_redo > option').each(function() {
            var gender = $(this).data('gender');

            if(gender === 'Male'){
                unselectedmale+=1;
            }
            if(gender === 'Female'){
                unselectedfemale+=1;
            }
        });
        $('#undo_redo_to > option').each(function() {
            var gender = $(this).data('gender');

            if(gender === 'Male'){
                selectedmale+=1;
            }
            if(gender === 'Female'){
                selectedfemale+=1;
            }
        });

        var unselected = "Total students in box: <b>"+$('#undo_redo > option').length+"</b><br>Male: <b>"+unselectedmale+"</b> and Female: <b>"+unselectedfemale+"</b>";
        var selected = "Total students in box: <b>"+$('#undo_redo_to > option').length+"</b><br>Male: <b>"+selectedmale+"</b> and Female: <b>"+selectedfemale+"</b>";
        $('#unselectedstudents').html(unselected);
        $('#selectedstudents').html(selected);
    }

    window.setInterval(function(){
        getboxdetails();
    }, 1000);

</script>
</body>
</html>
