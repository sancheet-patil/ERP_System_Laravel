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
                <li class="active">Outwards</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Outwards</h3>
                        </div>
                        <form action="{{route('outwards.add')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                <div class="form-group">
                                    <label for="totitle">To title</label><small class="req"> *</small>
                                    <input type="text" id="totitle" name="totitle" class="form-control" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="referencenumber">Reference number</label><small class="req"> *</small>
                                    <input type="text" id="referencenumber" name="referencenumber" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="toaddress">To address</label><small class="req"> *</small>
                                    <input type="text" id="toaddress" name="toaddress" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="fromtitle">From title</label><small class="req"> *</small>
                                    <input type="text" id="fromtitle" name="fromtitle" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="postaldate">Postal date</label>
                                    <input type="text" id="postaldate" name="postaldate" class="form-control" value="{{date('d-m-Y')}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="postfile">Scanned file</label>
                                    <input class="form-control no-border" type="file" name="postfile" id="postfile" >
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
                            <h3 class="box-title">Outwards List</h3>
                        </div>
                        <div class="box-body">
                            <table id="outwards_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>To title</th>
                                    <th>Reference number</th>
                                    <th>From title</th>
                                    <th>File</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($outwardslist))
                                    @foreach($outwardslist as $post)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$post->totitle}}</td>
                                            <td>{{$post->referencenumber}}</td>
                                            <td>{{$post->fromtitle}}</td>
                                            <td>
                                                @if($post->filename)
                                                    <a href="{{$post->filename}}" target="_blank" class="btn btn-info">Open file</a>
                                                @else
                                                    File not present
                                                @endif
                                            </td>
                                            <td>{{$post->postaldate}}</td>
                                            <td>
                                                <a href="{{url('/outwards/edit/'.encrypt($post->id))}}"><button class=" btn btn-success" title="Edit outwards"><i class="fa fa-pencil"></i></button></a>
                                                <a href="{{url('/outwards/delete/'.encrypt($post->id))}}"><button class=" btn btn-warning" title="Delete outwards" onclick="return confirmDelete()"><i class="fa fa-trash"></i></button></a>
                                            </td>
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
        $('#outwards_table').DataTable({
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
        $('#postaldate').datepicker({
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
