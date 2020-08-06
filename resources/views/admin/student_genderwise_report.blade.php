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
                <li class="active">Student report</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Students by Gender</h3>
                        </div>
                        <form method="post" action="{{route('genderwisestudentreport.post')}}">
                            <div class="box-body">
                                <div class="form-group col-md-4">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="form-control select2" >
                                        <option value="">Select</option>
                                        <option value="Male" @if('Male' == $gender) selected @endif>Male</option>
                                        <option value="Female" @if('Female' == $gender) selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Student gender wise report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Register no.</th>
                                        <th>Admission date</th>
                                        <th>Saral ID</th>
                                        <th>Class</th>
                                        <th>Roll No.</th>
                                        <th>Student name</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($studentlist as $student)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$student->registerno}}</td>
                                            <td>{{$student->admission_date}}</td>
                                            <td>{{$student->saralid}}</td>
                                            <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                            <td>{{$student->roll_no}}</td>
                                            <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                            <td>{{$student->gender}}</td>
                                            <td>{{$student->dob}}</td>
                                            <td>{{$student->religion}}</td>
                                            <td>{{$student->category}}</td>
                                            <td>{{$student->castename}}</td>
                                            <td>{{$student->subcaste}}</td>
                                            <td>{{$student->mobile}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->aadhar}}</td>
                                            <td>{{$student->placeob}}</td>
                                            <td>{{$student->mothertongue}}</td>
                                            <td>{{$student->bloodgroup}}</td>
                                        </tr>
                                        <?php $srno++;?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if($gender)
                                <a href="{{url('genderwisestudentreportexcel')}}?gender={{$gender}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
                            @endif
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

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
