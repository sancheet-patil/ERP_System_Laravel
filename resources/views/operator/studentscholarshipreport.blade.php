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
                <li class="active">Scholarship Report report</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Scholarship Report</h3>
                        </div>
                        <form method="post" action="{{route('studentscholarshipreport.post')}}">
                            <div class="box-body">
                                <div class="form-group col-md-6">
                                    <label for="scholarshipname">Scholarship name</label>
                                    <select id="scholarshipname" name="scholarshipname" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $scholarshiplist = \App\ScholarshipLists::orderBy('scholarshipname','asc')->get();
                                        ?>
                                        @foreach($scholarshiplist as $scholarship)
                                            <option value="{{$scholarship->id}}" @if(isset($scholarshipname)) @if($scholarship->id == $scholarshipname) selected @endif @endif>{{$scholarship->scholarshipname}}</option>
                                        @endforeach
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
                            <h3 class="box-title"><i class="fa fa-search"></i> Bonafide issue report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="student_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Reg. No.</th>
                                        <th>Student Name</th>
                                        <th>Class (Division)</th>
                                        <th>Scholarship Name</th>
                                        <th>Scholarship per month</th>
                                        <th>Scholarship no of month</th>
                                        <th>Total Scholarship</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $male = 0;
                                    $female = 0;
                                    $srno = 1;
                                    ?>
                                    @if(isset($studentlist))
                                        @foreach($studentlist as $student)
                                            <tr>
                                                <td>{{$srno}}</td>
                                                <td>{{$student->registerno}}</td>
                                                <td>{{$student->fname.' '.$student->mname.' '.$student->lname}}</td>
                                                <td>{{$student->classname.' ('.$student->division.')'}}</td>
                                                <td>{{$student->scholarshipname}}</td>
                                                <td>{{$student->scholarshipamount}}</td>
                                                <td>{{$student->noofmonths}}</td>
                                                <td>{{$student->scholarshipamount * $student->noofmonths}}</td>
                                            </tr>
                                            <?php
                                            if($student->gender == 'Male'){
                                                $male++;
                                            }
                                            else if($student->gender == 'Female'){
                                                $female++;
                                            }
                                            $srno++;
                                            ?>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="alert alert-danger">
                                Total Students: <b><?php echo $male+$female; ?></b><br>
                                Total Male: <b><?php echo $male ?></b><br>
                                Total Female: <b><?php echo $female; ?></b>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if(isset($studentlist))
                                <a href="{{route('studentscholarshipreportexcel')}}?scholarshipname={{$scholarshipname}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
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
    $('#classname').change(function(){
        var classname = $(this).val();
        $.ajax({
            type:"get",
            url:"{{url('divisionlist')}}?classname=" + classname,
            beforeSend:function(){
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
        if(classname > '10') {
            document.getElementById("facultydiv").style.display = "block";
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
        }
    });
    $('#registerfor').change(function () {
        var registerfor = $('#registerfor').val();
        if(registerfor === 'College') {
            document.getElementById("facultydiv").style.display = "block";
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
        }
    });

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
