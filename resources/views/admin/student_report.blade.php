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
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Students</h3>
                        </div>
                        <form method="post" action="{{route('studentreport.post')}}">
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
                                        <option value="School Form 17" @if('School Form 17' == $registerfor) selected @endif>School Form 17</option>
                                        <option value="College Form 17" @if('College Form 17' == $registerfor) selected @endif>College Form 17</option>
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
                                <div class="form-group col-md-3">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="form-control select2" >
                                        <option value="">Select</option>
                                        <option value="Male" @if('Male' == $gender) selected @endif>Male</option>
                                        <option value="Female" @if('Female' == $gender) selected @endif>Female</option>
                                        <option value="Other" @if('Other' == $gender) selected @endif>Other</option>
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
                                            <option value="{{$category1->id}}" @if($category1->id == $category) selected @endif>{{$category1->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="religion">Religion</label>
                                    <select id="religion" name="religion" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $religions = \App\ReligionLists::orderBy('religion','asc')->get();
                                        ?>
                                        @foreach($religions as $religion1)
                                            <option value="{{$religion1->id}}" @if($religion1->id == $religion) selected @endif>{{$religion1->religion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="castename">Caste</label>
                                    <select id="castename" name="castename" class="form-control select2" >
                                        <option value="">Select</option>
                                        @if(isset($castelist))
                                            @foreach($castelist as $caste1)
                                                <option value="{{$caste1->castename}}" @if($caste1->castename == $castename) selected @endif>{{$caste1->castename}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="subcaste">Sub Caste</label>
                                    <select id="subcaste" name="subcaste" class="form-control select2" >
                                        <option value="">Select</option>
                                        @if(isset($subcastelist))
                                            @foreach($subcastelist as $subcaste1)
                                                <option value="{{$subcaste1->id}}" @if($subcaste1->id == $subcaste) selected @endif>{{$subcaste1->subcaste}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="fname">First name</label>
                                    <input type="text" id="fname" name="fname" class="form-control" value="{{$fname}}"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="mname">Middle name</label>
                                    <input type="text" id="mname" name="mname" class="form-control" value="{{$mname}}"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="lname">Last name</label>
                                    <input type="text" id="lname" name="lname" class="form-control" value="{{$lname}}"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ispwd">Person with Disability</label>
                                    <select id="ispwd" name="ispwd" class="form-control select2">
                                        <option value="">Select</option>
                                        <option value="Yes" @if($ispwd == 'Yes') selected @endif>Yes</option>
                                        <option value="No" @if($ispwd == 'No') selected @endif>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="isminor">Minority</label>
                                    <select id="isminor" name="isminor" class="form-control select2">
                                        <option value="">Select</option>
                                        <option value="Yes" @if($isminor == 'Yes') selected @endif>Yes</option>
                                        <option value="No" @if($isminor == 'No') selected @endif>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="isbpl">Below Poverty Level</label>
                                    <select id="isbpl" name="isbpl" class="form-control select2">
                                        <option value="">Select</option>
                                        <option value="Yes" @if($isbpl == 'Yes') selected @endif>Yes</option>
                                        <option value="No" @if($isbpl == 'No') selected @endif>No</option>
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
                            <h3 class="box-title"><i class="fa fa-search"></i> Students report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Register no.</th>
                                        <th>Academic year</th>
                                        <th>Admission date</th>
                                        <th>Saral ID</th>
                                        <th>Class</th>
                                        <th>Roll No.</th>
                                        <th>Student name</th>
                                        <th>Gender</th>
					<th>Date of Birth</th>
					<th>Religion</th>
                                        <th>Category</th>
                                        <th>Caste</th>
                                        <th>Subcaste</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>AADHAR</th>
                                        <th>Place of birth</th>
                                        <th>Mothertongue</th>
                                        <th>Blood group</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $male = 0;
                                        $female = 0;
                                        $srno = 1;
                                    ?>
                                    @foreach($studentlist as $student)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$student->registerno}}</td>
                                            <td>{{$student->academicyear}}</td>
                                            <td>{{$student->admission_date}}</td>
                                            <td>{{$student->saralid}}</td>
                                            <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                            <td>{{$student->roll_no}}</td>
                                            <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                            <td>{{$student->gender}}</td>
                                            <td>{{$student->dob}}</td>
				             <?php
						$castecategory = \App\CasteCategoryList::where('id',$student->subcaste)->first();
						
						if($castecategory!=null)
						{
                                           		 $religion = \App\ReligionLists::where('id',$castecategory['religion'])->value('religion');
                                           		 $category = \App\CategoryLists::where('id',$castecategory['category'])->value('category');
						}
						else
						{
							$castecategory['castename']='-';
							$castecategory['subcaste']='-';
							$category='-';
							$religion='-';
						}
					    ?>
					    <td>{{$religion}}</td>
                                            <td>{{$category}}</td>
                                            <td>{{$castecategory['castename']}}</td>
                                            <td>{{$castecategory['subcaste']}}</td>
                                            <td>{{$student->mobile}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->aadhar}}</td>
                                            <td>{{$student->placeob}}</td>
                                            <td>{{$student->mothertongue}}</td>
                                            <td>{{$student->bloodgroup}}</td>
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
                                    <?php

                                    ?>
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
                            @if($studentlist != '[]')
                                <span class="pull-right">
                                    <a href="{{url('studentcustomreportexcel')}}?academicyear={{$academicyear}}&registerfor={{$registerfor}}&classname={{$classname}}&faculty={{$faculty}}&division={{$division}}&gender={{$gender}}&category={{$category}}&religion={{$religion}}&castename={{$castename}}&subcaste={{$subcaste}}&fname={{$fname}}&mname={{$mname}}&lname={{$lname}}&ispwd={{$ispwd}}&isminor={{$isminor}}&isbpl={{$isbpl}}" class="btn btn-primary"><i class="fa fa-print"></i> Custom Report Print</a>
                                    <a href="{{url('studentreportexcel')}}?academicyear={{$academicyear}}&registerfor={{$registerfor}}&classname={{$classname}}&faculty={{$faculty}}&division={{$division}}&gender={{$gender}}&category={{$category}}&religion={{$religion}}&castename={{$castename}}&subcaste={{$subcaste}}&fname={{$fname}}&mname={{$mname}}&lname={{$lname}}&ispwd={{$ispwd}}&isminor={{$isminor}}&isbpl={{$isbpl}}" class="btn btn-primary"><i class="fa fa-print"></i> Report Print</a>
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

    $('#religion').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/castelist')}}?religion="+$('#religion').val(),
            beforeSend: function () {
                $("#castename").empty().append('<option value="">Select</option>');
            },
            success: function (data) {
                if (data) {
                    for(var i=0;i<data.length;i++){
                        $("#castename").append('<option value="'+data[i].castename+'">'+data[i].castename+'</option>');
                    }
                }
            }
        });
    });

    $('#castename').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/subcastelist')}}?religion="+$('#religion').val()+"&castename="+$('#castename').val(),
            beforeSend: function () {
                $("#subcaste").empty().append('<option value="">Select</option>');
            },
            success: function (data) {
                if (data) {
                    for(var i=0;i<data.length;i++){
                        $("#subcaste").append('<option value="'+data[i].id+'">'+data[i].subcaste+'</option>');
                    }
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
