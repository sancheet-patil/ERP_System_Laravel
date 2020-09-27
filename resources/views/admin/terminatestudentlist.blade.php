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
                <li class="active">Student Terminate List</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Student Terminate List</h3>
                            <div class="box-tools pull-right">
                                <a href="{{route('student.terminate')}}" class="btn btn-github btn-sm"><i class="fa fa-plus"></i> Terminate Student</a>
                            </div>
                        </div>
                        <div class="box-body">
                            @if($message = Session::get('success'))
                                <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Register for</th>
                                        <th>Register no.</th>
                                        <th>Student name</th>
                                        <th>Class (Division)</th>
                                        <th>Remarks</th>
                                        <th>Termination date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @if(isset($studentlist))
                                        @foreach($studentlist as $student)
                                            <tr>
                                                <td>{{$srno}}</td>
                                                <?php $srno++;?>
                                                <td>{{$student->registerfor}}</td>
                                                <td>{{$student->registerno}}</td>
                                                <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                                <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                                <td>{{$student->remarks}}</td>
                                                <td>{{$student->dateofterminate}}</td>
                                                <td>
                                                    <button class="btn btn-default btn-xs" id="{{$student->userid}}" data-userid="{{$student->userid}}" data-leavingdate="{{$student->dateofterminate}}" data-remarks="{{$student->remarks}}" data-studentname="{{$student->fname.' '.$student->mname.' '.$student->lname}}" data-toggle="modal" data-target="#student-terminate-modal" onclick="filldata('{{$student->userid}}')" title="Terminate Approve"><i class="fa fa-check"></i></button>
                                                    <a href="{{route('student.terminate.reject',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" onclick="return confirmReject()" title="Terminate Reject"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="student-terminate-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('student.terminate.approve')}}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Student Terminate Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <label for="userid">Userid</label><small class="req"> *</small>
                            <input type="text" id="userid" name="userid" class="form-control" required readonly/>
                        </div>
                        <div class="form-group">
                            <label for="studentname">Student Name</label><small class="req"> *</small>
                            <input type="text" id="studentname" name="studentname" class="form-control" required readonly/>
                        </div>
                        <div class="form-group">
                            <label for="progress">Progress</label><small class="req"> *</small>
                            <input type="text" id="progress" name="progress" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="conduct">Conduct</label><small class="req"> *</small>
                            <input type="text" id="conduct" name="conduct" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="dateofleaving">Date of leaving</label><small class="req"> *</small>
                            <input type="text" id="dateofleaving" name="dateofleaving" class="form-control" required readonly/>
                        </div>
                        <div class="form-group">
                            <label for="reasonofleaving">Reason of leaving</label><small class="req"> *</small>
                            <input type="text" id="reasonofleaving" name="reasonofleaving" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label><small class="req"> *</small>
                            <input type="text" id="remarks" name="remarks" class="form-control" required readonly/>
                        </div>
                        <div class="form-group">
                            <label for="studyinginclass">Studying in class & since when</label><small class="req"> *</small>
                            <input type="text" id="studyinginclass" name="studyinginclass" class="form-control" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
    <div class="control-sidebar-bg"></div>
</div>
@include('layouts.scripts')

<script>
    function confirmApprove(){
        return confirm('Are you sure you want to approve termination?');
    }
    function confirmReject(){
        return confirm('Are you sure you want to reject termination?');
    }
    function filldata(userid){
        $('#userid').val(userid);
        $('#studentname').val($('#'+userid).data('studentname'));
        $('#remarks').val($('#'+userid).data('remarks'));
        $('#dateofleaving').val($('#'+userid).data('leavingdate'));

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
</script>
</body>
</html>
