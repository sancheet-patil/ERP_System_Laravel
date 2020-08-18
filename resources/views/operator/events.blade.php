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
                <li class="active">Events</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Event</h3>
                        </div>
                        <form action="{{route('event.add')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group">
                                    <label for="ename">Event name</label><small class="req"> *</small>
                                    <input type="text" id="ename" name="ename" class="form-control" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="edate">Date</label><small class="req"> *</small>
                                    <input type="text" id="edate" name="edate" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="details">Details</label><small class="req"> *</small>
                                    <input type="text" id="details" name="details" class="form-control" required/>
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
                            <h3 class="box-title">Events List</h3>
                        </div>
                        <div class="box-body">
                            <table id="events_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($events))
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$event->ename}}</td>
                                            <td>{{$event->edate}}</td>
                                            <td>{{$event->details}}</td>
                                            <td>
                                                <a href="{{url('/event/edit/'.encrypt($event->id))}}"><button class=" btn btn-success" title="Edit event"><i class="fa fa-pencil"></i> </button></a>
{{--                                                <a href="{{url('/event/delete/'.encrypt($event->id))}}"><button class=" btn btn-warning" title="Delete event" onclick="return confirmDelete()"><i class="fa fa-trash"></i> </button></a>--}}
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
        $('#edate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    $(document).ready(function(){
        $('#events_table').DataTable({
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
