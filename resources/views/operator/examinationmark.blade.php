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
                <li class="active">Student Information</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Student Information</h3>
                        </div>
                        <div class="box-body">
                            @if($message = Session::get('success'))
                                <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                            @endif
                            {!! Session::forget('success') !!}
                            <div class="row col-md-12">
                                <div class="form-group col-md-4" hidden>
                                    <label for="studentid">Studentid</label> <small class="req"> *</small>
                                    <input type="text" id="studentid" name="studentid" class="form-control" value="{{$studentid}}" required readonly/>
                                </div>
                                <?php
                                $student = \App\StudentDetails::where('userid',$studentid)->first();
                                ?>
                                <div class="form-group col-md-4">
                                    <label for="studentname">Student Name</label> <small class="req"> *</small>
                                    <input type="text" id="studentname" name="studentname" class="form-control" value="{{$student->fname.' '.$student->mname.' '.$student->lname}}" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="roll_no">Roll no.</label>
                                    <input type="text" id="roll_no" name="roll_no" class="form-control" value="{{$student->roll_no}}" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="semester">Semester</label>
                                    <input type="text" id="semester" name="semester" class="form-control" value="{{$semester}}" required readonly/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> School Information</h3>
                        </div>
                        <form action="{{route('examinationmark.submit')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="add_timetable_table">
                                        <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Out of marks</th>
                                            <th>Obtained marks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjectlist as $subject)
                                            <tr>
                                                <td hidden>
                                                    <input type="text" id="studentid" name="studentid[]" class="form-control" value="{{$studentid}}" required/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="semester" name="semester[]" class="form-control" value="{{$semester}}" required/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="classname" name="classname[]" class="form-control" value="{{$student->classname}}" required/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="division" name="division[]" class="form-control" value="{{$student->division}}" required/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="subjectname" name="subjectname[]" class="form-control" value="{{$subject->subjectid}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <input type="text" id="" name="" class="form-control" value="{{$subject->subjectname}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <input type="text" id="outofmarks" name="outofmarks[]" class="form-control" value="{{$subject->outofmarks}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <?php
                                                        $obtainedmarks = \App\SchoolExamination::where('classname',$student->classname)->where('division',$student->division)
                                                            ->where('semester',$semester)->where('subjectname',$subject->subjectid)->where('studentid',$studentid)->value('marks');
                                                    ?>
                                                    <input type="number" id="obtainedmarks" name="obtainedmarks[]" min="0" max="{{$subject->outofmarks}}" class="form-control" value="{{$obtainedmarks}}" required/>
                                                </td>
                                            </tr>
                                        @endforeach
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

</body>
</html>
