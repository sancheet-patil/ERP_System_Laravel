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
                <li class="active">Assign Subjects</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Assign subject search criteria</h3>
                        </div>
                        <form method="post" id="search_class_subject_form">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4">
                                    <label for="classname">Class</label><small class="req"> *</small>
                                    <select id="classname" name="classname" class="form-control select2" required autofocus>
                                        <option value="">Select</option>
                                        <?php
                                        $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                        ?>
                                        @foreach($classlist as $class)
                                            <option value="{{$class->classname}}" @if($class->classname == old('classname')) selected @endif>{{$class->classname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label><small class="req"> *</small>
                                    <select id="division" name="division" class="form-control select2" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-4" id="facultydiv" style="display: none;">
                                    <label for="faculty">Faculty</label>
                                    <select id="faculty" name="faculty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Commerce">Commerce</option>
                                        <option value="Science">Science</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="submit" class="btn btn-primary pull-right" value="Search" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" id="assign_subject_div" style="display: none;">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Assign Subjects</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{route('assignsubjects.add')}}" id="assign_subject_form">
                                    <span id="result"></span>
                                    <table class="table table-bordered table-striped" id="assign_subject_table">
                                        <thead>
                                        <tr>
                                            <th width="25%">Subject name</th>
                                            <th width="25%">Out of marks</th>
                                            <th width="25%">Teacher name</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot id="table_footer">
                                        <tr>
                                            <td colspan="3" align="right"><button type="button" name="add" id="addsubject" class="btn btn-success">Add subject</button></td>
                                            <td>
                                                @csrf
                                                <input type="submit" name="save" id="savesubject" class="btn btn-primary" value="Save List" />
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
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
    var count = 1;

    $('#classname').change(function(){
        $('tbody').html(null);
        document.getElementById("savesubject").disabled = true;
        document.getElementById("addsubject").disabled = true;
        var classname = $(this).val();
        $.ajax({
            type:"GET",
            url:"{{url('divisionlist')}}?classname="+classname,
            beforeSend:function(){
                $('#division').empty().append('<option value="">Select</option>')
            },
            success:function(data){
                if(data){
                    $.each(data,function(index,value){
                        $("#division").append('<option value="'+value+'">'+value+'</option>');
                    });
                }
            }
        });
        if(classname > '10') {
            document.getElementById("facultydiv").style.display = "block";
        }
        else {
            document.getElementById("facultydiv").style.display = "none";
        }
    });

    $('#division').change(function() {
        $('#assign_subject_table tbody').html(null);
        document.getElementById("savesubject").disabled = true;
        document.getElementById("addsubject").disabled = true;
    });

    $('#search_class_subject_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: '{{url('/classsubjectlist')}}',
            method:'get',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function() {
                count=1;
            },
            success:function(data)
            {
                if(data.length !== 0)
                {
                    html = '';
                    for (var i=0; i<data.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td hidden><input type="text" name="classname[]" class="form-control" value="'+data[i].classname+'"/></td>';
                        html += '<td hidden><input type="text" name="division[]" class="form-control" value="'+data[i].division+'"/></td>';
                        html += '<td hidden><input type="text" name="faculty[]" class="form-control" value="'+data[i].faculty+'"/></td>';
                        html += '<td>' +
                            '<input type="text" name="subjectname[]" class="form-control" value="'+data[i].subjectid+'" readonly style="display: none;"/>' +
                            '<input type="text" class="form-control" value="'+data[i].subjectname+'" readonly />' +
                            '</td>';
                        html += '<td>' +
                            '<input type="text" name="outofmarks[]" class="form-control" value="'+data[i].outofmarks+'" readonly style="display: none;"/>' +
                            '<input type="text" class="form-control" value="'+data[i].outofmarks+'" readonly />' +
                            '</td>';
                        html += '<td>' +
                            '<input type="text" name="teachername[]" class="form-control" value="'+data[i].teacherid+'" readonly style="display: none;"/>' +
                            '<input type="text" class="form-control" value="'+data[i].fname+' '+data[i].mname+' '+data[i].lname+'" readonly />' +
                            '</td>';
                        html += '<td><button type="button" id="removesubject" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>';
                        html += '</tr>';
                    }
                    $('#assign_subject_table tbody').html(html);
                }
                else
                {
                    dynamic_field(count);
                }
                document.getElementById("assign_subject_div").style.display = "block";
                document.getElementById("savesubject").disabled = false;
                document.getElementById("addsubject").disabled = false;
            }
        })
    });

    function dynamic_field(number) {
        html = '<tr>';
        html += '<td hidden><input type="text" name="classname[]" class="form-control" value="'+$('#classname').val()+'"/></td>';
        html += '<td hidden><input type="text" name="division[]" class="form-control" value="'+$('#division').val()+'"/></td>';
        html += '<td hidden><input type="text" name="faculty[]" class="form-control" value="'+$('#faculty').val()+'"/></td>';
        html += '<td><select id="subjectname" name="subjectname[]" class="form-control select2" required><option value="">Select</option>';
        html += '<?php if(isset($subjectlist)) { foreach($subjectlist as $subject){ echo '<option value="'.$subject->id.'">'.$subject->subjectname.' ('.$subject->subjecttype.')</option>'; } } ?>';
        html += '</select></td>';
        html += '<td><input type="number" name="outofmarks[]" class="form-control" value="" min="0" required/></td>';
        html += '<td><select id="teachername" name="teachername[]" class="form-control select2" required><option value="">Select</option>';
        html += '<?php if(isset($teacherlist)) { foreach($teacherlist as $teacher){ echo '<option value="'.$teacher->userid.'">'.$teacher->fname.' '.$teacher->mname.' '.$teacher->lname.'</option>'; } } ?>';
        html += '</select></td>';
        html += '<td><button type="button" id="removesubject" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
        $('#assign_subject_table tbody').append(html);
    }

    $(document).on('click', '#addsubject', function(){
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '#removesubject', function(){
        count--;
        $(this).closest("tr").remove();
    });

</script>
</body>
</html>
