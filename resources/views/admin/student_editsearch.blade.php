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
                <li><a href="{{route('student.search')}}"> Student Search</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border bg-gray-light">
                            <h3 class="box-title">Student Information</h3>
                        </div>
                        <form action="{{route('student.editsearch.edit')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="box box-default">
                                    <div class="box-header with-border bg-gray-light">
                                        <h3 class="box-title">Student Details</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-3" hidden>
                                            <label for="userid">User ID</label> <small class="req"> *</small>
                                            <input type="text" id="userid" name="userid" class="form-control" value="{{$studentdetails->userid}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="admission_year">Admission year</label> <small class="req"> *</small>
                                            <input type="text" id="admission_year" name="admission_year" class="form-control" value="{{$studentdetails->admission_year}}" required readonly/>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="registerfor">Register for</label> <small class="req"> *</small>
                                            <select id="registerfor" name="registerfor" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="School" @if('School' == $studentdetails->registerfor) selected @endif>School</option>
                                                <option value="College" @if('College' == $studentdetails->registerfor) selected @endif>College</option>
                                                <option value="School Form 17" @if('School Form 17' == $studentdetails->registerfor) selected @endif>School Form 17</option>
                                                <option value="College Form 17" @if('College Form 17' == $studentdetails->registerfor) selected @endif>College Form 17</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="facultydiv" style="@if(!$studentdetails->faculty) display:none; @endif">
                                            <label for="faculty">Faculty</label> <small class="req"> *</small>
                                            <select id="faculty" name="faculty" class="form-control" >
                                                <option value="">Select</option>
                                                <option value="Arts" @if('Arts' == $studentdetails->faculty) selected @endif>Arts</option>
                                                <option value="Commerce" @if('Commerce' == $studentdetails->faculty) selected @endif>Commerce</option>
                                                <option value="Science" @if('Science' == $studentdetails->faculty) selected @endif>Science</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="admission_class">Admission Class</label><small class="req"> *</small>
                                            <input type="text" id="admission_class" name="admission_class" class="form-control" value="{{$studentdetails->admission_class}}" required readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="division">Division</label>
                                            <select id="division" name="division" class="form-control select2">
                                                @if(isset($divisionlist))
                                                    <option value="">Select</option>
                                                    @foreach($divisionlist as $division)
                                                        <option value="{{$division}}" @if($division == $studentdetails->division) selected @endif>{{$division}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="registerno">Register No.</label> <small class="req"> *</small>
                                            <input type="text" id="registerno" name="registerno" class="form-control" value="{{$studentdetails->registerno}}" required readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="saralid">Saral ID</label>
                                            <input type="text" id="saralid" name="saralid" class="form-control" value="{{$studentdetails->saralid}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="aadhar">AADHAR</label> <small class="req"> *</small>
                                            <input type="number" id="aadhar" name="aadhar" class="form-control" value="{{$studentdetails->aadhar}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname">Last name</label> <small class="req"> *</small>
                                            <input type="text" id="lname" name="lname" class="form-control" value="{{$studentdetails->lname}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="fname">First name</label> <small class="req"> *</small>
                                            <input type="text" id="fname" name="fname" class="form-control" value="{{$studentdetails->fname}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mname">Middle name</label>
                                            <input type="text" id="mname" name="mname" class="form-control" value="{{$studentdetails->mname}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label> <small class="req"> *</small>
                                            <select id="gender" name="gender" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Male" @if('Male' == $studentdetails->gender) selected @endif>Male</option>
                                                <option value="Female" @if('Female' == $studentdetails->gender) selected @endif>Female</option>
                                                <option value="Other" @if('Other' == $studentdetails->gender) selected @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothertongue">Mother tongue</label> <small class="req"> *</small>
                                            <input type="text" id="mothertongue" name="mothertongue" value="{{$studentdetails->mothertongue}}" class="form-control" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion</label>
                                            <select id="religion" name="religion" class="form-control select2" >
                                                <option value="">Select</option>
                                                <?php
                                                $religions = \App\ReligionLists::orderBy('religion','asc')->get();
                                                ?>
                                                @foreach($religions as $religion)
                                                    <option value="{{$religion->id}}" @if($religion->id == $studentdetails->religion) selected @endif>{{$religion->religion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="castename">Caste</label><small class="req"> *</small>
                                            <select id="castename" name="castename" class="form-control select2" required>
                                                <option value="">Select</option>
                                                @foreach($castelist as $caste)
                                                    <option value="{{$caste->castename}}" @if($caste->castename == $studentdetails->castename) selected @endif>{{$caste->castename}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="subcaste">Sub Caste</label><small class="req"> *</small>
                                            <select id="subcaste" name="subcaste" class="form-control select2" required>
                                                <option value="">Select</option>
                                                @foreach($subcastelist as $subcaste)
                                                    <option value="{{$subcaste->id}}" @if($subcaste->id == $studentdetails->subcaste) selected @endif>{{$subcaste->subcaste}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="category">Category</label> <small class="req"> *</small>
                                            <?php
                                                $category = \App\CategoryLists::where('id',$studentdetails->category)->value('category');
                                            ?>
                                            <input type="text" id="category" name="category" class="form-control" required value="{{$category}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="placeob">Place of birth</label> <small class="req"> *</small>
                                            <input type="text" id="placeob" name="placeob" class="form-control" value="{{$studentdetails->placeob}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dob">Date of Birth</label> <small class="req"> *</small>
                                            <input type="text" id="dob" name="dob" class="form-control" value="{{$studentdetails->dob}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lastclass">Last attended class</label> <small class="req"> *</small>
                                            <input type="text" id="lastclass" name="lastclass" class="form-control" required value="{{$studentdetails->lastclass}}"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="schoolname">Last attended school</label> <small class="req"> *</small>
                                            <select id="schoolname" name="schoolname" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <?php
                                                $schools = \App\OtherSchoolLists::orderBy('schoolname','asc')->get();
                                                ?>
                                                @foreach($schools as $school)
                                                    <option value="{{$school->id}}" @if($school->id == $studentdetails->schoolname) selected @endif>{{$school->schoolname}}</option>
                                                @endforeach
                                                <option value="Other" @if('Other' == $studentdetails->schoolname) selected @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="lastschooldiv" style="@if('Other' != $studentdetails->schoolname) display: none; @endif">
                                            <label for="lastschool">Name of school/ college</label> <small class="req"> *</small>
                                            <input type="text" id="lastschool" name="lastschool" class="form-control" required value="{{$studentdetails->lastschool}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="previouslcno">Previous LC Number</label> <small class="req"> *</small>
                                            <input type="text" id="previouslcno" name="previouslcno" class="form-control" required value="{{$studentdetails->previouslcno}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="previousgrno">Previous Registration Number</label><small class="req"> *</small>
                                            <input type="text" id="previousgrno" name="previousgrno" class="form-control" required value="{{$studentdetails->previousgrno}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="admissiontype">Admission Type</label> <small class="req"> *</small>
                                            <select id="admissiontype" name="admissiontype" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Fresher" @if('Fresher' == $studentdetails->admissiontype) selected @endif>Fresher</option>
                                                <option value="Repeater" @if('Repeater' == $studentdetails->admissiontype) selected @endif>Repeater</option>
                                                <option value="One time failed" @if('One time failed' == $studentdetails->admissiontype) selected @endif>One time failed</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lateadmission">Late Admission</label> <small class="req"> *</small>
                                            <select id="lateadmission" name="lateadmission" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="No" @if('No' == $studentdetails->lateadmission) selected @endif>No</option>
                                                <option value="Yes" @if('Yes' == $studentdetails->lateadmission) selected @endif>Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hostelrequired">Hostel required</label> <small class="req"> *</small>
                                            <select id="hostelrequired" name="hostelrequired" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="No" @if('No' == $studentdetails->hostelrequired) selected @endif>No</option>
                                                <option value="Yes" @if('Yes' == $studentdetails->hostelrequired) selected @endif>Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" id="mobile" name="mobile" class="form-control" value="{{$studentdetails->mobile}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{$studentdetails->email}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="admission_date">Admission date</label> <small class="req"> *</small>
                                            <input type="text" id="admission_date" name="admission_date" class="form-control" value="{{$studentdetails->admission_date}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="roll_no">Roll Number</label>
                                            <input type="number" id="roll_no" name="roll_no" min="1" value="{{$studentdetails->roll_no}}" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ispwd">Person with Disability</label> <small class="req"> *</small>
                                            <select id="ispwd" name="ispwd" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Yes" @if($studentdetails->pwd != 'No') selected @endif>Yes</option>
                                                <option value="No" @if($studentdetails->pwd == 'No') selected @endif>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="pwddiv" style="@if($studentdetails->pwd == 'No') display: none; @endif">
                                            <label for="pwd">Name of Disability</label> <small class="req"> *</small>
                                            <input type="text" id="pwd" name="pwd" class="form-control" required value="{{$studentdetails->pwd}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bloodgroup">Blood group</label>
                                            <select id="bloodgroup" name="bloodgroup" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="A+" @if('A+' == $studentdetails->bloodgroup) selected @endif>A+</option>
                                                <option value="A-" @if('A-' == $studentdetails->bloodgroup) selected @endif>A-</option>
                                                <option value="B+" @if('B+' == $studentdetails->bloodgroup) selected @endif>B+</option>
                                                <option value="B-" @if('B-' == $studentdetails->bloodgroup) selected @endif>B-</option>
                                                <option value="AB+" @if('AB+' == $studentdetails->bloodgroup) selected @endif>AB+</option>
                                                <option value="AB-" @if('AB-' == $studentdetails->bloodgroup) selected @endif>AB-</option>
                                                <option value="O+" @if('O+' == $studentdetails->bloodgroup) selected @endif>O+</option>
                                                <option value="O-" @if('O-' == $studentdetails->bloodgroup) selected @endif>O-</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="citytype">City Type</label> <small class="req"> *</small>
                                            <select id="citytype" name="citytype" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Rural" @if('Rural' == $studentdetails->citytype) selected @endif>Rural</option>
                                                <option value="Urban" @if('Urban' == $studentdetails->citytype) selected @endif>Urban</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="familyincome">Family income (Annual)</label>
                                            <input type="number" id="familyincome" name="familyincome" min="1" placeholder="" class="form-control" value="{{$studentdetails->familyincome}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="isbpl">Below Poverty Level</label>
                                            <select id="isbpl" name="isbpl" class="form-control select2">
                                                <option value="">Select</option>
                                                <option value="Yes" @if($studentdetails->bpl != 'No') selected @endif>Yes</option>
                                                <option value="No" @if($studentdetails->bpl == 'No') selected @endif>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="bpldiv"style="@if($studentdetails->bpl == 'No') display: none; @endif">
                                            <label for="bpl">BPL number</label>
                                            <input type="text" id="bpl" name="bpl" class="form-control" value="No"/>
                                        </div>
                                        <script>
                                            $('#isbpl').change(function () {
                                                var isbpl = $('#isbpl').val();
                                                if(isbpl === 'Yes') {
                                                    $('#bpl').val("");
                                                    document.getElementById("bpldiv").style.display = "block";
                                                }
                                                else {
                                                    $('#bpl').val(isbpl);
                                                    document.getElementById("bpldiv").style.display = "none";
                                                }
                                            });
                                        </script>
                                        <div class="form-group col-md-3">
                                            <label for="isminor">Minority</label> <small class="req"> *</small>
                                            <select id="isminor" name="isminor" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Yes" @if('Yes' == $studentdetails->isminor) selected @endif>Yes</option>
                                                <option value="No" @if('No' == $studentdetails->isminor) selected @endif>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="imagephoto" @if(!$studentdetails->studentphoto) hidden @endif>
                                            <label for="studentphoto">Student Photo</label><br>
                                            <img id="studentphotopreview" src="{{$studentdetails->studentphoto}}" height="120px" width="100px" alt="Student Photo" onclick="studentphotomodify()"/><br>
                                            <span>Note: Upload only jpg,png files. Max photo size 20kb</span>
                                        </div>
                                        <div class="form-group col-md-3" id="inputphotofile" @if($studentdetails->studentphoto) hidden @endif>
                                            <label for="studentphoto">Student Photo</label>
                                            <input type="file" id="studentphoto" name="studentphoto" class="form-control no-border" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box box-default">
                                    <div class="box-header with-border bg-gray-light" data-widget="collapse">
                                        <h3 class="box-title">Parent/ Gaurdian Details</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-4">
                                            <label for="fathername">Father Name</label>
                                            <input type="text" id="fathername" name="fathername" class="form-control" value="{{$studentdetails->fathername}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fatherphone">Father Phone</label>
                                            <input type="number" id="fatherphone" name="fatherphone" class="form-control" value="{{$studentdetails->fatherphone}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fatheroccupation">Father Occupation</label>
                                            <input type="text" id="fatheroccupation" name="fatheroccupation" class="form-control" value="{{$studentdetails->fatheroccupation}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mothername">Mother Name</label>
                                            <input type="text" id="mothername" name="mothername" class="form-control" value="{{$studentdetails->mothername}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="motherphone">Mother Phone</label>
                                            <input type="number" id="motherphone" name="motherphone" class="form-control" value="{{$studentdetails->motherphone}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="motheroccupation">Mother Occupation</label>
                                            <input type="text" id="motheroccupation" name="motheroccupation" class="form-control" value="{{$studentdetails->motheroccupation}}"/>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="guardianis">Guardian is</label><small class="req"> *</small>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Father" required @if('Father' == $studentdetails->guardianrelation) checked @endif>Father</label>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Mother" required @if('Mother' == $studentdetails->guardianrelation) checked @endif>Mother</label>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Other" required @if('Other' == $studentdetails->guardianrelation) checked @endif>Other</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianname">Guardian Name</label><small class="req"> *</small>
                                            <input type="text" id="guardianname" name="guardianname" class="form-control" value="{{$studentdetails->guardianname}}" required/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianphone">Guardian Phone</label><small class="req"> *</small>
                                            <input type="number" id="guardianphone" name="guardianphone" class="form-control" value="{{$studentdetails->guardianphone}}" required/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianrelation">Guardian Relation</label><small class="req"> *</small>
                                            <input type="text" id="guardianrelation" name="guardianrelation" class="form-control" value="{{$studentdetails->guardianrelation}}" required/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="guardianoccupation">Guardian Occupation</label><small class="req"> *</small>
                                            <input type="text" id="guardianoccupation" name="guardianoccupation" class="form-control" value="{{$studentdetails->guardianoccupation}}" required/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="guardianaddress">Guardian Address</label><small class="req"> *</small>
                                            <input type="text" id="guardianaddress" name="guardianaddress" class="form-control" value="{{$studentdetails->guardianaddress}}" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border bg-gray-light" data-widget="collapse">
                                        <h3 class="box-title">Student Address Details</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="autofill_current_address" @if($studentdetails->guardianaddress == $studentdetails->currentaddress) checked @endif onclick="auto_fill_guardian_address()">
                                                    If Guardian Address is Current Address
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="currentaddress">Current Address</label>
                                                <input type="text" id="currentaddress" name="currentaddress" value="{{$studentdetails->currentaddress}}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="autofill_permanent_address" @if($studentdetails->currentaddress == $studentdetails->permanentaddress) checked @endif onclick="auto_fill_permanent_address()">
                                                    If Current Address is Permanent Address
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="permanentaddress">Permanent Address</label>
                                                <input type="text" id="permanentaddress" name="permanentaddress" value="{{$studentdetails->permanentaddress}}" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border bg-gray-light" data-widget="collapse">
                                        <h3 class="box-title">Bank Account Details</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-4">
                                            <label for="accounttitle">Account Title</label>
                                            <input type="text" id="accounttitle" name="accounttitle" class="form-control" value="{{$studentdetails->accounttitle}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="accountno">Account No.</label>
                                            <input type="number" id="accountno" name="accountno" class="form-control" value="{{$studentdetails->accountno}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankifsccode">IFSC code</label>
                                            <input type="text" id="bankifsccode" name="bankifsccode" class="form-control" value="{{$studentdetails->bankifsccode}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankname">Bank Name</label>
                                            <input type="text" id="bankname" name="bankname" class="form-control" value="{{$studentdetails->bankname}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankbranchname">Branch Name</label>
                                            <input type="text" id="bankbranchname" name="bankbranchname" class="form-control" value="{{$studentdetails->bankbranchname}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankmicrcode">Bank MICR code</label>
                                            <input type="text" id="bankmicrcode" name="bankmicrcode" class="form-control" value="{{$studentdetails->bankmicrcode}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border bg-gray-light" data-widget="collapse">
                                        <h3 class="box-title">Upload Documents</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Title</th>
                                                    <th>Documents</th>
                                                    <th>View File</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td><input type="text" name="document1" class="form-control" value="{{$studentdetails->document1name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document1file" id="document1file" >
                                                    </td>
                                                    <td>
                                                        @if($studentdetails->document1file)
                                                            <a id="document1view" href="{{$studentdetails->document1file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><input type="text" name="document2" class="form-control" value="{{$studentdetails->document2name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document2file" id="document2file" >
                                                    </td>
                                                    <td>
                                                        @if($studentdetails->document2file)
                                                            <a href="{{$studentdetails->document2file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td><input type="text" name="document3" class="form-control" value="{{$studentdetails->document3name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document3file" id="document3file" >
                                                    </td>
                                                    <td>
                                                        @if($studentdetails->document3file)
                                                            <a href="{{$studentdetails->document3file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Title</th>
                                                    <th>Documents</th>
                                                    <th>View File</th>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td><input type="text" name="document4" class="form-control" value="{{$studentdetails->document4name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document4file" id="document4file" >
                                                    </td>
                                                    <td>
                                                        @if($studentdetails->document4file)
                                                            <a href="{{$studentdetails->document4file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td><input type="text" name="document5" class="form-control" value="{{$studentdetails->document5name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document5file" id="document5file" >
                                                    </td>
                                                    <td>
                                                        @if($studentdetails->document5file)
                                                            <a href="{{$studentdetails->document5file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td><input type="text" name="document6" class="form-control" value="{{$studentdetails->document6name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document6file" id="document6file" >
                                                    </td>
                                                    <td>
                                                        @if($studentdetails->document6file)
                                                            <a href="{{$studentdetails->document6file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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

<script>
    $(function () {
        $('#admission_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $('#dob').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    $('#registerfor').change(function () {
        var registerfor = $('#registerfor').val();
        if(registerfor === 'College' || registerfor === 'College Form 17') {
            $('#faculty').val("").prop('required',true);
            document.getElementById("facultydiv").style.display = "block";
        }
        else {
            $('#faculty').val("NA").prop('required',false);
            document.getElementById("facultydiv").style.display = "none";
        }

        $.ajax({
            type:"get",
            url:"{{url('getnextregisterno')}}?registerfor=" + registerfor,
            beforeSend:function(){
            },
            success:function(data){
                $('#registerno').val(data);
            }
        });
    });

    $('#registerno').change(function () {
        var registerfor = $('#registerfor').val();
        var registerno = $('#registerno').val();
        $.ajax({
            type:"get",
            url:"{{url('validateregisterno')}}?registerfor=" + registerfor + "&registerno=" + registerno,
            beforeSend:function(){
            },
            success:function(data){
                if(data === 'True'){
                    alert('Register number already exists');
                    $('#registerno').val("").focus();
                }
            }
        });
    });

    $('#admission_class').change(function(){
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

    $('#aadhar').change(function(){
        $.ajax({
            type: "GET",
            url: "{{url('/validateaadhar')}}?aadhar="+$('#aadhar').val(),
            beforeSend: function () {
            },
            success: function (data) {
                if (data === 'True') {
                    alert('AADHAR already exists');
                    $('#aadhar').val('').focus()
                }
            }
        });
    }).keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 11) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });

    $('#mname').change(function () {
        $('#fathername').val($('#mname').val());
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
                $("#subcaste").empty().append('<option>Select</option>');
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

    $('#subcaste').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/subcastedetails')}}?subcaste="+$('#subcaste').val(),
            beforeSend: function () {
                $("#category").val('');
            },
            success: function (data) {
                $("#category").val(data);
            }
        });
    });

    $('#schoolname').change(function () {
        var schoolname = $('#schoolname').val();
        if(schoolname === 'Other') {
            $('#lastschool').val("");
            document.getElementById("lastschooldiv").style.display = "block";
        }
        else {
            $('#lastschool').val(schoolname);
            document.getElementById("lastschooldiv").style.display = "none";
        }
    });

    $('#ispwd').change(function () {
        var ispwd = $('#ispwd').val();
        if(ispwd === 'Yes') {
            $('#pwd').val("");
            document.getElementById("pwddiv").style.display = "block";
        }
        else {
            $('#pwd').val(ispwd);
            document.getElementById("pwddiv").style.display = "none";
        }
    });

    $('#mobile').change(function () {
        $('#fatherphone').val($('#mobile').val());
    });

    $('#fatherphone').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });

    $('#motherphone').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });

    $('#guardianphone').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });

    $('input:radio[name="guardianis"]').change(function () {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            if (value === "Father") {
                $('#guardianname').val($('#fathername').val());
                $('#guardianphone').val($('#fatherphone').val());
                $('#guardianoccupation').val($('#fatheroccupation').val());
                $('#guardianrelation').val(value)
            } else if (value === "Mother") {
                $('#guardianname').val($('#mothername').val());
                $('#guardianphone').val($('#motherphone').val());
                $('#guardianoccupation').val($('#motheroccupation').val());
                $('#guardianrelation').val(value)
            } else {
                $('#guardianname').val("");
                $('#guardianphone').val("");
                $('#guardianoccupation').val("");
                $('#guardianrelation').val("")
            }
        }
    });

    function auto_fill_guardian_address() {
        if ($("#autofill_current_address").is(':checked'))
        {
            $('#currentaddress').val($('#guardianaddress').val());
        }
        else
        {
            $('#currentaddress').val("");
        }
    }

    function auto_fill_permanent_address() {
        if ($("#autofill_permanent_address").is(':checked'))
        {
            $('#permanentaddress').val($('#currentaddress').val());
        }
        else
        {
            $('#permanentaddress').val("");
        }
    }

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

    function studentphotomodify() {
        $('#studentphoto').trigger('click');
    }

    $('#studentphoto').change(function () {
        readphoto(this);
    });

    function readphoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#studentphotopreview').attr('src', e.target.result);
                document.getElementById("imagephoto").style.display = "block";
                document.getElementById("inputphotofile").style.display = "none";
            };
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
</body>
</html>
