<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{config('app.name')}}</title>

    @include('layouts.links')

    <style>
        .table {
            margin-bottom: 0px;
        }
        .table>tbody>tr>td {
            padding: 5px 0px 5px 8px;
        }
        .table>tbody>tr>th {
            padding: 5px 0px 5px 8px;
        }
        .box-header {
            padding: 5px 0px 5px 10px;
            position: relative;
        }
    </style>

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
                <li class="active">View</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-default">
                        <div class="box-body">
                            @if($studentdetails->studentphoto)
                                <img class="profile-user-img img-responsive img-circle" src="{{$studentdetails->studentphoto}}" alt="Student photo">
                            @else
                                <img class="profile-user-img img-responsive img-circle" src="{{asset('images/no_image.png')}}" alt="Student photo">
                            @endif
                            <h3 class="profile-username text-center">{{$studentdetails->fname.' '. $studentdetails->mname.' '. $studentdetails->lname}}</h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Register No.</b> <a class="pull-right text-black">{{$studentdetails->registerno}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Roll No.</b> <a class="pull-right text-black">{{$studentdetails->roll_no}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Class</b> <a class="pull-right text-black">{{$studentdetails->classname}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Section</b> <a class="pull-right text-black">{{$studentdetails->division}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="pull-right text-black">{{$studentdetails->gender}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Blood Group</b> <a class="pull-right text-black">{{$studentdetails->bloodgroup}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_profile" data-toggle="tab"> Profile</a></li>
                            <li><a href="#tab_address" data-toggle="tab"> Address details</a></li>
                            <li><a href="#tab_guardian" data-toggle="tab"> Guardian details</a></li>
                            <li><a href="#tab_bank" data-toggle="tab"> Bank details</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_profile">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border bg-gray">
                                                <h3 class="box-title">Basic Details</h3>
                                            </div>
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <td class="col-md-3">Admission Date</td>
                                                            <td>{{$studentdetails->admission_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date of Birth</td>
                                                            <td>{{$studentdetails->dob}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mobile</td>
                                                            <td>{{$studentdetails->mobile}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{$studentdetails->email}}</td>
                                                        </tr>
                                                        <?php
                                                        $castecategory = \App\CasteCategoryList::where('id',$studentdetails->subcaste)->first();
                                                        $religion = \App\ReligionLists::where('id',$castecategory['religion'])->value('religion');
                                                        $category = \App\CategoryLists::where('id',$castecategory['category'])->value('category');
                                                        ?>
                                                        <tr>
                                                            <td>Category</td>
                                                            <td>{{$category}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Religion</td>
                                                            <td>{{$religion}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Caste</td>
                                                            <td>{{$castecategory['castename']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Subcaste</td>
                                                            <td>{{$castecategory['subcaste']}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_address">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border bg-gray">
                                                <h2 class="box-title">Address Details</h2>
                                            </div>
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover cuspad">
                                                        <tr>
                                                            <td class="col-md-3">Current Address</td>
                                                            <td>{{$studentdetails->currentaddress}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Permanent Address</td>
                                                            <td>{{$studentdetails->permanentaddress}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_guardian">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border bg-gray">
                                                <h2 class="box-title">Parent/ Gaurdian Details</h2>
                                            </div>
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover cuspad">
                                                        <tr>
                                                            <td  class="col-md-3">Father Name</td>
                                                            <td>{{$studentdetails->fathername}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Father Phone</td>
                                                            <td>{{$studentdetails->fatherphone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Father Occupation</td>
                                                            <td>{{$studentdetails->fatheroccupation}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mother Name</td>
                                                            <td>{{$studentdetails->mothername}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mother Phone</td>
                                                            <td>{{$studentdetails->motherphone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mother Occupation</td>
                                                            <td>{{$studentdetails->motheroccupation}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guardian Name</td>
                                                            <td>{{$studentdetails->guardianname}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guardian Phone</td>
                                                            <td>{{$studentdetails->guardianphone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guardian Relation</td>
                                                            <td>{{$studentdetails->guardianrelation}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guardian Occupation</td>
                                                            <td>{{$studentdetails->guardianoccupation}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guardian Address</td>
                                                            <td>{{$studentdetails->guardianaddress}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_bank">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border bg-gray">
                                                <h2 class="box-title">Bank Details</h2>
                                            </div>
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover cuspad">
                                                        <tr>
                                                            <td class="col-md-3">Account title</td>
                                                            <td>{{$studentdetails->accounttitle}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account No.</td>
                                                            <td>{{$studentdetails->accountno}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank IFSC Code</td>
                                                            <td>{{$studentdetails->bankifsccode}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank Name</td>
                                                            <td>{{$studentdetails->bankname}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank Branch Name</td>
                                                            <td>{{$studentdetails->bankbranchname}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank MICR Code</td>
                                                            <td>{{$studentdetails->bankmicrcode}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

</body>
</html>
