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
                <li class="active">Classes</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Class</h3>
                        </div>
                        <form action="{{route('classes.add')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group">
                                    <label for="classname">Class Name </label><small class="req"> *</small>
                                    <select class="form-control select2" id="classname" name="classname" style="width:100%;" required>
                                        <option value="">Select</option>
                                        @for($i=1;$i<=12;$i++)
                                            <option value="@if($i<10) 0{{$i}} @else {{$i}} @endif">@if($i<10) 0{{$i}} @else {{$i}} @endif</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="division">Division Name</label><small class="req"> *</small>
                                    <select class="form-control select2" id="division" name="division[]" style="width:100%;" required multiple>
                                        @if(isset($divisionlist))
                                            @foreach($divisionlist as $division)
                                                <option value="{{$division->division}}">{{$division->division}}</option>
                                            @endforeach
                                        @endif
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
                            <h3 class="box-title">Class List</h3>
                        </div>
                        <div class="box-body">
                            <table id="class_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Class</th>
                                    <th>Division</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($classlist))
                                    @foreach($classlist as $class)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$class->classname}}</td>
                                            <td>{!! $class->division !!}</td>
                                            <td>
                                                <a href="{{url('/classes/edit/'.encrypt($class->id))}}"><button class=" btn btn-success" title="Edit class"><i class="fa fa-pencil"></i> Edit</button></a>
{{--                                                <a href="{{url('/classes/delete/'.encrypt($class->id))}}"><button class=" btn btn-warning" title="Delete class" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button></a>--}}
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
        $('#class_table').DataTable({
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
    $(function () {
        $('.select2').select2()
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
