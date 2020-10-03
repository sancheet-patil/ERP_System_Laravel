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
                <li class="active">Student Rejoin</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border bg-gray-light">
                            <h3 class="box-title">Student Re-Admission Information</h3>
                        </div>
                        <form action="{{route('studentrejoin.add')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
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
                                        <h3 class="box-title">Search Student Details</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-3">
                                            <label for="checkstudentaadhar">Check Student AADHAR</label> <small class="req"> *</small>
                                            <input type="text" id="checkstudentaadhar" name="checkstudentaadhar" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button id="btnstudentsearch" class="btn btn-primary pull-right">Search</button>
                                    </div>
                                </div>
                                <div class="box box-default">
                                    <div class="box-header with-border bg-gray-light">
                                        <h3 class="box-title">Student Details</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-3">
                                            <label for="academicyear">Admission year</label> <small class="req"> *</small>
                                            <select id="academicyear" name="academicyear" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <?php
                                                    $academicyears = \App\AcademicYearList::orderBy('academicyear','desc')->get();
                                                ?>
                                                @foreach($academicyears as $academicyear)
                                                    <option value="{{$academicyear->academicyear}}" @if($academicyear->academicyear == old('academicyear')) selected @endif>{{$academicyear->academicyear}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="registerfor">Register for</label> <small class="req"> *</small>
                                            <select id="registerfor" name="registerfor" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="School" @if('School' == old('registerfor')) selected @endif>School</option>
                                                <option value="College" @if('College' == old('registerfor')) selected @endif>College</option>
                                                <option value="School Form 17" @if('School Form 17' == old('registerfor')) selected @endif>School Form 17</option>
                                                <option value="College Form 17" @if('College Form 17' == old('registerfor')) selected @endif>College Form 17</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="facultydiv" style="display: none;">
                                            <label for="faculty">Faculty</label> <small class="req"> *</small>
                                            <select id="faculty" name="faculty" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Arts">Arts</option>
                                                <option value="Commerce">Commerce</option>
                                                <option value="Science">Science</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="registerno">Register No.</label> <small class="req"> *</small>
                                            <input type="text" id="registerno" name="registerno" class="form-control" value="{{old('registerno')}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="classname">Admission Class</label><small class="req"> *</small>
                                            <select id="classname" name="classname" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <?php
                                                    $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                                ?>
                                                @foreach($classlist as $class)
                                                    <option value="{{$class->classname}}" @if($class->classname == old('classname')) selected @endif>{{$class->classname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="division">Division</label>
                                            <select id="division" name="division" class="form-control select2">
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="saralid">Saral ID</label>
                                            <input type="text" id="saralid" name="saralid" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="aadhar">AADHAR</label> <small class="req"> *</small>
                                            <input type="text" id="aadhar" name="aadhar" class="form-control" required value="{{old('aadhar')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname">Last name</label> <small class="req"> *</small>
                                            <input type="text" id="lname" name="lname" class="form-control" required value="{{old('lname')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="fname">First name</label> <small class="req"> *</small>
                                            <input type="text" id="fname" name="fname" class="form-control" required value="{{old('fname')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mname">Middle name</label>
                                            <input type="text" id="mname" name="mname" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label> <small class="req"> *</small>
                                            <input type="text" id="gender" name="gender" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothertongue">Mother tongue</label> <small class="req"> *</small>
                                            <input type="text" id="mothertongue" name="mothertongue" class="form-control" value="{{old('mothertongue')}}" required readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion</label><small class="req"> *</small>
                                            <input type="text" id="religion" name="religion" class="form-control" readonly style="display:none;"/>
                                            <input type="text" id="religion1" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="castename">Caste</label><small class="req"> *</small>
                                            <input type="text" id="castename" name="castename" class="form-control" readonly style="display:none;"/>
                                            <input type="text" id="castename1" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="subcaste">Sub Caste</label><small class="req"> *</small>
                                            <input type="text" id="subcaste" name="subcaste" class="form-control" readonly style="display:none;"/>
                                            <input type="text" id="subcaste1" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="category">Category</label> <small class="req"> *</small>
                                            <input type="text" id="category" name="category" class="form-control" required readonly style="display:none;"/>
                                            <input type="text" id="category1" class="form-control" required readonly/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="placeob">Place of birth</label> <small class="req"> *</small>
                                            <input type="text" id="placeob" name="placeob" class="form-control" required value="{{old('placeob')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dob">Date of Birth</label> <small class="req"> *</small>
                                            <input type="text" id="dob" name="dob" class="form-control" placeholder="dd-mm-yyyy" required readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lastclass">Last attended class</label> <small class="req"> *</small>
                                            <input type="text" id="lastclass" name="lastclass" class="form-control" required value="{{old('lastclass')}}"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="schoolname">Last attended school</label> <small class="req"> *</small>
                                            <select id="schoolname" name="schoolname" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <?php
                                                    $schools = \App\OtherSchoolLists::orderBy('schoolname','asc')->get();
                                                ?>
                                                @foreach($schools as $school)
                                                    <option value="{{$school->id}}" @if($school->id == old('schoolname')) selected @endif>{{$school->schoolname}}</option>
                                                @endforeach
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="lastschooldiv" style="display: none;">
                                            <label for="lastschool">Name of school/ college</label> <small class="req"> *</small>
                                            <input type="text" id="lastschool" name="lastschool" class="form-control" required value="{{old('lastschool')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="previouslcno">Previous LC Number</label> <small class="req"> *</small>
                                            <input type="text" id="previouslcno" name="previouslcno" class="form-control" required value="{{old('previouslcno')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="previousgrno">Previous Registration Number</label><small class="req"> *</small>
                                            <input type="text" id="previousgrno" name="previousgrno" class="form-control" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="admissiontype">Admission Type</label> <small class="req"> *</small>
                                            <select id="admissiontype" name="admissiontype" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Fresher" selected>Fresher</option>
                                                <option value="Repeater">Repeater</option>
                                                <option value="One time failed">One time failed</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lateadmission">Late Admission</label> <small class="req"> *</small>
                                            <select id="lateadmission" name="lateadmission" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="No" selected>No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hostelrequired">Hostel required</label> <small class="req"> *</small>
                                            <select id="hostelrequired" name="hostelrequired" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="No" selected>No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{old('mobile')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="admission_date">Admission date</label> <small class="req"> *</small>
                                            <input type="text" id="admission_date" name="admission_date" class="form-control" value="{{date('d-m-Y')}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="roll_no">Roll Number</label>
                                            <input type="number" id="roll_no" name="roll_no" min="1" placeholder="" class="form-control" value="{{old('roll_no')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ispwd">Person with Disability</label> <small class="req"> *</small>
                                            <select id="ispwd" name="ispwd" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No" selected>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="pwddiv" style="display: none;">
                                            <label for="pwd">Name of Disability</label> <small class="req"> *</small>
                                            <input type="text" id="pwd" name="pwd" class="form-control" required value="No"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bloodgroup">Blood group</label>
                                            <input type="text" id="bloodgroup" name="bloodgroup" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="citytype">City Type</label> <small class="req"> *</small>
                                            <input type="text" id="citytype" name="citytype" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="familyincome">Family income (Annual)</label>
                                            <input type="number" id="familyincome" name="familyincome" min="1" placeholder="" class="form-control" value="{{old('familyincome')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="isbpl">Below Poverty Level</label>
                                            <select id="isbpl" name="isbpl" class="form-control select2">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No" selected>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="bpldiv" style="display: none;">
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
                                            <input type="text" id="isminor" name="isminor" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-3" id="imagephoto" hidden>
                                            <label for="studentphoto">Student Photo</label><br>
                                            <img id="studentphotopreview" src="" height="120px" width="100px" alt="Select Photo" onclick="studentphotomodify()"/><br>
                                            <span>Note: Upload only jpg,png files. Max photo size 20kb</span>
                                        </div>
                                        <div class="form-group col-md-3" id="inputphotofile">
                                            <label for="studentphoto">Student Photo</label> <small class="req"> *</small>
                                            <input type="file" id="studentphoto" name="studentphoto" class="form-control no-border" accept="image/*" required/>
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
                                            <input type="text" id="fathername" name="fathername" class="form-control" value="{{old('fathername')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fatherphone">Father Phone</label>
                                            <input type="number" id="fatherphone" name="fatherphone" class="form-control" value="{{old('fatherphone')}}"  readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fatheroccupation">Father Occupation</label>
                                            <input type="text" id="fatheroccupation" name="fatheroccupation" class="form-control" value="{{old('fatheroccupation')}}" readonly />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mothername">Mother Name</label>
                                            <input type="text" id="mothername" name="mothername" class="form-control" value="{{old('mothername')}}" readonly />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="motherphone">Mother Phone</label>
                                            <input type="number" id="motherphone" name="motherphone" class="form-control" value="{{old('motherphone')}}" readonly />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="motheroccupation">Mother Occupation</label>
                                            <input type="text" id="motheroccupation" name="motheroccupation" class="form-control" value="{{old('motheroccupation')}}" readonly />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="guardianis">Guardian is</label><small class="req"> *</small>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Father"  @if('Father' == old('guardianis')) checked @endif>Father</label>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Mother"  @if('Mother' == old('guardianis')) checked @endif>Mother</label>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Other"  @if('Other' == old('guardianis')) checked @endif>Other</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianname">Guardian Name</label><small class="req"> *</small>
                                            <input type="text" id="guardianname" name="guardianname" class="form-control" required value="{{old('guardianname')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianphone">Guardian Phone</label><small class="req"> *</small>
                                            <input type="number" id="guardianphone" name="guardianphone" class="form-control" required value="{{old('guardianphone')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianrelation">Guardian Relation</label><small class="req"> *</small>
                                            <input type="text" id="guardianrelation" name="guardianrelation" class="form-control" required value="{{old('guardianrelation')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="guardianoccupation">Guardian Occupation</label><small class="req"> *</small>
                                            <input type="text" id="guardianoccupation" name="guardianoccupation" class="form-control" required value="{{old('guardianoccupation')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="guardianaddress">Guardian Address</label><small class="req"> *</small>
                                            <input type="text" id="guardianaddress" name="guardianaddress" class="form-control" required value="{{old('guardianaddress')}}" readonly/>
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
                                                    <input type="checkbox" id="autofill_current_address" onclick="auto_fill_guardian_address()">
                                                    If Guardian Address is Current Address
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="currentaddress">Current Address</label>
                                                <input type="text" id="currentaddress" name="currentaddress" class="form-control" value="{{old('currentaddress')}}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="autofill_permanent_address" onclick="auto_fill_permanent_address()">
                                                    If Current Address is Permanent Address
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="permanentaddress">Permanent Address</label>
                                                <input type="text" id="permanentaddress" name="permanentaddress" class="form-control" value="{{old('permanentaddress')}}" readonly/>
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
                                            <input type="text" id="accounttitle" name="accounttitle" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="accountno">Account No.</label>
                                            <input type="number" id="accountno" name="accountno" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankifsccode">IFSC code</label>
                                            <input type="text" id="bankifsccode" name="bankifsccode" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankname">Bank Name</label>
                                            <input type="text" id="bankname" name="bankname" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankbranchname">Branch Name</label>
                                            <input type="text" id="bankbranchname" name="bankbranchname" class="form-control" readonly/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankmicrcode">Bank MICR code</label>
                                            <input type="text" id="bankmicrcode" name="bankmicrcode" class="form-control" readonly/>
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
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td><input type="text" name="document1" class="form-control" ></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document1file" id="document1file" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><input type="text" name="document2" class="form-control" ></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document2file" id="document2file" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td><input type="text" name="document3" class="form-control" ></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document3file" id="document3file" >
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
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td><input type="text" name="document4" class="form-control" ></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document4file" id="document4file" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td><input type="text" name="document5" class="form-control" ></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document5file" id="document5file" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td><input type="text" name="document6" class="form-control" ></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document6file" id="document6file" >
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
                                <button type="submit" id="btnsubmit" class="btn btn-primary pull-right">Save</button>
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
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }

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
                // $('#inputphotofile').attr('')
                document.getElementById("imagephoto").style.display = "block";
                document.getElementById("inputphotofile").style.display = "none";
            };
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $('#btnstudentsearch').click(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/studentbyaadhar')}}?checkstudentaadhar="+$('#checkstudentaadhar').val(),
            beforeSend: function () {
            },
            success: function (data) {
                $('#aadhar').val(data.aadhar);
                $('#saralid').val(data.saralid);
                $('#lname').val(data.lname);
                $('#fname').val(data.fname);
                $('#mname').val(data.mname);
                $('#gender').val(data.gender);
                $('#mothertongue').val(data.mothertongue);
                $('#placeob').val(data.placeob);
                $('#religion').val(data.religion);
                $('#category').val(data.category);
                $('#castename').val(data.castename);
                $('#subcaste').val(data.subcaste);
                $('#dob').val(data.dob);
                $('#mobile').val(data.mobile);
                $('#email').val(data.email);
                $('#bloodgroup').val(data.bloodgroup);
                $('#citytype').val(data.citytype);
                $('#familyincome').val(data.familyincome);
                $('#isminor').val(data.isminor);

                $('#fathername').val(data.fathername);
                $('#fatherphone').val(data.fatherphone);
                $('#fatheroccupation').val(data.fatheroccupation);
                $('#mothername').val(data.mothername);
                $('#motherphone').val(data.motherphone);
                $('#motheroccupation').val(data.motheroccupation);
                $('#guardianname').val(data.guardianname);
                $('#guardianphone').val(data.guardianphone);
                $('#guardianoccupation').val(data.guardianoccupation);
                $('#guardianrelation').val(data.guardianrelation);
                $('#guardianaddress').val(data.guardianaddress);

                $('#currentaddress').val(data.currentaddress);
                $('#permanentaddress').val(data.permanentaddress);

                $('#accounttitle').val(data.accounttitle);
                $('#accountno').val(data.accountno);
                $('#bankifsccode').val(data.bankifsccode);
                $('#bankname').val(data.bankname);
                $('#bankbranchname').val(data.bankbranchname);
                $('#bankmicrcode').val(data.bankmicrcode);

                $.ajax({
                    type: "GET",
                    url: "{{url('/subcastealldetails')}}?subcaste=" + data.subcaste,
                    beforeSend: function () {
                    },
                    success: function (data) {
                        $('#religion1').val(data.religion);
                        $('#category1').val(data.category);
                        $('#castename1').val(data.castename);
                        $('#subcaste1').val(data.subcaste);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
