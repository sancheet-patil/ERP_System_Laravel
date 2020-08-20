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
                <li class="active">Staff Joining</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <form action="{{route('staff.joining.add')}}" method="post" enctype="multipart/form-data">
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
                                        <div class="form-group col-md-3">
                                            <label for="staffid">Staff ID</label> <small class="req"> *</small>
                                            <input type="number" id="staffid" name="staffid" min="1" class="form-control" value="{{date('yHmids')}}" required/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="staffrole">User Role</label><small class="req"> *</small>
                                            <select id="staffrole" name="staffrole" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Operator">Operator</option>
                                                <option value="Teacher">Teacher</option>
                                                <option value="Other">Other</option>
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
                                                    <option value="{{$designation->id}}">{{$designation->designation}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname">Last name</label> <small class="req"> *</small>
                                            <input type="text" id="lname" name="lname" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="fname">First name</label> <small class="req"> *</small>
                                            <input type="text" id="fname" name="fname" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mname">Father name</label>
                                            <input type="text" id="mname" name="mname" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothername">Mother name</label>
                                            <input type="text" id="mothername" name="mothername" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender</label> <small class="req"> *</small>
                                            <select id="gender" name="gender" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dob">Date of Birth</label> <small class="req"> *</small>
                                            <input type="text" id="dob" name="dob" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label> <small class="req"> *</small>
                                            <input type="email" id="email" name="email" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label> <small class="req"> *</small>
                                            <input type="number" id="mobile" name="mobile" maxlength="10" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bloodgroup">Blood group</label>
                                            <select id="bloodgroup" name="bloodgroup" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="maritalstatus">Marital Status</label>
                                            <select id="maritalstatus" name="maritalstatus" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="Married">Married</option>
                                                <option value="Unmarried">Unmarried</option>
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
                                        <div class="form-group col-md-3">
                                            <label for="aadhar">AADHAR</label> <small class="req"> *</small>
                                            <input type="number" id="aadhar" name="aadhar" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mothertongue">Mother tongue</label>
                                            <input type="text" id="mothertongue" name="mothertongue" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="placeob">Place of birth</label>
                                            <input type="text" id="placeob" name="placeob" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="joiningdate">Date of Joining</label> <small class="req"> *</small>
                                            <input type="text" id="joiningdate" name="joiningdate" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="shalarthid">Shalarth ID</label>
                                            <input type="text" id="shalarthid" name="shalarthid" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pannumber">Pan number</label> <small class="req"> *</small>
                                            <input type="text" id="pannumber" name="pannumber" class="form-control" required />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="retirementdate">Date of Retirement</label>
                                            <input type="text" id="retirementdate" name="retirementdate" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="qualificationdetails">Qualification details</label>
                                            <textarea name="qualificationdetails" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="experiencedetails">Experience Details</label>
                                            <textarea name="experiencedetails" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-3" id="imagephoto" hidden>
                                            <label for="staffphoto">Staff Photo</label><br>
                                            <img id="staffphotopreview" src="" height="120px" width="100px" alt="Select Photo" onclick="staffphotomodify()"/><br>
                                            <span>Note: Upload only jpg,png files. Max photo size 20kb</span>
                                        </div>
                                        <div class="form-group col-md-3" id="inputphotofile">
                                            <label for="staffphoto">Staff Photo</label> <small class="req"> *</small>
                                            <input type="file" id="staffphoto" name="staffphoto" class="form-control no-border" accept="image/*" required/>
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
                                            <textarea name="currentaddress" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="permanentaddress">Permanent Address</label>
                                            <textarea name="permanentaddress" class="form-control"></textarea>
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
                                            <input type="text" id="epfno" name="epfno" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="basicsalary">Salary</label>
                                            <input type="text" id="basicsalary" name="basicsalary" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="contracttype">Contract type</label>
                                            <select id="contracttype" name="contracttype" class="form-control" >
                                                <option value="">Select</option>
                                                <option value="Permanent">Permanent</option>
                                                <option value="Probation">Probation</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="seniorscale">Senior scale</label>
                                            <input type="text" id="seniorscale" name="seniorscale" class="form-control"  />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mostseniorscale">Most senior scale</label>
                                            <input type="text" id="mostseniorscale" name="mostseniorscale" class="form-control" />
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
                                        <div class="col-md-12">
                                            <hr style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarytitle">Salary Account Title</label>
                                            <input type="text" id="salarytitle" name="salarytitle" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salaryaccountno">Salary Account No.</label>
                                            <input type="text" id="salaryaccountno" name="salaryaccountno" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salaryifsc">Salary IFSC code</label>
                                            <input type="text" id="salaryifsc" name="salaryifsc" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarybank">Salary Bank Name</label>
                                            <input type="text" id="salarybank" name="salarybank" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarybranch">Salary Branch Name</label>
                                            <input type="text" id="salarybranch" name="salarybranch" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="salarymicr">Salary Bank MICR</label>
                                            <input type="text" id="salarymicr" name="salarymicr" class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <hr style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensiontitle">Pension Account Title</label>
                                            <input type="text" id="pensiontitle" name="pensiontitle" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionaccountno">Pension Account No.</label>
                                            <input type="text" id="pensionaccountno" name="pensionaccountno" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionifsc">Pension IFSC code</label>
                                            <input type="text" id="pensionifsc" name="pensionifsc" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionbank">Pension Bank Name</label>
                                            <input type="text" id="pensionbank" name="pensionbank" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionbranch">Pension Branch Name</label>
                                            <input type="text" id="pensionbranch" name="pensionbranch" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pensionmicr">Pension Bank MICR</label>
                                            <input type="text" id="pensionmicr" name="pensionmicr" class="form-control" />
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
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Staff List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="staff_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Staff ID</th>
                                        <th>Staff Role</th>
                                        <th>Designation</th>
                                        <th>Staff name</th>
                                        <th>Father name</th>
                                        <th>Mother name</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
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
                                        <th>Shalarth ID</th>
                                        <th>Date of joining</th>
                                        <th>Address</th>
                                        <th>EPF No.</th>
                                        <th>Basic salary</th>
                                        <th>Contract type</th>
                                        <th>Bank Acct. No.</th>
                                        <th>Bank Name</th>
                                        <th>Bank IFSC</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($stafflist as $staff)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$staff->staffid}}</td>
                                            <td>{{$staff->staffrole}}</td>
                                            <td>
                                                <?php
                                                $designation = \App\DesignationLists::where('id',$staff->designation)->value('designation');
                                                ?>
                                                {{$designation}}
                                            </td>
                                            <td>{{$staff->fname.' '.$staff->mname.' '.$staff->lname}}</td>
                                            <td>{{$staff->mname}}</td>
                                            <td>{{$staff->mothername}}</td>
                                            <td>{{$staff->dob}}</td>
                                            <td>{{$staff->gender}}</td>
                                            <?php
                                            $castecategory = \App\CasteCategoryList::where('id',$staff->subcaste)->first();
                                            $religion = \App\ReligionLists::where('id',$castecategory['religion'])->value('religion');
                                            $category = \App\CategoryLists::where('id',$castecategory['category'])->value('category');
                                            ?>
                                            <td>{{$religion}}</td>
                                            <td>{{$category}}</td>
                                            <td>{{$castecategory['castename']}}</td>
                                            <td>{{$castecategory['subcaste']}}</td>
                                            <td>{{$staff->mobile}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>{{$staff->aadhar}}</td>
                                            <td>{{$staff->placeob}}</td>
                                            <td>{{$staff->mothertongue}}</td>
                                            <td>{{$staff->bloodgroup}}</td>
                                            <td>{{$staff->shalarthid}}</td>
                                            <td>{{$staff->joiningdate}}</td>
                                            <td>{{$staff->currentaddress}}</td>
                                            <td>{{$staff->epfno}}</td>
                                            <td>{{$staff->basicsalary}}</td>
                                            <td>{{$staff->contracttype}}</td>
                                            <td>{{$staff->accountno}}</td>
                                            <td>{{$staff->bankname}}</td>
                                            <td>{{$staff->bankifsccode}}</td>
                                            <td>
                                                <a href="{{route('staff.view',encrypt($staff->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                &nbsp;&nbsp;
                                                <a href="{{route('staff.delete',encrypt($staff->userid))}}" class="btn btn-default btn-xs" onclick="return confirmDelete()" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                                &nbsp;&nbsp;
                                                <a href="{{route('staff.editjoining',encrypt($staff->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                        <?php $srno++;?>
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

    $(document).ready(function(){
        $('#staff_table').DataTable({
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
