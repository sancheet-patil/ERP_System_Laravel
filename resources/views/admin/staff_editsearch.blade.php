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
                <li><a href="{{route('staff.search')}}">Staff search</a></li>
                <li class="active">Staff Edit</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <form action="{{route('staff.editsearch.edit')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="box box-default">
                                    <div class="box-header with-border bg-gray-light">
                                        <h3 class="box-title">Staff Details</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-3" hidden>
                                            <label for="userid">User ID</label> <small class="req"> *</small>
                                            <input type="text" id="userid" name="userid" min="1" class="form-control" value="{{$staffdetails->userid}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="staffid">Staff ID</label> <small class="req"> *</small>
                                            <input type="number" id="staffid" name="staffid" min="1" class="form-control" value="{{$staffdetails->staffid}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="staffrole">User Role</label><small class="req"> *</small>
                                            <select id="staffrole" name="staffrole" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="admin" @if('admin' == $staffdetails->staffrole) selected @endif>Admin</option>
                                                <option value="operator" @if('operator' == $staffdetails->staffrole) selected @endif>Operator</option>
                                                <option value="teacher" @if('teacher' == $staffdetails->staffrole) selected @endif>Teacher</option>
                                                <option value="other" @if('other' == $staffdetails->staffrole) selected @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="designation">Designation</label><small class="req"> *</small>
                                            <select id="designation" name="designation" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <?php
                                                $designations = \App\DesignationLists::orderBy('designation','asc')->get();
                                                ?>
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->id}}" @if($designation->id == $staffdetails->designation) selected @endif>{{$designation->designation}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname">Last name</label> <small class="req"> *</small>
                                            <input type="text" id="lname" name="lname" class="form-control" value="{{$staffdetails->lname}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="fname">First name</label> <small class="req"> *</small>
                                            <input type="text" id="fname" name="fname" class="form-control" value="{{$staffdetails->fname}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mname">Father name</label>
                                            <input type="text" id="mname" name="mname" class="form-control" value="{{$staffdetails->mname}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothername">Mother name</label>
                                            <input type="text" id="mothername" name="mothername" class="form-control" value="{{$staffdetails->mothername}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label> <small class="req"> *</small>
                                            <select id="gender" name="gender" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Male" @if('Male' == $staffdetails->gender) selected @endif>Male</option>
                                                <option value="Female" @if('Female' == $staffdetails->gender) selected @endif>Female</option>
                                                <option value="Other" @if('Other' == $staffdetails->gender) selected @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dob">Date of Birth</label> <small class="req"> *</small>
                                            <input type="text" id="dob" name="dob" class="form-control" value="{{$staffdetails->dob}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label> <small class="req"> *</small>
                                            <input type="email" id="email" name="email" class="form-control" value="{{$staffdetails->email}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label> <small class="req"> *</small>
                                            <input type="number" id="mobile" name="mobile" maxlength="10" class="form-control" value="{{$staffdetails->mobile}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bloodgroup">Blood group</label>
                                            <select id="bloodgroup" name="bloodgroup" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="A+" @if('A+' == $staffdetails->bloodgroup) selected @endif>A+</option>
                                                <option value="A-" @if('A-' == $staffdetails->bloodgroup) selected @endif>A-</option>
                                                <option value="B+" @if('B+' == $staffdetails->bloodgroup) selected @endif>B+</option>
                                                <option value="B-" @if('B-' == $staffdetails->bloodgroup) selected @endif>B-</option>
                                                <option value="AB+" @if('AB+' == $staffdetails->bloodgroup) selected @endif>AB+</option>
                                                <option value="AB-" @if('AB-' == $staffdetails->bloodgroup) selected @endif>AB-</option>
                                                <option value="O+" @if('O+' == $staffdetails->bloodgroup) selected @endif>O+</option>
                                                <option value="O-" @if('O-' == $staffdetails->bloodgroup) selected @endif>O-</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="maritalstatus">Marital Status</label>
                                            <select id="maritalstatus" name="maritalstatus" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="Married" @if('Married' == $staffdetails->maritalstatus) selected @endif>Married</option>
                                                <option value="Unmarried" @if('Unmarried' == $staffdetails->maritalstatus) selected @endif>Unmarried</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion</label><small class="req"> *</small>
                                            <select id="religion" name="religion" class="form-control select2" >
                                                <option value="">Select</option>
                                                <?php
                                                $religions = \App\ReligionLists::orderBy('religion','asc')->get();
                                                ?>
                                                @foreach($religions as $religion)
                                                    <option value="{{$religion->id}}" @if($religion->id == $staffdetails->religion) selected @endif>{{$religion->religion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="castename">Caste</label><small class="req"> *</small>
                                            <select id="castename" name="castename" class="form-control select2" required>
                                                <option value="">Select</option>
                                                @foreach($castelist as $caste)
                                                    <option value="{{$caste->castename}}" @if($caste->castename == $staffdetails->castename) selected @endif>{{$caste->castename}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="subcaste">Sub Caste</label><small class="req"> *</small>
                                            <select id="subcaste" name="subcaste" class="form-control select2" required>
                                                <option value="">Select</option>
                                                @foreach($subcastelist as $subcaste)
                                                    <option value="{{$subcaste->id}}" @if($subcaste->id == $staffdetails->subcaste) selected @endif>{{$subcaste->subcaste}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="category">Category</label> <small class="req"> *</small>
                                            <?php
                                            $category = \App\CategoryLists::where('id',$staffdetails->category)->value('category');
                                            ?>
                                            <input type="text" id="category" name="category" class="form-control" required value="{{$category}}" readonly/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="aadhar">AADHAR</label> <small class="req"> *</small>
                                            <input type="number" id="aadhar" name="aadhar" class="form-control" value="{{$staffdetails->aadhar}}" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothertongue">Mother tongue</label>
                                            <input type="text" id="mothertongue" name="mothertongue" class="form-control" value="{{$staffdetails->mothertongue}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="placeob">Place of birth</label>
                                            <input type="text" id="placeob" name="placeob" class="form-control" value="{{$staffdetails->placeob}}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="joiningdate">Date of Joining</label> <small class="req"> *</small>
                                            <input type="text" id="joiningdate" name="joiningdate" class="form-control" value="{{$staffdetails->joiningdate}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="shalarthid">Shalarth ID</label>
                                            <input type="text" id="shalarthid" name="shalarthid" class="form-control" value="{{$staffdetails->shalarthid}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pannumber">Pan number</label> <small class="req"> *</small>
                                            <input type="text" id="pannumber" name="pannumber" class="form-control" required value="{{$staffdetails->pannumber}}"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="retirementdate">Date of Retirement</label>
                                            <input type="text" id="retirementdate" name="retirementdate" class="form-control" value="{{$staffdetails->retirementdate}}" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="qualificationdetails">Qualification details</label>
                                            <textarea name="qualificationdetails" class="form-control">{{$staffdetails->qualificationdetails}} </textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="experiencedetails">Experience Details</label>
                                            <textarea name="experiencedetails" class="form-control">{{$staffdetails->experiencedetails}}</textarea>
                                        </div>
                                        <div class="form-group col-md-3" id="imagephoto" hidden>
                                            <label for="staffphoto">Staff Photo</label><br>
                                            <img id="staffphotopreview" src="" height="120px" width="100px" alt="Select Photo" onclick="staffphotomodify()"/><br>
                                            <span>Note: Upload only jpg,png files. Max photo size 20kb</span>
                                        </div>
                                        <div class="form-group col-md-3" id="inputphotofile">
                                            <label for="staffphoto">Staff Photo</label>
                                            <input type="file" id="staffphoto" name="staffphoto" class="form-control no-border" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border bg-gray-light" data-widget="collapse">
                                        <h3 class="box-title">Staff Address Details</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-6">
                                            <label for="currentaddress">Current Address</label>
                                            <textarea name="currentaddress" class="form-control">{{$staffdetails->currentaddress}}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="permanentaddress">Permanent Address</label>
                                            <textarea name="permanentaddress" class="form-control">{{$staffdetails->permanentaddress}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border bg-gray-light" data-widget="collapse">
                                        <h3 class="box-title">Payrole Details</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-md-4">
                                            <label for="epfno">EPF No.</label>
                                            <input type="text" id="epfno" name="epfno" class="form-control" value="{{$staffdetails->epfno}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="basicsalary">Salary</label>
                                            <input type="text" id="basicsalary" name="basicsalary" class="form-control" value="{{$staffdetails->basicsalary}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="contracttype">Contract type</label>
                                            <select id="contracttype" name="contracttype" class="form-control" >
                                                <option value="">Select</option>
                                                <option value="Permanent" @if('Permanent' == $staffdetails->contracttype) selected @endif>Permanent</option>
                                                <option value="Probation" @if('Probation' == $staffdetails->contracttype) selected @endif>Probation</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="seniorscale">Senior scale</label>
                                            <input type="text" id="seniorscale" name="seniorscale" class="form-control" value="{{$staffdetails->seniorscale}}" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mostseniorscale">Most senior scale</label>
                                            <input type="text" id="mostseniorscale" name="mostseniorscale" class="form-control" value="{{$staffdetails->mostseniorscale}}"/>
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
                                            <input type="text" id="accounttitle" name="accounttitle" class="form-control" value="{{$staffdetails->accounttitle}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="accountno">Account No.</label>
                                            <input type="text" id="accountno" name="accountno" class="form-control" value="{{$staffdetails->accountno}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankifsccode">IFSC code</label>
                                            <input type="text" id="bankifsccode" name="bankifsccode" class="form-control" value="{{$staffdetails->bankifsccode}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankname">Bank Name</label>
                                            <input type="text" id="bankname" name="bankname" class="form-control" value="{{$staffdetails->bankname}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankbranchname">Branch Name</label>
                                            <input type="text" id="bankbranchname" name="bankbranchname" class="form-control" value="{{$staffdetails->bankbranchname}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bankmicrcode">Bank MICR code</label>
                                            <input type="text" id="bankmicrcode" name="bankmicrcode" class="form-control" value="{{$staffdetails->bankmicrcode}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarytitle">Salary Account Title</label>
                                            <input type="text" id="salarytitle" name="salarytitle" class="form-control" value="{{$staffdetails->salarytitle}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salaryaccountno">Salary Account No.</label>
                                            <input type="text" id="salaryaccountno" name="salaryaccountno" class="form-control" value="{{$staffdetails->salaryaccountno}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salaryifsc">Salary IFSC code</label>
                                            <input type="text" id="salaryifsc" name="salaryifsc" class="form-control" value="{{$staffdetails->salaryifsc}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarybank">Salary Bank Name</label>
                                            <input type="text" id="salarybank" name="salarybank" class="form-control" value="{{$staffdetails->salarybank}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarybranch">Salary Branch Name</label>
                                            <input type="text" id="salarybranch" name="salarybranch" class="form-control" value="{{$staffdetails->salarybranch}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarymicr">Salary Bank MICR</label>
                                            <input type="text" id="salarymicr" name="salarymicr" class="form-control" value="{{$staffdetails->salarymicr}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensiontitle">Pension Account Title</label>
                                            <input type="text" id="pensiontitle" name="pensiontitle" class="form-control" value="{{$staffdetails->pensiontitle}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionaccountno">Pension Account No.</label>
                                            <input type="text" id="pensionaccountno" name="pensionaccountno" class="form-control" value="{{$staffdetails->pensionaccountno}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionifsc">Pension IFSC code</label>
                                            <input type="text" id="pensionifsc" name="pensionifsc" class="form-control" value="{{$staffdetails->pensionifsc}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionbank">Pension Bank Name</label>
                                            <input type="text" id="pensionbank" name="pensionbank" class="form-control" value="{{$staffdetails->pensionbank}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionbranch">Pension Branch Name</label>
                                            <input type="text" id="pensionbranch" name="pensionbranch" class="form-control" value="{{$staffdetails->pensionbranch}}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionmicr">Pension Bank MICR</label>
                                            <input type="text" id="pensionmicr" name="pensionmicr" class="form-control" value="{{$staffdetails->pensionmicr}}"/>
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
                                                    <td><input type="text" name="document1" class="form-control" value="{{$staffdetails->document1name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document1file" id="document1file" >
                                                    </td>
                                                    <td>
                                                        @if($staffdetails->document1file)
                                                            <a id="document1view" href="{{$staffdetails->document1file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><input type="text" name="document2" class="form-control" value="{{$staffdetails->document2name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document2file" id="document2file" >
                                                    </td>
                                                    <td>
                                                        @if($staffdetails->document2file)
                                                            <a href="{{$staffdetails->document2file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td><input type="text" name="document3" class="form-control" value="{{$staffdetails->document3name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document3file" id="document3file" >
                                                    </td>
                                                    <td>
                                                        @if($staffdetails->document3file)
                                                            <a href="{{$staffdetails->document3file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
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
                                                    <td><input type="text" name="document4" class="form-control" value="{{$staffdetails->document4name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document4file" id="document4file" >
                                                    </td>
                                                    <td>
                                                        @if($staffdetails->document4file)
                                                            <a href="{{$staffdetails->document4file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td><input type="text" name="document5" class="form-control" value="{{$staffdetails->document5name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document5file" id="document5file" >
                                                    </td>
                                                    <td>
                                                        @if($staffdetails->document5file)
                                                            <a href="{{$staffdetails->document5file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td><input type="text" name="document6" class="form-control" value="{{$staffdetails->document6name}}"></td>
                                                    <td>
                                                        <input class="form-control no-border" type="file" name="document6file" id="document6file" >
                                                    </td>
                                                    <td>
                                                        @if($staffdetails->document6file)
                                                            <a href="{{$staffdetails->document6file}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
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
        $('#dob').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $('#joiningdate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
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

    $('#mobile').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
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

    function staffphotomodify() {
        $('#staffphoto').trigger('click');
    }

    $('#staffphoto').change(function () {
        readphoto(this);
    });

    function readphoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#staffphotopreview').attr('src', e.target.result);
                document.getElementById("imagephoto").style.display = "block";
                document.getElementById("inputphotofile").style.display = "none";
            };
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
</body>
</html>
