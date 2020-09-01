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
                <li class="active">Scholarship</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Scholarship</h3>
                        </div>
                        <form action="{{route('scholarship.add')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group">
                                    <label for="scholarshipname">Scholarship Name </label><small class="req"> *</small>
                                    <input type="text" id="scholarshipname" name="scholarshipname" class="form-control" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="applicablefor">Applicable for</label><small class="req"> *</small>
                                    <select class="form-control select2" id="applicablefor" name="applicablefor[]" style="width:100%;" required multiple>
                                        @if(isset($applicablefor))
                                            @foreach($applicablefor as $for)
                                                <option value="{{$for}}">{{substr($for,2)}}</option>
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
                            <h3 class="box-title">Scholarship List</h3>
                        </div>
                        <div class="box-body">
                            <table id="scholarship_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Scholarship name</th>
                                    <th>Applicable for</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($scholarshiplist))
                                    @foreach($scholarshiplist as $scholarship)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$scholarship->scholarshipname}}</td>
                                            <td>
                                                @foreach(explode(',',$scholarship->applicablefor) as $for)
                                                    {{substr($for,2)}} @if(!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{url('/scholarship/edit/'.encrypt($scholarship->id))}}"><button class=" btn btn-success" title="Edit scholarship"><i class="fa fa-pencil"></i> </button></a>
                                                <a href="{{url('/scholarship/delete/'.encrypt($scholarship->id))}}"><button class=" btn btn-warning" title="Delete scholarship" onclick="return confirmDelete()"><i class="fa fa-trash"></i> </button></a>
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
        $('#scholarship_table').DataTable({
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
