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
                <li><a href="{{route('assignclassteacher')}}"> Assign Class Teacher</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assign Class Teacher</h3>
                        </div>
                        <form action="{{route('assignclassteacher.editclassteacher')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group" hidden>
                                    <label for="id">ID</label><small class="req"> *</small>
                                    <input type="text" id="id" name="id" class="form-control" value="{{$classteacher->id}}" required/>
                                </div>
                                <div class="form-group">
                                    <label for="classname">Class Name </label><small class="req"> *</small>
                                    <input type="text" id="classname" name="classname" class="form-control" value="{{$classteacher->classname}}" required readonly autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="division">Division</label><small class="req"> *</small>
                                    <input type="text" id="division" name="division" class="form-control" value="{{$classteacher->division}}" required readonly/>
                                </div>
                                <div class="form-group" id="facultydiv" style="@if($classteacher->classname < '11') display: none; @endif">
                                    <label for="faculty">Faculty</label> @if($classteacher->classname > '10') <small class="req"> *</small> @endif
                                    <select id="faculty" name="faculty" class="form-control" @if($classteacher->classname > '10') required @endif>
                                        <option value="">Select</option>
                                        <option value="Arts" @if('Arts' == $classteacher->faculty) selected @endif>Arts</option>
                                        <option value="Commerce" @if('Commerce' == $classteacher->faculty) selected @endif>Commerce</option>
                                        <option value="Science" @if('Science' == $classteacher->faculty) selected @endif>Science</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="teacherid">Teacher Name </label><small class="req"> *</small>
                                    <select id="teacherid" name="teacherid" class="form-control select2" required>
                                        <option value="">Select</option>
                                        <?php
                                        $teacherlist = \App\StaffDetails::where('staffrole','Teacher')->orderBy('fname','asc')->get();
                                        ?>
                                        @foreach($teacherlist as $teacher)
                                            <option value="{{$teacher->userid}}" @if($teacher->userid == $classteacher->teacherid) selected @endif>{{$teacher->fname.' '.$teacher->mname.' '.$teacher->lname}}</option>
                                        @endforeach
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
                            <h3 class="box-title">Class Teacher List</h3>
                        </div>
                        <div class="box-body">
                            <table id="class_teacher_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Class</th>
                                    <th>Division</th>
                                    <th>Faculty</th>
                                    <th>Teacher name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($classteacherlist))
                                    @foreach($classteacherlist as $item)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$item->classname}}</td>
                                            <td>{{$item->division}}</td>
                                            <td>{{$item->faculty}}</td>
                                            <td>{{$item->fname.' '.$item->mname.' '.$item->lname}}</td>
                                            <td>
                                                <a href="{{url('/assignclassteacher/edit/'.encrypt($item->id))}}"><button class=" btn btn-success" title="Edit class teacher"><i class="fa fa-pencil"></i> Edit</button></a>
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
        $('#class_teacher_table').DataTable({
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

    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
