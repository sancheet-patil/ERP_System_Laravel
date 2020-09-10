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
                <li class="active">Exam</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Class Exam Search</h3>
                        </div>
                        <form method="post" action="{{route('exam')}}">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-3">
                                    <label for="examtype">Exam type</label><small class="req"> *</small>
                                    <select id="examtype" name="examtype" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $examtypelist = \App\ExamTypeList::orderBy('examtype','asc')->get();
                                        ?>
                                        @foreach($examtypelist as $exam)
                                            <option value="{{$exam->examtype}}" @if($exam->examtype == $examtype) selected @endif>{{$exam->examtype}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                <div class="form-group col-md-3" id="facultydiv" style="display: none;">
                                    <label for="faculty">Faculty</label><small class="req"> *</small>
                                    <select id="faculty" name="faculty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Commerce">Commerce</option>
                                        <option value="Science">Science</option>
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
                <div class="col-md-12" id="exam_list_div">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-list"></i> Exam list</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="examlist_table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Type</th>
                                        <th>Classname</th>
                                        <th>Subject name</th>
                                        <th>Passing marks</th>
                                        <th>Out of marks</th>
                                        <th>Evaluate students</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($examlist))
                                        <?php $srno=1; ?>
                                        @foreach($examlist as $exam)
{{--                                            @if($check)--}}
                                                <tr>
                                                    <td>{{$srno++}}</td>
                                                    <td>{{$exam->examtype}}</td>
                                                    <td>{{$exam->classname}}</td>
                                                    <td>
                                                        <?php
                                                        $subjectname = \App\SubjectLists::where('id',$exam->subjectname)->value('subjectname');
                                                        ?>
                                                        {{$subjectname}}
                                                    </td>
                                                    <td>{{$exam->passingmarks}}</td>
                                                    <td>{{$exam->outofmarks}}</td>
                                                    <td>
                                                        <?php
                                                        $divisions = \App\ClassLists::where('classname',$exam->classname)->value('division');
                                                        $divisions = explode(',',$divisions);
                                                        ?>
                                                        @foreach($divisions as $division)
                                                            <?php
                                                            $divisioncheck = \App\ClassSubjectDetails::where('academicyear',\Illuminate\Support\Facades\Session::get('academicyear'))
                                                                ->where('classname',$exam->classname)->where('division',$division)
                                                                ->where('subjectname',$exam->subjectname)
                                                                ->where('teachername',\Illuminate\Support\Facades\Auth::user()->userid)
                                                                ->value('division');
                                                            ?>
                                                            <?php
                                                            $isevaluated = \App\ExamEvaluationDetails::where('academicyear',\Illuminate\Support\Facades\Session::get('academicyear'))
                                                                ->where('examtype',$exam->examtype)
                                                                ->where('classname',$exam->classname)->where('division',$division)
                                                                ->where('faculty',$exam->faculty)->where('subjectname',$exam->subjectname)->first();
                                                            ?>
                                                            @if($divisioncheck)
                                                                <a href="{{route('exam.evaluation',['examtype'=>$exam->examtype,'classname'=>$exam->classname,'division'=>$division,'faculty'=>$exam->faculty,'subjectname'=>$exam->subjectname])}}" class="btn @if($isevaluated) btn-success @else btn-warning @endif btn-sm" title="Submit marks">Div {{$division}}</a>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
{{--                                            @endif--}}
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
    $(document).ready(function(){
        $('#examlist_table').DataTable({
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

    $('#classname').change(function(){
        var classname = $(this).val();
        if(classname > '10') {
            document.getElementById("facultydiv").style.display = "block";
            $('#faculty').prop('required',true);
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
            $('#faculty').removeAttr('required');
        }
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
