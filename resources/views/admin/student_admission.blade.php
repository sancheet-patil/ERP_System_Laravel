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
                <li class="active">Student Admission</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border bg-gray-light">
                            <h3 class="box-title">Admission Information</h3>
                        </div>
                        <form action="{{route('student.admission.add')}}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" id="saralid" name="saralid" class="form-control" value="{{old('saralid')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="aadhar">AADHAR</label> <small class="req"> *</small>
                                            <input type="text" id="aadhar" name="aadhar" class="form-control" required value="{{old('aadhar')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname">Last name</label> <small class="req"> *</small>
                                            <input type="text" id="lname" name="lname" class="form-control" required value="{{old('lname')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="fname">First name</label> <small class="req"> *</small>
                                            <input type="text" id="fname" name="fname" class="form-control" required value="{{old('fname')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mname">Middle name</label>
                                            <input type="text" id="mname" name="mname" class="form-control" value="{{old('mname')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label> <small class="req"> *</small>
                                            <select id="gender" name="gender" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Male" @if('Male' == old('gender')) selected @endif>Male</option>
                                                <option value="Female" @if('Female' == old('gender')) selected @endif>Female</option>
                                                <option value="Other" @if('Other' == old('gender')) selected @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothertongue">Mother tongue</label> <small class="req"> *</small>
                                            <input type="text" id="mothertongue" name="mothertongue" class="form-control" value="{{old('mothertongue')}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion</label><small class="req"> *</small>
                                            <select id="religion" name="religion" class="form-control select2" >
                                                <option value="">Select</option>
                                                <?php
                                                    $religions = \App\ReligionLists::orderBy('religion','asc')->get();
                                                ?>
                                                @foreach($religions as $religion)
                                                    <option value="{{$religion->id}}" @if($religion->id == old('religion')) selected @endif>{{$religion->religion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="castename">Caste</label><small class="req"> *</small>
                                            <select id="castename" name="castename" class="form-control select2" required>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="subcaste">Sub Caste</label><small class="req"> *</small>
                                            <select id="subcaste" name="subcaste" class="form-control select2" required>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="category">Category</label> <small class="req"> *</small>
                                            <input type="text" id="category" name="category" class="form-control" required value="{{old('category')}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="placeob">Place of birth</label> <small class="req"> *</small>
                                            <input type="text" id="placeob" name="placeob" class="form-control" required value="{{old('placeob')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dob">Date of Birth</label> <small class="req"> *</small>
                                            <input type="text" id="dob" name="dob" class="form-control" placeholder="dd-mm-yyyy" required />
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
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{old('mobile')}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}"/>
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
                                            <select id="bloodgroup" name="bloodgroup" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="A+" @if('A+' == old('bloodgroup')) selected @endif>A+</option>
                                                <option value="A-" @if('A-' == old('bloodgroup')) selected @endif>A-</option>
                                                <option value="B+" @if('B+' == old('bloodgroup')) selected @endif>B+</option>
                                                <option value="B-" @if('B-' == old('bloodgroup')) selected @endif>B-</option>
                                                <option value="AB+" @if('AB+' == old('bloodgroup')) selected @endif>AB+</option>
                                                <option value="AB-" @if('AB-' == old('bloodgroup')) selected @endif>AB-</option>
                                                <option value="O+" @if('O+' == old('bloodgroup')) selected @endif>O+</option>
                                                <option value="O-" @if('O-' == old('bloodgroup')) selected @endif>O-</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="citytype">City Type</label> <small class="req"> *</small>
                                            <select id="citytype" name="citytype" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Rural">Rural</option>
                                                <option value="Urban">Urban</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="familyincome">Family income (Annual)</label>
                                            <input type="number" id="familyincome" name="familyincome" min="1" placeholder="" class="form-control" value="{{old('familyincome')}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="isminor">Minority</label> <small class="req"> *</small>
                                            <select id="isminor" name="isminor" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No" selected>No</option>
                                            </select>
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
                                            <input type="text" id="fathername" name="fathername" class="form-control" value="{{old('fathername')}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fatherphone">Father Phone</label>
                                            <input type="number" id="fatherphone" name="fatherphone" class="form-control" value="{{old('fatherphone')}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fatheroccupation">Father Occupation</label>
                                            <input type="text" id="fatheroccupation" name="fatheroccupation" class="form-control" value="{{old('fatheroccupation')}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mothername">Mother Name</label>
                                            <input type="text" id="mothername" name="mothername" class="form-control" value="{{old('mothername')}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="motherphone">Mother Phone</label>
                                            <input type="number" id="motherphone" name="motherphone" class="form-control" value="{{old('motherphone')}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="motheroccupation">Mother Occupation</label>
                                            <input type="text" id="motheroccupation" name="motheroccupation" class="form-control" value="{{old('motheroccupation')}}" />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="guardianis">Guardian is</label><small class="req"> *</small>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Father" required @if('Father' == old('guardianis')) checked @endif>Father</label>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Mother" required @if('Mother' == old('guardianis')) checked @endif>Mother</label>
                                            <label class="radio-inline"><input type="radio" id="guardianis" name="guardianis" value="Other" required @if('Other' == old('guardianis')) checked @endif>Other</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianname">Guardian Name</label><small class="req"> *</small>
                                            <input type="text" id="guardianname" name="guardianname" class="form-control" required value="{{old('guardianname')}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianphone">Guardian Phone</label><small class="req"> *</small>
                                            <input type="number" id="guardianphone" name="guardianphone" class="form-control" required value="{{old('guardianphone')}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="guardianrelation">Guardian Relation</label><small class="req"> *</small>
                                            <input type="text" id="guardianrelation" name="guardianrelation" class="form-control" required value="{{old('guardianrelation')}}"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="guardianoccupation">Guardian Occupation</label><small class="req"> *</small>
                                            <input type="text" id="guardianoccupation" name="guardianoccupation" class="form-control" required value="{{old('guardianoccupation')}}"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="guardianaddress">Guardian Address</label><small class="req"> *</small>
                                            <input type="text" id="guardianaddress" name="guardianaddress" class="form-control" required value="{{old('guardianaddress')}}"/>
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
                                                <input type="text" id="currentaddress" name="currentaddress" class="form-control" value="{{old('currentaddress')}}" />
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
                                                <input type="text" id="permanentaddress" name="permanentaddress" class="form-control" value="{{old('permanentaddress')}}" />
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
                                            <input type="text" id="accounttitle" name="accounttitle" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="accountno">Account No.</label>
                                            <input type="number" id="accountno" name="accountno" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankifsccode">IFSC code</label>
                                            <input type="text" id="bankifsccode" name="bankifsccode" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankname">Bank Name</label>
                                            <input type="text" id="bankname" name="bankname" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankbranchname">Branch Name</label>
                                            <input type="text" id="bankbranchname" name="bankbranchname" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankmicrcode">Bank MICR code</label>
                                            <input type="text" id="bankmicrcode" name="bankmicrcode" class="form-control" />
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
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Students List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Admission year</th>
                                        <th>Register for</th>
                                        <th>Register no.</th>
                                        <th>Admission date</th>
                                        <th>Saral ID</th>
                                        <th>Admission class</th>
                                        <th>Roll No.</th>
                                        <th>Student name</th>
                                        <th>Father name</th>
                                        <th>Mother name</th>
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
                                        <th>Last School</th>
                                        <th>Previous LC No.</th>
                                        <th>Previous Registration No.</th>
                                        <th>Address</th>
                                        <th>Bank Account No.</th>
                                        <th>Bank Name</th>
                                        <th>Bank IFSC code</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($studentlist as $student)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$student->admission_year}}</td>
                                            <td>{{$student->registerfor}}</td>
                                            <td>{{$student->registerno}}</td>
                                            <td>{{$student->admission_date}}</td>
                                            <td>{{$student->saralid}}</td>
                                            <td>{{$student->admission_class}}</td>
                                            <td>{{$student->roll_no}}</td>
                                            <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                            <td>{{$student->fathername}}</td>
                                            <td>{{$student->mothername}}</td>
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
                                            <td>
                                                <?php
                                                    $lastschool = \App\OtherSchoolLists::where('id',$student->lastschool)->value('schoolname');
                                                ?>
                                                {{$lastschool}}
                                            </td>
                                            <td>{{$student->previouslcno}}</td>
                                            <td>{{$student->previousgrno}}</td>
                                            <td>{{$student->currentaddress}}</td>
                                            <td>{{$student->accountno}}</td>
                                            <td>{{$student->bankname}}</td>
                                            <td>{{$student->bankifsccode}}</td>
                                            <td>
                                                <a href="{{route('student.report',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print form"><i class="fa fa-print"></i></a>
                                                <a href="{{route('student.view',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('student.editadmission',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('student.delete',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
</script>
</body>
</html>
