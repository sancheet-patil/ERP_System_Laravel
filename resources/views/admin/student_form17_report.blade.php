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
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Form 17 Students</h3>
                        </div>
                        <form method="post" action="{{route('form17studentreport.post')}}">
                            <div class="box-body">
                                <div class="form-group col-md-4">
                                    <label for="registerfor">Register for</label>
                                    <select id="registerfor" name="registerfor" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <option value="School Form 17">10 th class Form 17</option>
                                        <option value="College Form 17">12 th class Form 17</option>
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
                            <h3 class="box-title"><i class="fa fa-search"></i> Form 17 Student report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Academic year</th>
                                        <th>Register No.</th>
                                        <th>Register for</th>
                                        <th>Class</th>
                                        <th>Roll No.</th>
                                        <th>Student name</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Religion</th>
                                        <th>Category</th>
                                        <th>Caste</th>
                                        <th>Sub Caste</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($studentlist as $student)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$student->academicyear}}</td>
                                            <td>{{$student->registerno}}</td>
                                            <td>{{$student->registerfor}}</td>
                                            <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                            <td>{{$student->roll_no}}</td>
                                            <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                            <td>{{$student->dob}}</td>
                                            <td>{{$student->gender}}</td>
                                            <td>{{$student->religion}}</td>
                                            <td>{{$student->category}}</td>
                                            <td>{{$student->castename}}</td>
                                            <td>{{$student->subcaste}}</td>
                                            <td>{{$student->mobile}}</td>
                                            <td>{{$student->email}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if($registerfor)
                                <a href="{{url('form17studentreportexcel')}}?registerfor={{$registerfor}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
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
