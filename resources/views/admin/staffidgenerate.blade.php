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
                <li class="active">Staff ID Generate</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Staff ID Generate</h3>
                            <a href="{{route('staffidgenerate.bulk')}}" class="btn btn-info btn-sm pull-right">Bulk Generate</a>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="staff_table">
                                    <thead>
                                    <tr>
                                        <th>Staff ID</th>
                                        <th>Staff name</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Designation</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stafflist as $staff)
                                        <tr>
                                            <td>{{$staff->staffid}}</td>
                                            <td>{{$staff->fname.' '.$staff->lname}}</td>
                                            <td>{{$staff->dob}}</td>
                                            <td>{{$staff->gender}}</td>
                                            <td>{{$staff->designation}}</td>
                                            <td>{{$staff->mobile}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>
                                                <a href="{{route('staff.idgenerate',encrypt($staff->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
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
</script>
</body>
</html>
