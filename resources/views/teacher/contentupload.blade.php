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
                <li class="active">Content Upload</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upload Content</h3>
                        </div>
                        <form action="{{route('contentupload.add')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                <div class="form-group">
                                    <label for="contenttitle">Content title </label><small class="req"> *</small>
                                    <input type="text" id="contenttitle" name="contenttitle" class="form-control" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="contenttype">Content type</label><small class="req"> *</small>
                                    <select id="contenttype" name="contenttype" class="form-control select2" required>
                                        <option value="">Select</option>
                                        @if($message = Session::get('contenttype'))
                                            <option value="Assignments" @if($message == 'Assignments') selected @endif>Assignments</option>
                                            <option value="Study Material" @if($message == 'Study Material') selected @endif>Study Material</option>
                                            <option value="Syllabus" @if($message == 'Syllabus') selected @endif>Syllabus</option>
                                        @else
                                            <option value="Assignments">Assignments</option>
                                            <option value="Study Material">Study Material</option>
                                            <option value="Syllabus">Syllabus</option>
                                        @endif
                                        {!! Session::forget('contenttype') !!}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="availablefor">Available for all class</label><small class="req"> *</small>
                                    <input type="checkbox" id="availablefor" name="availablefor" onchange="manageavailableclass()">
                                </div>
                                <div class="form-group">
                                    <label for="classname">Class name</label>
                                    <select id="classname" name="classname" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                        ?>
                                        @foreach($classlist as $class)
                                            <option value="{{$class->classname}}">{{$class->classname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="division">Division</label>
                                    <select id="division" name="division" class="form-control select2" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" name="description" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="contentfile">Content file</label><small class="req"> *</small>
                                    <input type="file" id="contentfile" name="contentfile" class="form-control no-border" />
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
                            <h3 class="box-title">All Content List</h3>
                        </div>
                        <div class="box-body">
                            <table id="content_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Content Title</th>
                                    <th>Content type</th>
                                    <th>Available for</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($contentlist))
                                    @foreach($contentlist as $content)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$content->contenttitle}}</td>
                                            <td>{{$content->contenttype}}</td>
                                            <td>
                                                {{$content->availablefor}} Class
                                                @if($content->availablefor == 'Specific')
                                                    <br>({{$content->classname}}-{{$content->division}})
                                                @endif
                                            </td>
                                            <td>
                                                @if($content->contentpath)
                                                    <a href="{{$content->contentpath}}" target="_blank" class="btn btn-info">Open file</a>
                                                @else
                                                    File not present
                                                @endif
                                            </td>
                                            <td>
{{--                                                <a href="{{url('/contentupload/edit/'.encrypt($content->id))}}"><button class=" btn btn-success" title="Edit content"><i class="fa fa-pencil"></i></button></a>--}}
                                                <a href="{{url('/contentupload/delete/'.encrypt($content->id))}}"><button class=" btn btn-warning" title="Delete content" onclick="return confirmDelete()"><i class="fa fa-trash"></i></button></a>
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
        $('#content_table').DataTable({
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
            url:"{{url('divisionlist')}}?classname=" + classname,
            beforeSend:function(){
                $("#division").empty().append('<option value="">Select</option>');
            },
            success:function(data){
                if(data){
                    $.each(data,function(index,value){
                        $("#division").append('<option value="'+value+'">'+value+'</option>');
                    });
                }
            }
        });
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
    function manageavailableclass() {
        if ($("#availablefor").is(':checked'))
        {
            $('#classname').prop('required',false).prop('disabled',true);
            $('#division').prop('required',false).prop('disabled',true);
        }
        else
        {
            $('#classname').prop('required',true).prop('disabled',false);
            $('#division').prop('required',true).prop('disabled',false);
        }
    }
</script>
</body>
</html>
