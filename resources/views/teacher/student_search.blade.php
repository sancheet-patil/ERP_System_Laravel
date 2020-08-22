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
                <li class="active">Student Search</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Student Search</h3>
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
                                        <th>Academic year</th>
                                        <th>Register for</th>
                                        <th>Register no.</th>
                                        <th>Admission date</th>
                                        <th>Saral ID</th>
                                        <th>Class</th>
                                        <th>Roll No.</th>
                                        <th>Student name</th>
                                        <th>Father name</th>
                                        <th>Mother name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
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
                                        <th>Last School</th>
                                        <th>Previous LC No.</th>
                                        <th>Previous Registration No.</th>
                                        <th>Address</th>
                                        <th>Bank Account No.</th>
                                        <th>Bank Name</th>
                                        <th>Bank IFSC code</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($studentlist as $student)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$student->academicyear}}</td>
                                            <td>{{$student->registerfor}}</td>
                                            <td>{{$student->registerno}}</td>
                                            <td>{{$student->admission_date}}</td>
                                            <td>{{$student->saralid}}</td>
                                            <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                            <td>{{$student->roll_no}}</td>
                                            <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                            <td>{{$student->fathername}}</td>
                                            <td>{{$student->mothername}}</td>
                                            <td>{{$student->gender}}</td>
                                            <td>{{$student->dob}}</td>
                                            <?php
                                            $castecategory = \App\CasteCategoryList::where('id',$student->subcaste)->first();
                                            $religion = \App\ReligionLists::where('id',$castecategory['religion'])->value('religion');
                                            $category = \App\CategoryLists::where('id',$castecategory['category'])->value('category');
                                            ?>
                                            <td>{{$religion}}</td>
                                            <td>{{$category}}</td>
                                            <td>{{$castecategory['castename']}}</td>
                                            <td>{{$castecategory['subcaste']}}</td>
                                            <td>{{$student->mobile}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->aadhar}}</td>
                                            <td>{{$student->placeob}}</td>
                                            <td>{{$student->mothertongue}}</td>
                                            <td>{{$student->bloodgroup}}</td>
                                            <td>
                                                <?php
                                                $lastschool = \App\OtherSchoolLists::where('id',$student->lastschool)->value('schoolname');
                                                ?>
                                                {{$lastschool}}
                                            </td>
                                            <td>{{$student->previouslcno}}</td>
                                            <td>{{$student->previousgrno}}</td>
                                            <td>{{$student->currentaddress}}</td>
                                            <td>{{$student->accountno}}</td>
                                            <td>{{$student->bankname}}</td>
                                            <td>{{$student->bankifsccode}}</td>
                                            <td>
                                                <a href="{{route('student.view',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('student.editsearch',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
{{--                                                <a href="{{route('student.delete',encrypt($student->userid))}}" class="btn btn-default btn-xs" data-toggle="tooltip" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash"></i></a>--}}
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
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
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
