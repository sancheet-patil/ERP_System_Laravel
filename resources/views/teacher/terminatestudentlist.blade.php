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
