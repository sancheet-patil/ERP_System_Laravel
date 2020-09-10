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
                <li class="active">Exam Evaluation</li>
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
                                <div class="form-group col-md-4">
                                    <label for="examtype">Exam type</label> <small class="req"> *</small>
                                    <input type="text" id="examtype" name="examtype" class="form-control" value="{{$data->examtype}}" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="classname">Classname</label> <small class="req"> *</small>
                                    <input type="text" id="classname" name="classname" class="form-control" value="{{$data->classname}}" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label>
                                    <input type="text" id="division" name="division" class="form-control" value="{{$data->division}}" required readonly/>
                                </div>
                                <div class="form-group col-md-4" @if(\Illuminate\Support\Facades\Session::get('registerfor') != 'College') hidden @endif>
                                    <label for="faculty">Faculty</label>
                                    <input type="text" id="faculty" name="faculty" class="form-control" value="{{$data->faculty}}" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="subjectname">Subject name</label>
                                    <input type="text" id="subjectname" name="subjectname" class="form-control" value="{{$data->subjectname}}" required readonly/>
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
                        <form action="{{route('examevaluation.submit')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="add_timetable_table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Roll No.</th>
                                            <th>Out of marks</th>
                                            <th>Obtained marks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($studentlist as $student)
                                            <tr>
                                                <td hidden>
                                                    <input type="text" id="studentid" name="studentid[]" class="form-control" value="{{$student->userid}}" required/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="examtype" name="examtype[]" class="form-control" value="{{$data->examtype}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="classname" name="classname[]" class="form-control" value="{{$data->classname}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="division" name="division[]" class="form-control" value="{{$data->division}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="faculty" name="faculty[]" class="form-control" value="{{$data->faculty}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td hidden>
                                                    <input type="text" id="subjectname" name="subjectname[]" class="form-control" value="{{$data->subjectname}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <input type="text" id="" name="" class="form-control" value="{{$student->lname.' '.$student->fname.' '.$student->mname}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <input type="text" id="" name="" class="form-control" value="{{$student->roll_no}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <input type="text" id="outofmarks" name="outofmarks[]" class="form-control" value="{{$exam->outofmarks}}" tabindex="-1" required readonly/>
                                                </td>
                                                <td>
                                                    <input type="number" id="obtainedmarks" name="obtainedmarks[]" min="0" max="{{$exam->outofmarks}}" class="form-control" />
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
