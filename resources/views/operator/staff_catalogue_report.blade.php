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
                <li class="active">Staff report</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Staff catalogue report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="staff_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. no.</th>
                                        <th>Staff ID</th>
                                        <th>Staff Role</th>
                                        <th>Designation</th>
                                        <th>Staff name</th>
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
                                        <th>Current address</th>
                                        <th>Bank Account No.</th>
                                        <th>Bank Name</th>
                                        <th>Bank IFSC code</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($stafflist as $staff)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$staff->staffid}}</td>
                                            <td>{{$staff->staffrole}}</td>
                                            <td>{{$staff->designation}}</td>
                                            <td>{{$staff->fname.' '.$staff->mname.' '.$staff->lname}}</td>
                                            <td>{{$staff->dob}}</td>
                                            <td>{{$staff->gender}}</td>
                                            <td>{{$staff->religion}}</td>
                                            <td>{{$staff->category}}</td>
                                            <td>{{$staff->castename}}</td>
                                            <td>{{$staff->subcaste}}</td>
                                            <td>{{$staff->mobile}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>{{$staff->aadhar}}</td>
                                            <td>{{$staff->placeob}}</td>
                                            <td>{{$staff->mothertongue}}</td>
                                            <td>{{$staff->bloodgroup}}</td>
                                            <td>{{$staff->shalarthid}}</td>
                                            <td>{{$staff->joiningdate}}</td>
                                            <td>{{$staff->currentaddress}}</td>
                                            <td>{{$staff->accountno}}</td>
                                            <td>{{$staff->bankname}}</td>
                                            <td>{{$staff->bankifsccode}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{url('staffcataloguereportexcel')}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
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

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
