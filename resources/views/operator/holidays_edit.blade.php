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
                <li><a href="{{route('holiday')}}">Holiday</a></li>
                <li class="active">Edit Holiday</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Holiday</h3>
                        </div>
                        <form action="{{route('holiday.editholiday')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group" hidden>
                                    <label for="id">ID</label><small class="req"> *</small>
                                    <input type="text" id="id" name="id" class="form-control" required value="{{$holiday->id}}" />
                                </div>
                                <div class="form-group">
                                    <label for="hdate">Date</label><small class="req"> *</small>
                                    <input type="text" id="hdate" name="hdate" class="form-control" required autofocus value="{{$holiday->hdate}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="reason">Reason</label><small class="req"> *</small>
                                    <input type="text" id="reason" name="reason" class="form-control" required value="{{$holiday->reason}}"/>
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
                            <h3 class="box-title">Holidays List</h3>
                        </div>
                        <div class="box-body">
                            <table id="holiday_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Holiday Date</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($holidays))
                                    @foreach($holidays as $holiday)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$holiday->hdate}}</td>
                                            <td>{{$holiday->reason}}</td>
                                            <td>
                                                <a href="{{url('/holiday/edit/'.encrypt($holiday->id))}}"><button class=" btn btn-success" title="Edit holiday"><i class="fa fa-pencil"></i> Edit</button></a>
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
    $(function () {
        $('#hdate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    $(document).ready(function(){
        $('#holiday_table').DataTable({
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
