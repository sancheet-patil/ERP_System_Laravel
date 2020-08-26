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
                            <h3 class="box-title">Issue Leaving Cetificate</h3>
                        </div>
                        <form method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4">
                                    <label for="classname">Class</label><small class="req"> *</small>
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
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label><small class="req"> *</small>
                                    <select id="division" name="division" class="form-control select2" required>
                                    </select>
                                </div>
                                @if(\Illuminate\Support\Facades\Session::get('registerfor') == 'College')
                                    <div class="form-group col-md-4" id="facultydiv">
                                        <label for="faculty">Faculty</label>
                                        <select id="faculty" name="faculty" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Arts">Arts</option>
                                            <option value="Commerce">Commerce</option>
                                            <option value="Science">Science</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="container col-md-12">
                                    <h3 style="margin: 0 0 10px 0; text-align: center;">Select students to issue LC</h3>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select name="from[]" id="undo_redo" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="unselectedstudents"></span>
                                        </div>
                                        <div class="col-md-2">
                                            {{--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>--}}
                                            <button type="button" id="undo_redo_rightAll" class="btn btn-primary btn-block">Get all</button>
                                            <button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block">Get selected</button>
                                            <button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block">Put selected</button>
                                            <button type="button" id="undo_redo_leftAll" class="btn btn-danger btn-block">Put all</button>
                                            {{--<button type="button" id="undo_redo_redo" class="btn btn-warning btn-block">redo</button>--}}
                                        </div>
                                        <div class="col-md-5">
                                            <select name="to[]" id="undo_redo_to" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="selectedstudents"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="progress">Progress</label><small class="req"> *</small>
                                    <input type="text" id="progress" name="progress" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="conduct">Conduct</label><small class="req"> *</small>
                                    <input type="text" id="conduct" name="conduct" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dateofleaving">Date of leaving</label><small class="req"> *</small>
                                    <input type="text" id="dateofleaving" name="dateofleaving" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="reasonofleaving">Reason of leaving</label><small class="req"> *</small>
                                    <input type="text" id="reasonofleaving" name="reasonofleaving" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="remarks">Remarks</label><small class="req"> *</small>
                                    <input type="text" id="remarks" name="remarks" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="studyinginclass">Studying in class & since when</label><small class="req"> *</small>
                                    <input type="text" id="studyinginclass" name="studyinginclass" class="form-control" required/>
                                </div>
                            </div>
                            <div class="box-footer">
                                <span class="pull-right">
                                    @csrf
                                    <button formaction="{{route('leavingcertificate.issue')}}" type="submit" class="btn btn-primary" onclick="selectall()">Save</button>
                                    <span style="margin: 5px"></span>
                                    <button formaction="{{route('leavingcertificate.issue.print')}}" type="submit" class="btn btn-primary" onclick="selectall()">Save and print</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Issued LC List</h3>
                        </div>
                        <div class="box-body">
                            <table id="leavingcertificate_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>GR.No.</th>
                                    <th>Saral ID</th>
                                    <th>AADHAR</th>
                                    <th>Student name</th>
                                    <th>Mother name</th>
                                    <th>Mothertongue</th>
                                    <th>Religion</th>
                                    <th>Caste</th>
                                    <th>Subcaste</th>
                                    <th>Date of Birth</th>
                                    <th>Class (Division)</th>
                                    <th>Admission date</th>
                                    <th>Last school</th>
                                    <th>Issue Date</th>
                                    <th>Progress</th>
                                    <th>Conduct</th>
                                    <th>Date of leaving</th>
                                    <th>Reason of leaving</th>
                                    <th>Standard in studying and since when</th>
                                    <th>Remarks</th>
                                    <th>Original</th>
                                    <th>Duplicate</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($lclist))
                                    @foreach($lclist as $lc)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$lc->registerno}}</td>
                                            <td>{{$lc->saralid}}</td>
                                            <td>{{$lc->aadhar}}</td>
                                            <td>{{$lc->fname.' '.$lc->mname.' '.$lc->lname}}</td>
                                            <td>{{$lc->mothername}}</td>
                                            <td>{{$lc->mothertongue}}</td>
                                            <td>{{$lc->religion}}</td>
                                            <td>{{$lc->castename}}</td>
                                            <td>{{$lc->subcaste}}</td>
                                            <td>{{$lc->dob}}</td>
                                            <td>{{$lc->admission_class}}</td>
                                            <td>{{$lc->admission_date}}</td>
                                            <td>
                                                <?php
                                                $lastschool = \App\OtherSchoolLists::where('id',$lc->lastschool)->value('schoolname');
                                                ?>
                                                {{$lastschool}}
                                            </td>
                                            <td>{{$lc->issuedate}}</td>
                                            <td>{{$lc->progress}}</td>
                                            <td>{{$lc->conduct}}</td>
                                            <td>{{$lc->dateofleaving}}</td>
                                            <td>{{$lc->reasonofleaving}}</td>
                                            <td>{{$lc->studyinginclass}}</td>
                                            <td>{{$lc->remarks}}</td>
                                            <td>@if($lc->printcount > 0) 1 @else 0 @endif</td>
                                            <td>@if($lc->printcount > 1) {{$lc->printcount - 1}} @else 0 @endif</td>
                                            <td>
                                                <?php
                                                $maxlcprints = \App\SchoolInfos::where('id','1')->value('maxlc');
                                                ?>
                                                <a href="{{url('/leavingcertificate/view/'.encrypt($lc->id))}}" target="_blank"><button class=" btn btn-primary" title="View"><i class="fa fa-eye"></i></button></a>
                                                @if($maxlcprints >= $lc->printcount)
                                                    <a href="{{url('/leavingcertificate/print/'.encrypt($lc->id))}}"><button class=" btn btn-success" title="Print"><i class="fa fa-print"></i></button></a>
                                                @else
                                                    <button class=" btn btn-success" title="Print limit reached" disabled><i class="fa fa-download"></i></button>
                                                @endif
                                                <a href="{{url('/leavingcertificate/edit/'.encrypt($lc->id))}}"><button class=" btn btn-info" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                                <a href="{{url('/leavingcertificate/delete/'.encrypt($lc->id))}}"><button class=" btn btn-danger" title="Delete" onclick="return confirmDelete()"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                        <?php $srno++;?>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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

<script src="{{asset('js/multiselect.js')}}"></script>

<script>
    $(function () {
        $('#leavingdate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
    $('#classname').change(function(){
        $.ajax({
            type:"get",
            url:"{{url('divisionlist')}}?classname=" + $('#classname').val(),
            beforeSend:function(){
                $("#undo_redo").empty();
                $("#undo_redo_to").empty();
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
    $('#division').change(function(){
        if($('#classname').val() > '10'){
            return;
        }
        $.ajax({
            type:"get",
            url:"{{url('unissuedlc')}}?classname=" + $('#classname').val()+'&division='+$('#division').val(),
            beforeSend:function(){
                $("#undo_redo").empty();
                $("#undo_redo_to").empty();
            },
            success:function(data){
                if(data){
                    for(var i=0;i<data.length;i++){
                        $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].lname+' '+data[i].fname+' '+data[i].mname+'</option>');
                    }
                }
                if (data.length === 0){
                    alert('Student not present or LC already issued');
                }
            }
        });
    });
    $('#faculty').change(function(){
        $.ajax({
            type:"get",
            url:"{{url('collegeunissuedlc')}}?classname=" + $('#classname').val()+'&division='+$('#division').val()+'&faculty='+$('#faculty').val(),
            beforeSend:function(){
                $("#undo_redo").empty();
                $("#undo_redo_to").empty();
            },
            success:function(data){
                if(data){
                    for(var i=0;i<data.length;i++){
                        $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].lname+' '+data[i].fname+' '+data[i].mname+'</option>');
                    }
                }
                if (data.length === 0){
                    alert('Student not present or LC already issued');
                }
            }
        });
    });
    $(document).ready(function(){
        $('#leavingcertificate_table').DataTable({
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
    $(function () {
        $('.select2').select2()
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
    $(document).ready(function() {
        $('#undo_redo').multiselect();
    });
    function selectall() {
        $('#undo_redo option').prop('selected', true);
        $('#undo_redo_to option').prop('selected', true);
    }

    function getboxdetails() {
        var unselectedmale = 0;
        var unselectedfemale = 0;
        var selectedmale = 0;
        var selectedfemale = 0;
        $('#undo_redo > option').each(function() {
            var gender = $(this).data('gender');

            if(gender === 'Male'){
                unselectedmale+=1;
            }
            if(gender === 'Female'){
                unselectedfemale+=1;
            }
        });
        $('#undo_redo_to > option').each(function() {
            var gender = $(this).data('gender');

            if(gender === 'Male'){
                selectedmale+=1;
            }
            if(gender === 'Female'){
                selectedfemale+=1;
            }
        });

        var unselected = "Total students in box: <b>"+$('#undo_redo > option').length+"</b><br>Male: <b>"+unselectedmale+"</b> and Female: <b>"+unselectedfemale+"</b>";
        var selected = "Total students in box: <b>"+$('#undo_redo_to > option').length+"</b><br>Male: <b>"+selectedmale+"</b> and Female: <b>"+selectedfemale+"</b>";
        $('#unselectedstudents').html(unselected);
        $('#selectedstudents').html(selected);
    }

    window.setInterval(function(){
        getboxdetails();
    }, 1000);
</script>
</body>
</html>
