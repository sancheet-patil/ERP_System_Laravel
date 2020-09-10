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
                <li class="active">Assign Examiner</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assign Examiner</h3>
                        </div>
                        <form action="{{route('assignexaminer.add')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group">
                                    <label for="registerfor">Register for </label><small class="req"> *</small>
                                    <select id="registerfor" name="registerfor" class="form-control select2" required autofocus>
                                        <option value="">Select</option>
                                        <option value="School">School</option>
                                        <option value="College">College</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="staffid">Staff Name </label><small class="req"> *</small>
                                    <select id="staffid" name="staffid" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $stafflist = \App\StaffDetails::orderBy('lname','asc')->get();
                                        ?>
                                        @foreach($stafflist as $staff)
                                            <option value="{{$staff->userid}}">{{$staff->lname.' '.$staff->fname.' '.$staff->mname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Examiner List</h3>
                        </div>
                        <div class="box-body">
                            <table id="class_teacher_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Academic year</th>
                                    <th>Register for</th>
                                    <th>Staff name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($examinerlist))
                                    @foreach($examinerlist as $item)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$item->academicyear}}</td>
                                            <td>{{$item->registerfor}}</td>
                                            <td>{{$item->lname.' '.$item->fname.' '.$item->mname}}</td>
                                            <td>
{{--                                                <a href="{{url('/assignexaminer/edit/'.encrypt($item->id))}}"><button class=" btn btn-success" title="Edit class teacher"><i class="fa fa-pencil"></i> Edit</button></a>--}}
                                                <a href="{{route('assignexaminer.delete',encrypt($item->id))}}"><button class=" btn btn-warning" title="Delete examiner" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button></a>
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
    $(document).ready(function(){
        $('#class_teacher_table').DataTable({
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

    $('#classname').change(function(){
        var classname = $(this).val();
        $.ajax({
            type:"get",
            url:"{{url('divisionlist')}}?classname="+classname,
            beforeSend:function(){
                $('#division').empty().append('<option value="">Select</option>')
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
            $('#faculty').prop('required',true);
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
            $('#faculty').removeAttr('required');
        }
    });

    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
