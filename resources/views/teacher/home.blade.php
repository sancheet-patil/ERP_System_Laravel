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
                <li><i class="fa fa-dashboard"></i> Home</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <a href="{{'#'}}">
                                    <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Admin</span>
                                    <?php
                                    $admincount = \App\StaffDetails::where('staffrole','Admin')->get()->count();
                                    ?>
                                    <span class="info-box-number">{{$admincount}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <a href="{{'#'}}">
                                    <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Teacher</span>
                                    <?php
                                    $teachercount = \App\StaffDetails::where('staffrole','Teacher')->get()->count();
                                    ?>
                                    <span class="info-box-number">{{$teachercount}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <a href="{{'#'}}">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Student</span>
                                    <?php
                                    $studentcount = \App\StudentDetails::where('academicyear',\Illuminate\Support\Facades\Session::get('academicyear'))
                                        ->get()->count();
                                    ?>
                                    <span class="info-box-number">{{$studentcount}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <a href="{{'#'}}">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Operator</span>
                                    <?php
                                    $operatorcount = \App\StaffDetails::where('staffrole','Operator')->get()->count();
                                    ?>
                                    <span class="info-box-number">{{$operatorcount}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <a href="{{'#'}}">
                                    <span class="info-box-icon bg-purple"><i class="fa fa-sticky-note"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Issued Bonafide</span>
                                    <?php
                                    $issuedbonafidecount = \App\BonafideDetails::where('academicyear',\Illuminate\Support\Facades\Session::get('academicyear'))->get()->count();
                                    ?>
                                    <span class="info-box-number">{{$issuedbonafidecount}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <a href="{{'#'}}">
                                    <span class="info-box-icon bg-purple"><i class="fa fa-sticky-note"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Issued LC</span>
                                    <?php
                                    $issuedlccount = \App\LeavingCertificateDetails::where('academicyear',\Illuminate\Support\Facades\Session::get('academicyear'))->get()->count();
                                    ?>
                                    <span class="info-box-number">{{$issuedlccount}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-content">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Good day {{Auth::user()->name}}.</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    @if($message = Session::get('success'))
                                        <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                    @endif
                                    {!! Session::forget('success') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <a href="{{'#'}}">
                                <span class="info-box-icon bg-purple"><i class="fa fa-sticky-note"></i></span>
                            </a>
                            <div class="info-box-content">
                                <span class="info-box-text">Form 17 Issued LC</span>
                                <?php
                                $issuedlccount = \App\Form17LcDetails::where('academicyear',\Illuminate\Support\Facades\Session::get('academicyear'))->get()->count();
                                ?>
                                <span class="info-box-number">{{$issuedlccount}}</span>
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
