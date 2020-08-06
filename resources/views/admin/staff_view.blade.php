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
                <li><a href="{{route('staff.search')}}"> Staff Search</a></li>
                <li class="active">View</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-default">
                        <div class="box-body">
                            @if($staffdetails->staffphoto)
                                <img class="profile-user-img img-responsive img-circle" src="{{$staffdetails->staffphoto}}" alt="staff photo">
                            @else
                                <img class="profile-user-img img-responsive img-circle" src="{{asset('images/no_image.png')}}" alt="staff photo">
                            @endif
                            <h3 class="profile-username text-center">{{$staffdetails->fname.' '. $staffdetails->lname}}</h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Staff role</b> <a class="pull-right text-black">{{$staffdetails->staffrole}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Designation</b> <a class="pull-right text-black">{{$staffdetails->designation}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Marital status</b> <a class="pull-right text-black">{{$staffdetails->maritalstatus}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="pull-right text-black">{{$staffdetails->gender}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Blood Group</b> <a class="pull-right text-black">{{$staffdetails->bloodgroup}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>AADHAR</b> <a class="pull-right text-black">{{$staffdetails->aadhar}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>SALARTH ID</b> <a class="pull-right text-black">{{$staffdetails->shalarthid}}</a>
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
                            <li><a href="#tab_payroll" data-toggle="tab"> payroll details</a></li>
                            <li><a href="#tab_bank" data-toggle="tab"> Bank Details</a></li>
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
                                                            <td class="col-md-3">Joining Date</td>
                                                            <td>{{$staffdetails->joiningdate}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date of Birth</td>
                                                            <td>{{$staffdetails->dob}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mobile</td>
                                                            <td>{{$staffdetails->mobile}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{$staffdetails->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Religion</td>
                                                            <td>{{$staffdetails->religion}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Category</td>
                                                            <td>{{$staffdetails->category}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Caste</td>
                                                            <td>{{$staffdetails->castename}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sub-Caste</td>
                                                            <td>{{$staffdetails->subcaste}}</td>
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
                                                            <td>{{$staffdetails->currentaddress}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Permanent Address</td>
                                                            <td>{{$staffdetails->permanentaddress}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_payroll">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border bg-gray">
                                                <h2 class="box-title">Payroll Details</h2>
                                            </div>
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover cuspad">
                                                        <tr>
                                                            <td  class="col-md-3">EPF No.</td>
                                                            <td>{{$staffdetails->epfno}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Basic Salary</td>
                                                            <td>{{$staffdetails->basicsalary}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contract type</td>
                                                            <td>{{$staffdetails->contracttype}}</td>
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
                                                            <td  class="col-md-3">Account title</td>
                                                            <td>{{$staffdetails->accounttitle}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account No.</td>
                                                            <td>{{$staffdetails->accountno}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank IFSC code</td>
                                                            <td>{{$staffdetails->bankifsccode}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank name</td>
                                                            <td>{{$staffdetails->bankname}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank branch name</td>
                                                            <td>{{$staffdetails->bankbranchname}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank MICR code</td>
                                                            <td>{{$staffdetails->bankmicrcode}}</td>
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

<script>

</script>
</body>
</html>
