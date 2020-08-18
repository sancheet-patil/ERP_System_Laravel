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
                <li class="active">School exam</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Class Exam Search</h3>
                        </div>
                        <form method="post" action="{{route('examinationreport1to7.post')}}">
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
                                            @if($class->classname <= '07')
                                                <option value="{{$class->classname}}" @if($class->classname == $classname) selected @endif>{{$class->classname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label>
                                    <select id="division" name="division" class="form-control select2">
                                        @if(isset($divisionlist))
                                            <option value="">Select</option>
                                            @foreach($divisionlist as $division1)
                                                <option value="{{$division1}}" @if($division1 == $division) selected @endif>{{$division1}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="semester">Semester</label><small class="req"> *</small>
                                    <select id="semester" name="semester" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $examlist = \App\ExamTypeList::orderBy('examtype','asc')->get();
                                        ?>
                                        @foreach($examlist as $exam)
                                            <option value="{{$exam->examtype}}" @if($exam->examtype == $semester) selected @endif>{{$exam->examtype}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="submit" class="btn btn-primary pull-right" value="Search" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Student Details</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Register no.</th>
                                        <th>Saral ID</th>
                                        <th>Class</th>
                                        <th>Roll No.</th>
                                        <th>Student name</th>
                                        <th>Gender</th>
                                        <th>Marks submitted</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @if(isset($studentlist))
                                        @foreach($studentlist as $student)
                                            <tr>
                                                <td>{{$srno}}</td>
                                                <td>{{$student->registerno}}</td>
                                                <td>{{$student->saralid}}</td>
                                                <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                                <td>{{$student->roll_no}}</td>
                                                <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                                <td>{{$student->gender}}</td>
                                                <td>
                                                    <?php
                                                    $check = \App\SchoolExamination::where('classname',$student->classname)->where('division',$student->division)
                                                        ->where('semester',$semester)->where('studentid',$student->userid)->first();
                                                    ?>
                                                    @if($check)
                                                        <label class="label label-success">Yes</label>
                                                    @else
                                                        <label class="label label-danger">No</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($check)
                                                        <a href="{{url('examinationreportprint1to7')}}?studentid={{$student->userid}}&semester={{$semester}}" class="btn btn-primary"><i class="fa fa-check"></i> Print report</a>
                                                    @else
                                                        <button class="btn btn-primary" disabled><i class="fa fa-check"></i> Print report</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php $srno++;?>
                                        @endforeach
                                    @endif
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
