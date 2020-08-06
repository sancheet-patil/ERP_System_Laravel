<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{config('app.name')}}</title>

    @include('layouts.links')
    <link rel="stylesheet" href="{{asset('css/jquerysctipttop.css')}}">

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
                <li class="active">Class Attendance</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Class Attendance Search</h3>
                        </div>
                        <form method="post" id="search_class_section_form">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-3">
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
                                <div class="form-group col-md-3">
                                    <label for="division">Division</label><small class="req"> *</small>
                                    <select id="division" name="division" class="form-control select2" required>
                                    </select>
                                </div>
                                @if(\Illuminate\Support\Facades\Session::get('registerfor') == 'College')
                                    <div class="form-group col-md-3" id="facultydiv">
                                        <label for="faculty">Faculty</label>
                                        <select id="faculty" name="faculty" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Arts">Arts</option>
                                            <option value="Commerce">Commerce</option>
                                            <option value="Science">Science</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group col-md-3">
                                    <label for="attendancedate">Date</label><small class="req"> *</small>
                                    <input type="text" id="attendancedate" name="attendancedate" class="form-control" value="{{date('d-m-Y')}}" required />
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="submit" class="btn btn-primary pull-right" value="Search" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" id="choose_attendance_div" style="display: none;">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Mark attendance</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="classattendance-submit" method="post" action="{{route('classattendance.submit')}}">
                                    <span id="result"></span>
                                    <table class="table table-bordered table-striped" id="assign_attendance_table">
                                        <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Present/ Absent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="box-footer">
                                        @csrf
                                        <input type="submit" class="btn btn-primary pull-right" value="Submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Class Attendance Report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_attendance_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Date</th>
                                        <th>Class</th>
                                        <th>Total present</th>
                                        <th>Total absent</th>
                                        <th>Total students</th>
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
        var classname = $(this).val();
        document.getElementById('choose_attendance_div').style.display = 'none';
        $('tbody').html(null);
        $.ajax({
            type:"GET",
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
    });

    $('#division').change(function(){
        document.getElementById('choose_attendance_div').style.display = 'none';
        $('#assign_attendance_table tbody').html(null);
        if($('#classname').val() > '10'){
            return;
        }
        $.ajax({
            type:"GET",
            url:"{{url('getclassattendancereport')}}?classname=" + $('#classname').val()+'&division='+ $('#division').val(),
            beforeSend:function(){
            },
            success:function(data){
                if(data.length !== 0)
                {
                    html = '';
                    for (var i=0; i<data.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td>'+(i+1)+'</td>';
                        html += '<td>'+data[i].attendancedate+'</td>';
                        html += '<td>'+data[i].classname+' ('+data[i].division+')</td>';
                        html += '<td>'+data[i].presentcount+'</td>';
                        html += '<td>'+data[i].absentcount+'</td>';
                        html += '<td>'+data[i].totalcount+'</td>';
                        html += '</tr>';
                    }
                    $('#student_attendance_table tbody').html(html);
                }
            }
        });
    });
    $('#faculty').change(function(){
        $.ajax({
            type:"GET",
            url:"{{url('getclassattendancereport')}}?classname=" + $('#classname').val()+'&division='+ $('#division').val()+'&faculty='+ $('#faculty').val(),
            beforeSend:function(){
            },
            success:function(data){
                if(data.length !== 0)
                {
                    html = '';
                    for (var i=0; i<data.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td>'+(i+1)+'</td>';
                        html += '<td>'+data[i].attendancedate+'</td>';
                        html += '<td>'+data[i].classname+' ('+data[i].division+')</td>';
                        html += '<td>'+data[i].presentcount+'</td>';
                        html += '<td>'+data[i].absentcount+'</td>';
                        html += '<td>'+data[i].totalcount+'</td>';
                        html += '</tr>';
                    }
                    $('#student_attendance_table tbody').html(html);
                }
            }
        });
    });

    $(function () {
        $('#attendancedate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        }).inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
    });
    var attendancedate=null;
    var studentcount=0;
    $('#search_class_section_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: '{{url('/getclassattendance')}}',
            method:'get',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function() {
                attendancedate = $('#date').val();
                document.getElementById('choose_attendance_div').style.display = 'none';
                $('#assign_attendance_table tbody').html(null);
            },
            success:function(data)
            {
                if(data.length !== 0)
                {
                    studentcount = data.length;
                    html = '';
                    for (var i=0; i<data.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td hidden><input type="text" name="academicyear[]" class="form-control" value="'+data[i].academicyear+'" readonly /></td>';
                        html += '<td hidden><input type="text" name="attendancedate[]" class="form-control" value="'+data[i].attendancedate+'" readonly /></td>';
                        html += '<td hidden><input type="text" name="classname[]" class="form-control" value="'+data[i].classname+'" readonly /></td>';
                        html += '<td hidden><input type="text" name="division[]" class="form-control" value="'+data[i].division+'" readonly /></td>';
                        html += '<td><input type="text" name="studentid[]" class="form-control" value="'+data[i].studentid+'" readonly tabindex="-1"/></td>';
                        html += '<td><input type="text" name="roll_no[]" class="form-control" value="'+data[i].roll_no+'" readonly tabindex="-1"/></td>';
                        html += '<td><input type="text" name="studentname[]" class="form-control" value="'+data[i].fname+' '+data[i].mname+' '+data[i].lname+'" readonly tabindex="-1" /></td>';
                        if(data[i].ispresent === "1"){
                            html += '<td>' +
                                '<input type="checkbox" id="ispresentcb'+i+'" checked />' +
                                '<input type="hidden" id="ispresent'+i+'" name="ispresent[]" value="1" />' +
                                '<span>&nbsp;&nbsp;Check for present and uncheck for absent</span>'+
                                '</td>';
                        }
                        else{
                            html += '<td>' +
                                '<input type="checkbox" id="ispresentcb'+i+'" />' +
                                '<input type="hidden" id="ispresent'+i+'" name="ispresent[]" value="0" />' +
                                '<span>&nbsp;&nbsp;Check for present and uncheck for absent</span>'+
                                '</td>';
                        }
                        html += '</tr>';
                    }
                    $('#assign_attendance_table tbody').html(html);
                }
                document.getElementById('choose_attendance_div').style.display = "block";
            }
        })
    });
    $('#classattendance-submit').submit(function(e){
        for(var i=0;i<studentcount;i++){
            if($('#ispresentcb'+i).prop("checked")){
                $('#ispresent'+i).val(1)
            }
            else {
                $('#ispresent'+i).val(0)
            }
        }
    });

    $(document).ready(function(){
        $('#student_attendance_table').DataTable({
            "scrollX"		: true,
            'paging'		: true,
            "processing"	: true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'aaSorting'     : [],
        });
    });
</script>
</body>
</html>
