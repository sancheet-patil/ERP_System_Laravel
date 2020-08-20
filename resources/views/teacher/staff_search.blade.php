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
                <li class="active">Staff Search</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Staff Search</h3>
                        </div>
                        <div class="box-body">
                            @if($message = Session::get('success'))
                                <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="staff_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Staff ID</th>
                                        <th>Staff Role</th>
                                        <th>Designation</th>
                                        <th>Staff name</th>
                                        <th>Father name</th>
                                        <th>Mother name</th>
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
                                        <th>Address</th>
                                        <th>EPF No.</th>
                                        <th>Basic salary</th>
                                        <th>Contract type</th>
                                        <th>Bank Acct. No.</th>
                                        <th>Bank Name</th>
                                        <th>Bank IFSC</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($stafflist as $staff)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$staff->staffid}}</td>
                                            <td>{{$staff->staffrole}}</td>
                                            <td>
                                                <?php
                                                    $designation = \App\DesignationLists::where('id',$staff->designation)->value('designation');
                                                ?>
                                                {{$designation}}
                                            </td>
                                            <td>{{$staff->fname.' '.$staff->mname.' '.$staff->lname}}</td>
                                            <td>{{$staff->mname}}</td>
                                            <td>{{$staff->mothername}}</td>
                                            <td>{{$staff->dob}}</td>
                                            <td>{{$staff->gender}}</td>
                                            <?php
                                            $castecategory = \App\CasteCategoryList::where('id',$staff->subcaste)->first();
                                            $religion = \App\ReligionLists::where('id',$castecategory['religion'])->value('religion');
                                            $category = \App\CategoryLists::where('id',$castecategory['category'])->value('category');
                                            ?>
                                            <td>{{$religion}}</td>
                                            <td>{{$category}}</td>
                                            <td>{{$castecategory['castename']}}</td>
                                            <td>{{$castecategory['subcaste']}}</td>
                                            <td>{{$staff->mobile}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>{{$staff->aadhar}}</td>
                                            <td>{{$staff->placeob}}</td>
                                            <td>{{$staff->mothertongue}}</td>
                                            <td>{{$staff->bloodgroup}}</td>
                                            <td>{{$staff->shalarthid}}</td>
                                            <td>{{$staff->joiningdate}}</td>
                                            <td>{{$staff->currentaddress}}</td>
                                            <td>{{$staff->epfno}}</td>
                                            <td>{{$staff->basicsalary}}</td>
                                            <td>{{$staff->contracttype}}</td>
                                            <td>{{$staff->accountno}}</td>
                                            <td>{{$staff->bankname}}</td>
                                            <td>{{$staff->bankifsccode}}</td>
                                            <td>
                                                <a href="{{route('staff.view',encrypt($staff->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                &nbsp;&nbsp;
                                                <a href="{{route('staff.delete',encrypt($staff->userid))}}" class="btn btn-default btn-xs" onclick="return confirmDelete()" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                                &nbsp;&nbsp;
                                                <a href="{{route('staff.editsearch',encrypt($staff->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                        <?php $srno++;?>
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
            'autoWidth'   : true,
            'aaSorting'     : [],
        });
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
