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
                <li><a href="{{route('religion')}}"> Religion</a></li>
                <li class="active">Edit Religion</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Religion</h3>
                        </div>
                        <form action="{{route('religion.editreligion')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group" hidden>
                                    <label for="id">ID </label><small class="req"> *</small>
                                    <input type="text" id="id" name="id" class="form-control" required value="{{$religion->id}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="religion">Religion Name </label><small class="req"> *</small>
                                    <input type="text" id="religion" name="religion" class="form-control" required autofocus value="{{$religion->religion}}"/>
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
                            <h3 class="box-title">Religion List</h3>
                        </div>
                        <div class="box-body">
                            <table id="religion_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Religion name</th>
                                    <th width="40%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($religions))
                                    @foreach($religions as $religion)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$religion->religion}}</td>
                                            <td>
                                                <a href="{{url('/religion/edit/'.encrypt($religion->id))}}"><button class=" btn btn-success" title="Edit religion"><i class="fa fa-pencil"></i> Edit</button></a>
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
        $('#religion_table').DataTable({
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
