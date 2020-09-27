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
                <li class="active">Complaints</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Complaint</h3>
                        </div>
                        <form action="{{route('complaints.add')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                <div class="form-group">
                                    <label for="complaintby">Complaint by </label><small class="req"> *</small>
                                    <input type="text" id="complaintby" name="complaintby" class="form-control" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone </label><small class="req"> *</small>
                                    <input type="text" id="phone" name="phone" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="complaintdate">Complaint date</label>
                                    <input type="text" id="complaintdate" name="complaintdate" class="form-control" value="{{date('d-m-Y')}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description </label><small class="req"> *</small>
                                    <input type="text" id="description" name="description" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="assigned">Assigned</label>
                                    <input type="text" id="assigned" name="assigned" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="actiontaken">Action taken</label>
                                    <input type="text" id="actiontaken" name="actiontaken" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="complaintstatus">Complaint status</label>
                                    <select id="complaintstatus" name="complaintstatus" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Resolved">Resolved</option>
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
                            <h3 class="box-title">Complaints List</h3>
                        </div>
                        <div class="box-body">
                            <table id="complaints_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Complaint by</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Assigned</th>
                                    <th>Action taken</th>
                                    <th>Status</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($complaintslist))
                                    @foreach($complaintslist as $complaint)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$complaint->complaintby}}</td>
                                            <td>{{$complaint->phone}}</td>
                                            <td>{{$complaint->complaintdate}}</td>
                                            <td>{{$complaint->assigned}}</td>
                                            <td>{{$complaint->actiontaken}}</td>
                                            <td>{{$complaint->complaintstatus}}</td>
{{--                                            <td>--}}
{{--                                                <a href="{{url('/complaints/edit/'.encrypt($complaint->id))}}"><button class=" btn btn-success" title="Edit complaint"><i class="fa fa-pencil"></i></button></a>--}}
{{--                                                <a href="{{url('/complaints/delete/'.encrypt($complaint->id))}}"><button class=" btn btn-warning" title="Delete complaint" onclick="return confirmDelete()"><i class="fa fa-trash"></i></button></a>--}}
{{--                                            </td>--}}
                                        </tr>
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
        $('#complaints_table').DataTable({
            "scrollX"		: true,
            'paging'		: true,
            "processing"	: true,
            'searching'     : true,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            'aaSorting'     : [],
        });
    });
    $('#phone').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });
    $(function () {
        $('#complaintdate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
