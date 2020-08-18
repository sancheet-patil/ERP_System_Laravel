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
                            <h3 class="box-title">Add Caste Category</h3>
                        </div>
                        <form action="{{route('castecategory.add')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group">
                                    <label for="religion">Religion </label><small class="req"> *</small>
                                    <select class="form-control select2" id="religion" name="religion" style="width:100%;" required autofocus>
                                        <option value="">Select</option>
                                        @if(isset($religions))
                                            @foreach($religions as $religion)
                                                <option value="{{$religion->id}}">{{$religion->religion}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label><small class="req"> *</small>
                                    <select class="form-control select2" id="category" name="category" style="width:100%;" required>
                                        <option value="">Select</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="castename">Caste name</label><small class="req"> *</small>
                                    <input type="text" id="castename" name="castename" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="subcaste">Sub Caste name</label><small class="req"> *</small>
                                    <input type="text" id="subcaste" name="subcaste" class="form-control" required/>
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
                            <h3 class="box-title">Caste Categories List</h3>
                        </div>
                        <div class="box-body">
                            <table id="castecategory_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Religion</th>
                                    <th>Category</th>
                                    <th>Caste</th>
                                    <th>Sub-Caste</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($castecategories))
                                    @foreach($castecategories as $category)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$category->religion}}</td>
                                            <td>{{$category->category}}</td>
                                            <td>{{$category->castename}}</td>
                                            <td>{{$category->subcaste}}</td>
                                            <td>
                                                <a href="{{url('/castecategory/edit/'.encrypt($category->id))}}"><button class=" btn btn-success" title="Edit category"><i class="fa fa-edit"></i></button></a>
{{--                                                <a href="{{url('/castecategory/delete/'.encrypt($category->id))}}"><button class=" btn btn-warning" title="Delete category" onclick="return confirmDelete()"><i class="fa fa-trash"></i></button></a>--}}
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
        $('#castecategory_table').DataTable({
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
