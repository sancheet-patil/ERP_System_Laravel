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
                <li class="active">Form 17 Leaving Certificate</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Issue Form 17 Leaving Cetificate</h3>
                        </div>
                        <form method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                @if(\Illuminate\Support\Facades\Session::get('registerfor') == 'College Form 17' || \Illuminate\Support\Facades\Session::get('registerfor') == 'College')
                                    <div class="form-group col-md-4">
                                        <label for="faculty">Faculty</label><small class="req"> *</small>
                                        <select name="faculty" id="faculty" required class="form-control">
                                            <option value="">Select</option>
                                            <option value="Arts">Arts</option>
                                            <option value="Commerce">Commerce</option>
                                            <option value="Science">Science</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group col-md-4">
                                    <label for="studentid">Student Name</label><small class="req"> *</small>
                                    <select id="studentid" name="studentid" class="form-control select2" required>
                                        <option>Select</option>
                                        @foreach($studentlist as $student)
                                            <option value="{{$student->userid}}">{{$student->fname.' '.$student->mname.' '.$student->lname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="registerfor">Register For</label><small class="req"> *</small>
                                    <input type="text" id="registerfor" class="form-control" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="registerno">Register No.</label><small class="req"> *</small>
                                    <input type="text" id="registerno" class="form-control" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="classname">Class</label><small class="req"> *</small>
                                    <input type="text" id="classname" name="classname" class="form-control" required readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dateofpassing">Date of Passing</label><small class="req"> *</small>
                                    <input type="text" id="dateofpassing" name="dateofpassing" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="examseatno">Exam Seat No.</label><small class="req"> *</small>
                                    <input type="text" id="examseatno" name="examseatno" class="form-control" required/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="examseatno">Student count</label><br>
                                    <span id="studentcount">
                                        Total students: <b>{{$totalcount}}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Male: <b>{{$boyscount}}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Female: <b>{{$girlscount}}</b>
                                    </span>
                                </div>
                            </div>
                            <div class="box-footer">
                                <span class="pull-right">
                                    @csrf
                                    <button formaction="{{route('form17lc.issue')}}" type="submit" class="btn btn-primary" onclick="selectall()">Save</button>
                                    <span style="margin: 5px"></span>
                                    <button formaction="{{route('form17lc.issue.print')}}" type="submit" class="btn btn-primary" onclick="selectall()">Save and print</button>
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
                            <table id="form17_lc_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Register for</th>
                                    <th>GR.No.</th>
                                    <th>Student name</th>
                                    <th>Mother name</th>
                                    <th>Nationality</th>
                                    <th>Mothertongue</th>
                                    <th>Religion</th>
                                    <th>Caste</th>
                                    <th>Subcaste</th>
                                    <th>Class</th>
                                    <th>Admission date</th>
                                    <th>Issue Date</th>
                                    <th>Last school</th>
                                    <th>Exam seat no.</th>
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
                                            <td>{{$lc->registerfor}}</td>
                                            <td>{{$lc->registerno}}</td>
                                            <td>{{$lc->fname.' '.$lc->mname.' '.$lc->lname}}</td>
                                            <td>{{$lc->mothername}}</td>
                                            <td>{{'Indian'}}</td>
                                            <td>{{$lc->mothertongue}}</td>
                                            <td>{{$lc->religion}}</td>
                                            <td>{{$lc->castename}}</td>
                                            <td>{{$lc->subcaste}}</td>
                                            <td>{{$lc->classname}}</td>
                                            <td>{{$lc->admission_date}}</td>
                                            <td>{{$lc->issuedate}}</td>
                                            <td>
                                                <?php
                                                if($lc->schoolname != 'Other') {
                                                    $lastschool = \App\OtherSchoolLists::where('id',$lc->schoolname)->value('schoolname');
                                                }
                                                else{
                                                    $lastschool = $lc->lastschool;
                                                }
                                                ?>
                                                {{$lastschool}}
                                            </td>
                                            <td>{{$lc->examseatno}}</td>
                                            <td>@if($lc->printcount > 0) 1 @else 0 @endif</td>
                                            <td>@if($lc->printcount > 1) {{$lc->printcount - 1}} @else 0 @endif</td>
                                            <td>
                                                <?php
                                                $maxlcprints = \App\SchoolInfos::where('id','1')->value('maxlc');
                                                ?>
                                                <a href="{{url('/form17lc/view/'.encrypt($lc->id))}}" target="_blank"><button class=" btn btn-primary" title="View"><i class="fa fa-eye"></i></button></a>
                                                @if($maxlcprints >= $lc->printcount)
                                                    <a href="{{url('/form17lc/print/'.encrypt($lc->id))}}"><button class=" btn btn-success" title="Print"><i class="fa fa-print"></i></button></a>
                                                @else
                                                    <button class=" btn btn-success" title="Print limit reached" disabled><i class="fa fa-print"></i></button>
                                                @endif
                                                <a href="{{url('/form17lc/edit/'.encrypt($lc->id))}}"><button class=" btn btn-info" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                                <a href="{{url('/form17lc/delete/'.encrypt($lc->id))}}"><button class=" btn btn-danger" title="Delete LC" onclick="return confirmDelete()"><i class="fa fa-trash"></i></button></a>
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

<script>
    $(function () {
        $('#leavingdate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
    $('#faculty').change(function(){
        $.ajax({
            type:"get",
            url:"{{url('form17lcunissuedstudents')}}?faculty=" + $('#faculty').val(),
            beforeSend:function(){
                $('#studentid').empty().append('<option value="">Select</option>');
            },
            success:function(data){
                for(var i=0;i<data.students.length;i++)
                {
                    $('#studentid').append('<option value="'+data.students[i].userid+'">'+data.students[i].fname+' '+data.students[i].mname+' '+data.students[i].lname+'</option>')
                }
                var studentcount = "Total students: <b>"+data.students.length+"</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                    "Male: <b>"+data.boyscount+"</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                    "Female: <b>"+data.girlscount+"</b>";
                $('#studentcount').html(studentcount)
            }
        });
    });
    $('#studentid').change(function(){
        $.ajax({
            type:"get",
            url:"{{url('studentdetails')}}?userid=" + $('#studentid').val(),
            beforeSend:function(){
            },
            success:function(data){
                $('#registerfor').val(data.registerfor);
                $('#registerno').val(data.registerno);
                $('#classname').val(data.classname);
                $('#faculty').val(data.faculty);
            }
        });
    });
    $(document).ready(function(){
        $('#form17_lc_table').DataTable({
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
</script>
</body>
</html>
