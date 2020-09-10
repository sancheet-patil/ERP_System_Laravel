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
                <li class="active">Scholarship Report report</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Scholarship Report</h3>
                        </div>
                        <form method="post" action="{{route('studentscholarshipreport.post')}}">
                            <div class="box-body">
                                <div class="form-group col-md-3">
                                    <label for="academicyear">Academic year</label><i class="small">*</i>
                                    <select id="academicyear" name="academicyear" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $academicyears = \App\AcademicYearList::orderBy('academicyear','desc')->get();
                                        ?>
                                        @foreach($academicyears as $academicyear1)
                                            <option value="{{$academicyear1->academicyear}}" @if(isset($academicyear))) @if($academicyear1->academicyear == $academicyear) selected @endif @endif>{{$academicyear1->academicyear}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="scholarshipname">Scholarship name</label><i class="small">*</i>
                                    <select id="scholarshipname" name="scholarshipname" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $scholarshiplist = \App\ScholarshipLists::orderBy('scholarshipname','asc')->get();
                                        ?>
                                        @foreach($scholarshiplist as $scholarship)
                                            <option value="{{$scholarship->id}}" @if(isset($scholarshipname)) @if($scholarship->id == $scholarshipname) selected @endif @endif>{{$scholarship->scholarshipname}}</option>
                                        @endforeach
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
                                            <option value="{{$class->classname}}" @if(isset($classname)) @if($class->classname == $classname) selected @endif @endif>{{$class->classname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="division">Division</label>
                                    <select id="division" name="division" class="form-control select2">
                                        @if(isset($divisionlist))
                                            <option value="">Select</option>
                                            @foreach($divisionlist as $division1)
                                                <option value="{{$division1}}" @if(isset($division)) @if($division1 == $division) selected @endif @endif>{{$division1}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3" id="facultydiv" style="display: none;">
                                    <label for="faculty">Faculty</label>
                                    <select id="faculty" name="faculty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Arts" @if(isset($faculty)) @if('Arts' == $faculty) selected @endif @endif>Arts</option>
                                        <option value="Commerce" @if(isset($faculty)) @if('Commerce' == $faculty) selected @endif @endif>Commerce</option>
                                        <option value="Science" @if(isset($faculty)) @if('Science' == $faculty) selected @endif @endif>Science</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="form-control select2" >
                                        <option value="">Select</option>
                                        <option value="Male" @if(isset($gender)) @if('Male' == $gender) selected @endif @endif>Male</option>
                                        <option value="Female" @if(isset($gender)) @if('Female' == $gender) selected @endif @endif>Female</option>
                                        <option value="Other" @if(isset($gender)) @if('Other' == $gender) selected @endif @endif>Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="category">Category</label>
                                    <select id="category" name="category" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $categories = \App\CategoryLists::orderBy('category','asc')->get();
                                        ?>
                                        @foreach($categories as $category1)
                                            <option value="{{$category1->id}}" @if(isset($category)) @if($category1->id == $category) selected @endif @endif>{{$category1->category}}</option>
                                        @endforeach
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
                            <h3 class="box-title"><i class="fa fa-search"></i> Scholarship report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Reg. No.</th>
                                        <th>Student Name</th>
                                        <th>Class (Division)</th>
                                        <th>Scholarship Name</th>
                                        <th>Scholarship per month</th>
                                        <th>Scholarship no of month</th>
                                        <th>Total Scholarship</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $male = 0;
                                    $female = 0;
                                    $srno = 1;
                                    ?>
                                    @if(isset($studentlist))
                                        @foreach($studentlist as $student)
                                            <tr>
                                                <td>{{$srno}}</td>
                                                <td>{{$student->registerno}}</td>
                                                <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                                <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                                <td>{{$student->scholarshipname}}</td>
                                                <td>{{$student->scholarshipamount}}</td>
                                                <td>{{$student->noofmonths}}</td>
                                                <td>{{$student->scholarshipamount * $student->noofmonths}}</td>
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
                                    @endif
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
                            @if(isset($studentlist))
                                <a href="{{route('studentscholarshipreportexcel')}}?academicyear={{$academicyear}}&scholarshipname={{$scholarshipname}}&classname={{$classname}}&division={{$division}}&faculty={{$faculty}}&gender={{$gender}}&category={{$category}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
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
