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
                <li class="active">Bulk division assign</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Bulk Division Assign</h3>
                        </div>
                        <form action="{{route('bulkdivisionassign.add')}}" method="post">
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
                                            <option value="{{$class->classname}}" @if($class->classname == old('classname')) selected @endif>{{$class->classname}}</option>
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
                                    <label for="division">Add students in Division</label><small class="req"> *</small>
                                    <select id="division" name="division" class="form-control select2" required>
                                    </select>
                                </div>
                                <div class="container col-md-12">
                                    <h3 style="margin: 0 0 10px 0; text-align: center;">Select students for division</h3>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select name="from[]" id="undo_redo" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="unselectedstudents"></span>
                                        </div>
                                        <div class="col-md-2">
                                            {{--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>--}}
                                            <button type="button" id="undo_redo_rightAll" class="btn btn-primary btn-block">Get all</button>
                                            <button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block">Get selected</button>
                                            <button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block">Put selected</button>
                                            <button type="button" id="undo_redo_leftAll" class="btn btn-danger btn-block">Put all</button>
                                            {{--<button type="button" id="undo_redo_redo" class="btn btn-warning btn-block">redo</button>--}}
                                        </div>
                                        <div class="col-md-5">
                                            <select name="to[]" id="undo_redo_to" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="selectedstudents"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right" onclick="selectall()">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" id="student_division_div" style="display: none;">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Student list </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="student_division_table">
                                    <thead>
                                    <tr>
                                        <th>Register for</th>
                                        <th>Register no.</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>DoB</th>
                                        <th>AADHAR</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        var classname = $('#classname').val();
        $.ajax({
            type:"get",
            url:"{{url('divisionlist')}}?classname=" + classname,
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
        if(classname > '10'){
            $.ajax({
                type:"get",
                url:"{{url('undividedcollegestudents')}}?classname=" + classname+'&faculty='+$('#faculty').val(),
                beforeSend:function(){
                    $("#undo_redo").empty();
                    $("#undo_redo_to").empty();
                },
                success:function(data){
                    if(data){
                        var boys=0;
                        for(var i=0;i<data.length;i++){
                            $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].lname+' '+data[i].fname+' '+data[i].mname+'</option>');
                            if(data[i].gender === 'Male'){
                                boys+=1;
                            }
                        }
                        var printdata = "Total students in box: <b>"+data.length+"</b>, Boys: <b>"+boys+"</b>, Girls: <b>"+(data.length - boys)+"</b>";
                        /*$('#studentcount').html(printdata);*/
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
            url:"{{url('undividedstudents')}}?classname=" + classname,
            beforeSend:function(){
                $("#undo_redo").empty();
                $("#undo_redo_to").empty();
            },
            success:function(data){
                if(data){
                    var boys=0;
                    for(var i=0;i<data.length;i++){
                        $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].lname+' '+data[i].fname+' '+data[i].mname+'</option>');
                        if(data[i].gender === 'Male'){
                            boys+=1;
                        }
                    }
                    var printdata = "Total students in box: <b>"+data.length+"</b>, Boys: <b>"+boys+"</b>, Girls: <b>"+(data.length - boys)+"</b>";
                    /*$('#studentcount').html(printdata);*/
                }
                if (data.length === 0){
                    alert('Student not present.');
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
                },
                success:function(data){
                    if(data){
                        totaldivisions = data.length;
                        html = '';
                        for (var i=0; i<data.length ; i++)
                        {
                            html += '<tr>';
                            html += '<td>'+data[i].registerfor+'</td>';
                            html += '<td>'+data[i].registerno+'</td>';
                            html += '<td>'+data[i].fname+' '+data[i].mname+' '+data[i].lname+'</td>';
                            html += '<td>'+data[i].gender+'</td>';
                            html += '<td>'+data[i].dob+'</td>';
                            html += '<td>'+data[i].aadhar+'</td>';
                            html += '</tr>';
                        }
                        $('#student_division_table tbody').html(html);
                        document.getElementById('student_division_div').style.display = "block";
                    }
                }
            });
            return;
        }
        $.ajax({
            type:"get",
            url:"{{url('dividedstudents')}}?classname=" + $('#classname').val()+'&division='+$('#division').val(),
            beforeSend:function(){
            },
            success:function(data){
                if(data){
                    totaldivisions = data.length;
                    html = '';
                    for (var i=0; i<data.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td>'+data[i].registerfor+'</td>';
                        html += '<td>'+data[i].registerno+'</td>';
                        html += '<td>'+data[i].fname+' '+data[i].mname+' '+data[i].lname+'</td>';
                        html += '<td>'+data[i].gender+'</td>';
                        html += '<td>'+data[i].dob+'</td>';
                        html += '<td>'+data[i].aadhar+'</td>';
                        html += '</tr>';
                    }
                    $('#student_division_table tbody').html(html);
                    document.getElementById('student_division_div').style.display = "block";
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

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
