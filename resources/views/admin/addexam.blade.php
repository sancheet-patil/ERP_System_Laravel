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
                <li class="active">Add Exam</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Exam</h3>
                        </div>
                        <form method="post" action="{{route('addexam')}}">
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
                                        $examlist = \App\ExamTypeList::orderBy('examtype','asc')->get();
                                        ?>
                                        @foreach($examlist as $exam)
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
                                <div class="form-group col-md-3" @if(\Illuminate\Support\Facades\Session::get('registerfor') != 'College') hidden @endif>
                                    <label for="faculty">Faculty</label>
                                    <select id="faculty" name="faculty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Arts" @if('Arts' == $faculty) selected @endif>Arts</option>
                                        <option value="Commerce" @if('Commerce' == $faculty) selected @endif>Commerce</option>
                                        <option value="Science" @if('Science' == $faculty) selected @endif>Science</option>
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
                <div class="col-md-12" id="exam_list_div" @if($classname == '') hidden @endif>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-list"></i> Exam schedule</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{route('exam.create')}}" id="set_examschedule_form">
                                    <span id="result"></span>
                                    <table class="table table-bordered table-striped" id="examschedule_table">
                                        <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Passing marks</th>
                                            <th>Out of marks</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($examschedulelist))
                                                @foreach($examschedulelist as $exam)
                                                    <tr>

                                                        <td hidden><input type="text" name="examtype[]" class="form-control" value="{{$exam->examtype}}"/></td>
                                                        <td hidden><input type="text" name="classname[]" class="form-control" value="{{$exam->classname}}"/></td>
                                                        <td hidden><input type="text" name="faculty[]" class="form-control" value="{{$exam->faculty}}"/></td>
                                                        <td hidden><input type="text" id="subjectname" name="subjectname[]" class="form-control" value="{{$exam->subjectname}}" required/></td>
                                                        <?php
                                                        $subjectname = \App\SubjectLists::where('id',$exam->subjectname)->value('subjectname');
                                                        ?>
                                                        <td><input type="text" class="form-control" value="{{$subjectname}}" required readonly/></td>
                                                        <td><input type="number" min="1" id="passingmarks" name="passingmarks[]" value="{{$exam->passingmarks}}" class="form-control" required readonly/></td>
                                                        <td><input type="number" min="1" id="outofmarks" name="outofmarks[]" class="form-control" value="{{$exam->outofmarks}}" required readonly/></td>
                                                        <td><button type="button" id="removesubject" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot id="table_footer">
                                        <tr>
                                            <td colspan="3" align="right"><button type="button" name="add" id="addsubject" class="btn btn-success" >Add subject</button></td>
                                            <td>
                                                @csrf
                                                <input type="submit" id="savesubject" class="btn btn-primary" value="Save List" />
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>
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
    var count = 1;

    function dynamic_field(number) {
        html = '<tr>';
        html += '<td hidden><input type="text" name="examtype[]" class="form-control" value="<?php echo $examtype; ?>"/></td>';
        html += '<td hidden><input type="text" name="classname[]" class="form-control" value="<?php echo $classname; ?>"/></td>';
        html += '<td hidden><input type="text" name="faculty[]" class="form-control" value="<?php echo $faculty; ?>"/></td>';
        html += '<td><select id="subjectname" name="subjectname[]" class="form-control" required><option value="">Select</option>';
        html += '<?php if(isset($subjectlist)) { foreach($subjectlist as $subject){?>';
        html += '<?php echo '<option value="' . $subject->id . '">' . $subject->subjectname . '</option>'; ?>';
        html += '<?php } } ?>';
        html += '</select></td>';
        html += '<td><input type="number" min="1" id="passingmarks" name="passingmarks[]" class="form-control" required/></td>';
        html += '<td><input type="number" min="1" id="outofmarks" name="outofmarks[]" class="form-control" required/></td>';
        html += '<td><button type="button" id="removesubject" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
        $('tbody').append(html);
    }

    $(document).on('click', '#addsubject', function(){
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '#removesubject', function(){
        count--;
        $(this).closest("tr").remove();
    });

    $(document).on('focus', '.mydatepicker', function(){
        $(this).datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
    $(document).on('focus', '.mytimepicker', function(){
        $(this).timepicker({
            showInputs: false,
            showMeridian: false,
            minuteStep: 5,
        });
    });

    function onstartclose(id) {
        $('#starttime'+id).timepicker("hideWidget");
    }

    function onendclose(id) {
        $('#endtime'+id).timepicker("hideWidget");
    }

    $(document).ready(function(){
        dynamic_field(count);
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

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
