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
                <li class="active">Student report</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Select Class</h3>
                        </div>

                        <form method="post" action="{{route('studentattendanceataloguereport.post')}}">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-3">
                                    <label for="classname">Class</label><small class="req"> *</small>
                                    <select id="classname" name="classname" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                        ?>
                                        @foreach($classlist as $class)
                                            <option value="{{$class->classname}}" @if($class->classname == $classname) selected @endif>{{$class->classname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sectionname">Division</label>
                                    <select id="division" name="division" class="form-control select2">
                                        @if(isset($divisionlist))
                                            <option value="">Select</option>
                                            @foreach($divisionlist as $division1)
                                                <option value="{{$division1}}" @if($division1 == $division) selected @endif>{{$division1}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="month">Month</label>
                                    <select id="month" name="month" class="form-control select2" required>
                                        @for($m=1;$m<=12;$m++)
                                            <option value="{{date('m', mktime(0,0,0,$m, 1, date('Y')))}}" @if($month == date('m', mktime(0,0,0,$m, 1, date('Y')))) selected @endif>{{date('F', mktime(0,0,0,$m, 1, date('Y')))}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="year">Year</label>
                                    <select id="year" name="year" class="form-control select2" required>
                                        @for($year1=date('Y');$year1>1950;$year1--)
                                            <option value="{{$year1}}" @if($year == $year1) selected @endif>{{$year1}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Class Attendance Report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
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
                                    <?php $srno=1;?>
                                    @if($studentlist)
                                        @foreach($studentlist as $student)
                                            <tr>
                                                <td>{{$srno}}</td>
                                                <?php $srno++;?>
                                                <td>{{$student['attendancedate']}}</td>
                                                <td>{{$student['classname'].' ('.$student['division'].')'}}</td>
                                                <td>{{$student['presentcount']}}</td>
                                                <td>{{$student['absentcount']}}</td>
                                                <td>{{$student['totalcount']}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if($classname)
                                <span class="pull-right">
                                    <a href="{{url('studentcataloguereport/studiesofmonth')}}?classname={{$classname}}&division={{$division}}&month={{$month}}&year={{$year}}" class="btn btn-primary" target="_blank"><i class="fa fa-book"></i> Studies of Month</a>
                                    <a href="{{url('studentattendanceataloguereport/details')}}?classname={{$classname}}&division={{$division}}&month={{$month}}&year={{$year}}" class="btn btn-success" target="_blank"><i class="fa fa-check"></i> Attendance Details</a>
                                    <a href="{{url('studentattendanceataloguereport/summary')}}?classname={{$classname}}&division={{$division}}&month={{$month}}&year={{$year}}" class="btn btn-info" target="_blank" style="margin-right: 20px;"><i class="fa fa-calendar"></i> Monthly Attendance Register</a>
                                </span>
                            @endif
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

<script>
    $('#classname').change(function(){
        var classname = $(this).val();
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
    });

    $(document).ready(function(){
        $('#student_table').DataTable({
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

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
