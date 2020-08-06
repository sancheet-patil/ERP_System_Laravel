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
                            <h3 class="box-title"><i class="fa fa-search"></i> Search LC report</h3>
                        </div>
                        <form method="post" action="{{route('lcissuereport.post')}}">
                            <div class="box-body">
                                <div class="form-group col-md-3">
                                    <label for="academicyear">Academic year</label>
                                    <select id="academicyear" name="academicyear" class="form-control select2">
                                        <option value="">Select</option>
                                        <?php
                                        $academicyears = \App\AcademicYearList::orderBy('academicyear','desc')->get();
                                        ?>
                                        @foreach($academicyears as $academicyear1)
                                            <option value="{{$academicyear1->academicyear}}" @if($academicyear1->academicyear == $academicyear) selected @endif>{{$academicyear1->academicyear}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="registerfor">Register for</label>
                                    <select id="registerfor" name="registerfor" class="form-control select2" >
                                        <option value="">Select</option>
                                        <option value="School" @if('School' == $registerfor) selected @endif>School</option>
                                        <option value="College" @if('College' == $registerfor) selected @endif>College</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="classname">Class</label>
                                    <select id="classname" name="classname" class="form-control select2" >
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
                                <div class="form-group col-md-3" id="facultydiv" style="display: none;">
                                    <label for="faculty">Faculty</label>
                                    <select id="faculty" name="faculty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Arts" @if('Arts' == $division) selected @endif>Arts</option>
                                        <option value="Commerce" @if('Commerce' == $division) selected @endif>Commerce</option>
                                        <option value="Science" @if('Science' == $division) selected @endif>Science</option>
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
                            <h3 class="box-title"><i class="fa fa-search"></i> LC issue report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Register No.</th>
                                        <th>Saral ID</th>
                                        <th>Student name</th>
                                        <th>Date of Birth</th>
                                        <th>Class (Division)</th>
                                        <th>Issue date</th>
                                        <th>Progress</th>
                                        <th>Leaving date</th>
                                        <th>Reason</th>
                                        <th>Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $male = 0;
                                    $female = 0;
                                    $srno = 1;
                                    ?>
                                    @foreach($lclist as $student)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$student->registerno}}</td>
                                            <td>{{$student->saralid}}</td>
                                            <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                            <td>{{$student->dob}}</td>
                                            <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                            <td>{{$student->issuedate}}</td>
                                            <td>{{$student->progress}}</td>
                                            <td>{{$student->dateofleaving}}</td>
                                            <td>{{$student->reasonofleaving}}</td>
                                            <td>{{$student->remarks}}</td>
                                        </tr>
                                        <?php
                                        if($student->gender == 'Male'){
                                            $male++;
                                        }
                                        else if($student->gender == 'Female'){
                                            $female++;
                                        }
                                        $srno++;
                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="alert alert-danger">
                                Total Students: <b><?php echo $male+$female; ?></b><br>
                                Total Male: <b><?php echo $male ?></b><br>
                                Total Female: <b><?php echo $female; ?></b>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if($lclist != '[]')
                                <a href="{{url('lcissuereportexcel')}}?academicyear={{$academicyear}}&registerfor={{$registerfor}}&classname={{$classname}}&faculty={{$faculty}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
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
        if(classname > '10') {
            document.getElementById("facultydiv").style.display = "block";
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
        }
    });
    $('#registerfor').change(function () {
        var registerfor = $('#registerfor').val();
        if(registerfor === 'College') {
            document.getElementById("facultydiv").style.display = "block";
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
        }
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
