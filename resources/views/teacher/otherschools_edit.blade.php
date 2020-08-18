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
                <li><a href="{{route('otherschools')}}">Other schools</a></li>
                <li class="active">Edit other school</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit other schools</h3>
                        </div>
                        <form action="{{route('otherschools.editschool')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group" hidden>
                                    <label for="id">School Name </label><small class="req"> *</small>
                                    <input type="text" id="id" name="id" class="form-control" required value="{{$school->id}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="schoolname">School Name </label><small class="req"> *</small>
                                    <input type="text" id="schoolname" name="schoolname" class="form-control" required autofocus value="{{$school->schoolname}}"/>
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
                            <h3 class="box-title">Other School List</h3>
                        </div>
                        <div class="box-body">
                            <table id="school_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>School Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @foreach($schools as $school)
                                    <tr>
                                        <td>{{$srno}}</td>
                                        <td>{{$school->schoolname}}</td>
                                        <td>
                                            <a href="{{url('/otherschools/edit/'.encrypt($school->id))}}"><button class=" btn btn-success" title="edit school"><i class="fa fa-pencil"></i> Edit</button></a>
                                        </td>
                                    </tr>
                                    <?php $srno++;?>
                                @endforeach
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
        $('#school_table').DataTable({
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
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
