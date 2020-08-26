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
                <li class="active">Leaving Certificate</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Leaving Cetificate</h3>
                        </div>
                        <form action="{{route('leavingcertificate.editlc')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4" hidden>
                                    <label for="userid">ID</label>
                                    <input type="text" class="form-control" id="userid" name="userid" value="{{$lc->userid}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="classname">Register No.</label>
                                    <input type="text" class="form-control" value="{{$lc->registerno}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="classname">Admission Class</label>
                                    <input type="text" class="form-control" value="{{$lc->admission_class}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label>
                                    <input type="text" class="form-control" id="division" name="division" value="{{$lc->division}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="saralid">SARAL ID</label>
                                    <input type="text" id="saralid" name="saralid" class="form-control" value="{{$lc->saralid}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="aadhar">AADHAR</label>
                                    <input type="text" id="aadhar" name="aadhar" class="form-control" value="{{$lc->aadhar}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lname">Last name</label> <small class="req"> *</small>
                                    <input type="text" id="lname" name="lname" class="form-control" value="{{$lc->lname}}" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fname">First name</label> <small class="req"> *</small>
                                    <input type="text" id="fname" name="fname" class="form-control" value="{{$lc->fname}}" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mname">Middle name</label>
                                    <input type="text" id="mname" name="mname" class="form-control" value="{{$lc->mname}}" required/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mothername">Mother Name</label>
                                    <input type="text" id="mothername" name="mothername" class="form-control" value="{{$lc->mothername}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mothertongue">Mothertongue</label>
                                    <input type="text" id="mothertongue" name="mothertongue" class="form-control" value="{{$lc->mothertongue}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="religion">Religion</label>
                                    <select id="religion" name="religion" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $religions = \App\ReligionLists::orderBy('religion','asc')->get();
                                        ?>
                                        @foreach($religions as $religion)
                                            <option value="{{$religion->id}}" @if($religion->id == $lc->religion) selected @endif>{{$religion->religion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="castename">Caste</label><small class="req"> *</small>
                                    <select id="castename" name="castename" class="form-control select2" required>
                                        <option value="">Select</option>
                                        @foreach($castelist as $caste)
                                            <option value="{{$caste->castename}}" @if($caste->castename == $lc->castename) selected @endif>{{$caste->castename}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="subcaste">Sub Caste</label><small class="req"> *</small>
                                    <select id="subcaste" name="subcaste" class="form-control select2" required>
                                        <option value="">Select</option>
                                        @foreach($subcastelist as $subcaste)
                                            <option value="{{$subcaste->id}}" @if($subcaste->id == $lc->subcaste) selected @endif>{{$subcaste->subcaste}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="placeob">Place of Birth</label>
                                    <input type="text" id="placeob" name="placeob" class="form-control" value="{{$lc->placeob}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" id="dob" name="dob" class="form-control" value="{{$lc->dob}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="schoolname">Last attended school</label> <small class="req"> *</small>
                                    <select id="schoolname" name="schoolname" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $schools = \App\OtherSchoolLists::orderBy('schoolname','asc')->get();
                                        ?>
                                        @foreach($schools as $school)
                                            <option value="{{$school->id}}" @if($school->id == $lc->schoolname) selected @endif>{{$school->schoolname}}</option>
                                        @endforeach
                                        <option value="Other" @if('Other' == $lc->schoolname) selected @endif>Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4" id="lastschooldiv" style="@if('Other' != $lc->schoolname) display: none; @endif">
                                    <label for="lastschool">Name of school/ college</label> <small class="req"> *</small>
                                    <input type="text" id="lastschool" name="lastschool" class="form-control" required value="{{$lc->lastschool}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="admission_date">Date of Admission</label>
                                    <input type="text" id="admission_date" name="admission_date" class="form-control" value="{{$lc->admission_date}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="progress">Progress</label>
                                    <input type="text" id="progress" name="progress" class="form-control" value="{{$lc->progress}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="conduct">Conduct</label>
                                    <input type="text" id="conduct" name="conduct" class="form-control" value="{{$lc->conduct}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dateofleaving">Date of leaving</label>
                                    <input type="text" id="dateofleaving" name="dateofleaving" class="form-control" value="{{$lc->dateofleaving}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="reasonofleaving">Reason of leaving</label>
                                    <input type="text" id="reasonofleaving" name="reasonofleaving" class="form-control" value="{{$lc->reasonofleaving}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" id="remarks" name="remarks" class="form-control" value="{{$lc->remarks}}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="studyinginclass">Studying in class & since when</label>
                                    <input type="text" id="studyinginclass" name="studyinginclass" class="form-control" value="{{$lc->studyinginclass}}"/>
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
    $(function () {
        $('#dateofleaving').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $('#dob').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $('#admission_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
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

    $(function () {
        $('.select2').select2()
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
