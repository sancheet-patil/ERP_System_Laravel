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
                <li class="active">Staff report</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Search Staff by Caste</h3>
                        </div>
                        <form method="post" action="{{route('castewisestaffreport.post')}}">
                            <div class="box-body">
                                <div class="form-group col-md-3">
                                    <label for="religion">Religion</label>
                                    <select id="religion" name="religion" class="form-control select2" >
                                        <option value="">Select</option>
                                        <?php
                                        $religions = \App\ReligionLists::orderBy('religion','asc')->get();
                                        ?>
                                        @foreach($religions as $religion1)
                                            <option value="{{$religion1->id}}" @if($religion1->id == $religion) selected @endif>{{$religion1->religion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="castename">Caste</label><small class="req"> *</small>
                                    <select id="castename" name="castename" class="form-control select2" required>
                                        <option value="">Select</option>
                                        @if(isset($castelist))
                                            @foreach($castelist as $caste1)
                                                <option value="{{$caste1->castename}}" @if($caste1->castename == $castename) selected @endif>{{$caste1->castename}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="subcaste">Sub Caste</label><small class="req"> *</small>
                                    <select id="subcaste" name="subcaste" class="form-control select2" required>
                                        <option value="">Select</option>
                                        @if(isset($subcastelist))
                                            @foreach($subcastelist as $subcaste1)
                                                <option value="{{$subcaste1->id}}" @if($subcaste1->id == $subcaste) selected @endif>{{$subcaste1->subcaste}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Staff castewise report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="staff_table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Staff ID</th>
                                        <th>Staff Role</th>
                                        <th>Designation</th>
                                        <th>Staff name</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Religion</th>
                                        <th>Category</th>
                                        <th>Caste</th>
                                        <th>Subcaste</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>AADHAR</th>
                                        <th>Place of birth</th>
                                        <th>Mothertongue</th>
                                        <th>Blood group</th>
                                        <th>Shalarth ID</th>
                                        <th>Date of joining</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @foreach($stafflist as $staff)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <td>{{$staff->staffid}}</td>
                                            <td>{{$staff->staffrole}}</td>
                                            <td>{{$staff->designation}}</td>
                                            <td>{{$staff->fname.' '.$staff->mname.' '.$staff->lname}}</td>
                                            <td>{{$staff->dob}}</td>
                                            <td>{{$staff->gender}}</td>
                                            <td>{{$staff->religion}}</td>
                                            <td>{{$staff->category}}</td>
                                            <td>{{$staff->castename}}</td>
                                            <td>{{$staff->subcaste}}</td>
                                            <td>{{$staff->mobile}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>{{$staff->aadhar}}</td>
                                            <td>{{$staff->placeob}}</td>
                                            <td>{{$staff->mothertongue}}</td>
                                            <td>{{$staff->bloodgroup}}</td>
                                            <td>{{$staff->shalarthid}}</td>
                                            <td>{{$staff->joiningdate}}</td>
                                        </tr>
                                        <?php $srno++;?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if($religion)
                                <a href="{{url('castewisestaffreportexcel')}}?religion={{encrypt($religion)}}&castename={{encrypt($castename)}}&subcaste={{encrypt($subcaste)}}" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Report Print</a>
                            @endif
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
    $('#religion').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/castelist')}}?religion="+$('#religion').val(),
            beforeSend: function () {
                $("#castename").empty().append('<option value="">Select</option>');
            },
            success: function (data) {
                if (data) {
                    for(var i=0;i<data.length;i++){
                        $("#castename").append('<option value="'+data[i].castename+'">'+data[i].castename+'</option>');
                    }
                }
            }
        });
    });

    $('#castename').change(function () {
        $.ajax({
            type: "GET",
            url: "{{url('/subcastelist')}}?religion="+$('#religion').val()+"&castename="+$('#castename').val(),
            beforeSend: function () {
                $("#subcaste").empty().append('<option>Select</option>');
            },
            success: function (data) {
                if (data) {
                    for(var i=0;i<data.length;i++){
                        $("#subcaste").append('<option value="'+data[i].id+'">'+data[i].subcaste+'</option>');
                    }
                }
            }
        });
    });
    $(document).ready(function(){
        $('#staff_table').DataTable({
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

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
