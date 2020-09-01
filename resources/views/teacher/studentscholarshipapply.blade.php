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
                <li class="active">Student Scholarship Apply</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Students</h3>
                        </div>
                        <form method="post" id="student_search_form">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4">
                                    <label for="scholarshipname">Scholarship Name</label>
                                    <select id="scholarshipname" name="scholarshipname" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $scholarshiplist = \App\ScholarshipLists::orderBy('scholarshipname','asc')->get();
                                        ?>
                                        @foreach($scholarshiplist as $scholarship)
                                            <option value="{{$scholarship->id}}">{{$scholarship->scholarshipname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="classname">Class</label>
                                    <select id="classname" name="classname" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $classlist = \App\ClassLists::orderBy('classname','asc')->get();
                                        ?>
                                        @foreach($classlist as $class)
                                            <option value="{{$class->classname}}">{{$class->classname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="division">Division</label>
                                    <select id="division" name="division" class="form-control select2">
                                        @if(isset($divisionlist))
                                            <option value="">Select</option>
                                            @foreach($divisionlist as $division1)
                                                <option value="{{$division1}}">{{$division1}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4" @if(\Illuminate\Support\Facades\Session::get('registerfor') != 'College') hidden @endif>
                                    <label for="faculty">Faculty</label>
                                    <select id="faculty" name="faculty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Commerce">Commerce</option>
                                        <option value="Science">Science</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="applicablefor">Applicable for</label>
                                    <input type="text" class="form-control" id="applicablefor" value="" readonly/>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="button" id="studentsearch" class="btn btn-primary pull-right" value="Search"/>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-default">
                        <form method="post" action="{{route('studentscholarshipapply.post')}}">
                            <div class="box-body">
                                <div class="container col-md-12">
                                    <h3 style="margin: 0 0 10px 0; text-align: center;">Select students to apply Scholarship</h3>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select name="from[]" id="undo_redo" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="unselectedstudents"></span>
                                        </div>
                                        <div class="col-md-2">
                                            {{--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>--}}
                                            <button type="button" id="undo_redo_rightAll" class="btn btn-primary btn-block">Get all</button>
                                            <button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block">Get selected</button>
                                            <button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block">Put selected</button>
                                            <button type="button" id="undo_redo_leftAll" class="btn btn-danger btn-block">Put all</button>
                                            {{--<button type="button" id="undo_redo_redo" class="btn btn-warning btn-block">redo</button>--}}
                                        </div>
                                        <div class="col-md-5">
                                            <select name="to[]" id="undo_redo_to" class="form-control" size="10" multiple="multiple"></select>
                                            <span id="selectedstudents"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4" hidden>
                                            <label for="scholarship">Scholarship name</label>
                                            <input type="text" class="form-control" id="scholarship" name="scholarship" readonly/>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <label for="scholarshipclass">Scholarship class</label>
                                            <input type="text" class="form-control" id="scholarshipclass" name="scholarshipclass" readonly/>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <label for="scholarshipdivision">Scholarship division</label>
                                            <input type="text" class="form-control" id="scholarshipdivision" name="scholarshipdivision" readonly/>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <label for="scholarshipfaculty">Scholarship faculty</label>
                                            <input type="text" class="form-control" id="scholarshipfaculty" name="scholarshipfaculty" readonly/>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="scholarshipamount">Scholarship amount (monthly)</label>
                                            <input type="number" class="form-control" id="scholarshipamount" name="scholarshipamount" min="0" required/>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="noofmonths">No. of months</label>
                                            <input type="number" class="form-control" id="noofmonths" name="noofmonths" min="1" max="12" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="submit" id="save" class="btn btn-primary pull-right" value="Save"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @include('admin.footer')
    <div class="control-sidebar-bg"></div>
</div>
@include('layouts.scripts')
<script src="{{asset('js/multiselect.js')}}"></script>

<script>
    $('#scholarshipname').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('scholarshipdetails')}}?id="+$('#scholarshipname').val(),
            beforeSend: function () {
            },
            success: function (data) {
                if (data) {
                    $('#applicablefor').val(data['applicablefor']);
                }
            }
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

    $('#studentsearch').click(function () {
        var formData = new FormData(document.getElementById("student_search_form"));
        $.ajax({
            url:"{{ route('scholarshipstudents') }}",
            method:"POST",
            data: formData,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $("#undo_redo").empty();
                $("#undo_redo_to").empty();
            },
            success:function(data)
            {
                $('#scholarship').val($('#scholarshipname').val());
                $('#scholarshipclass').val($('#classname').val());
                $('#scholarshipdivision').val($('#division').val());
                $('#scholarshipfaculty').val($('#faculty').val());
                if(data){
                    for(var i=0;i<data.length;i++){
                        $("#undo_redo").append('<option value="'+data[i].userid+'" data-gender="'+data[i].gender+'">'+data[i].lname+' '+data[i].fname+' '+data[i].mname+'</option>');
                    }
                }
                if (data.length === 0){
                    alert('Student not present');
                }
            }
        });
    });

    $(document).ready(function(){
        $('#student_table').DataTable({
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

    $(document).ready(function() {
        $('#undo_redo').multiselect();
    });
    function selectall() {
        $('#undo_redo option').prop('selected', true);
        $('#undo_redo_to option').prop('selected', true);
    }

    function getboxdetails() {
        var unselectedmale = 0;
        var unselectedfemale = 0;
        var selectedmale = 0;
        var selectedfemale = 0;
        $('#undo_redo > option').each(function() {
            var gender = $(this).data('gender');

            if(gender === 'Male'){
                unselectedmale+=1;
            }
            if(gender === 'Female'){
                unselectedfemale+=1;
            }
        });
        $('#undo_redo_to > option').each(function() {
            var gender = $(this).data('gender');

            if(gender === 'Male'){
                selectedmale+=1;
            }
            if(gender === 'Female'){
                selectedfemale+=1;
            }
        });

        var unselected = "Total students in box: <b>"+$('#undo_redo > option').length+"</b><br>Male: <b>"+unselectedmale+"</b> and Female: <b>"+unselectedfemale+"</b>";
        var selected = "Total students in box: <b>"+$('#undo_redo_to > option').length+"</b><br>Male: <b>"+selectedmale+"</b> and Female: <b>"+selectedfemale+"</b>";
        $('#unselectedstudents').html(unselected);
        $('#selectedstudents').html(selected);
    }

    window.setInterval(function(){
        getboxdetails();
    }, 1000);

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
