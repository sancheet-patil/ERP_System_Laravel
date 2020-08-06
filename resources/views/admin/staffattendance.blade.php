<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{config('app.name')}}</title>

    @include('layouts.links')
    <link rel="stylesheet" href="{{asset('css/jquerysctipttop.css')}}">

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
                <li class="active">Staff Attendance</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Staff Attendance Search</h3>
                        </div>
                        <form method="post" id="search_staff_form">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4">
                                    <label for="attendancedate">Date</label><small class="req"> *</small>
                                    <input type="text" id="attendancedate" name="attendancedate" class="form-control" value="{{date('d-m-Y')}}" required />
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <input type="submit" class="btn btn-primary pull-right" value="Search" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" id="choose_attendance_div" style="display: none;">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Mark Staff Attendance</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="staffattendance-submit" method="post" action="{{route('staffattendance.submit')}}">
                                    <span id="result"></span>
                                    <table class="table table-bordered table-striped" id="assign_attendance_table">
                                        <thead>
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Role</th>
                                            <th>Designation</th>
                                            <th>Present/ Absent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="box-footer">
                                        @csrf
                                        <input type="submit" class="btn btn-primary pull-right" value="Submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> Staff Attendance Report</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="staff_attendance_table">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Date</th>
                                        <th>Total present</th>
                                        <th>Total absent</th>
                                        <th>Total staff</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $srno=1;?>
                                    @if($stafflist != '')
                                        @foreach($stafflist as $staff)
                                            <tr>
                                                <td>{{$srno}}</td>
                                                <?php $srno++;?>
                                                <td>{{$staff['attendancedate']}}</td>
                                                <td>{{$staff['presentcount']}}</td>
                                                <td>{{$staff['absentcount']}}</td>
                                                <td>{{$staff['totalcount']}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
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
<script src="{{asset('js/multiselect.js')}}"></script>

<script>
    $(function () {
        $('#attendancedate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    var attendancedate=null;
    var staffcount=0;
    $('#search_staff_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: '{{url('/getstaffattendance')}}',
            method:'get',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function() {
                attendancedate = $('#attendancedate').val();
            },
            success:function(data)
            {
                if(data.length !== 0)
                {
                    staffcount = data.length;
                    html = '';
                    for (var i=0; i<data.length ; i++)
                    {
                        html += '<tr>';
                        html += '<td hidden><input type="text" name="academicyear[]" class="form-control" value="'+data[i].academicyear+'" readonly /></td>';
                        html += '<td hidden><input type="text" name="attendancedate[]" class="form-control" value="'+data[i].attendancedate+'" readonly /></td>';
                        html += '<td hidden><input type="text" name="staffid[]" class="form-control" value="'+data[i].staffid+'" readonly /></td>';
                        html += '<td><input type="text" name="staffname[]" class="form-control" value="'+data[i].fname+' '+data[i].mname+' '+data[i].lname+'" readonly /></td>';
                        html += '<td><input type="text" name="staffrole[]" class="form-control" value="'+data[i].staffrole+'" readonly /></td>';
                        html += '<td><input type="text" name="designation[]" class="form-control" value="'+data[i].designation+'" readonly /></td>';
                        if(data[i].ispresent === "1"){
                            html += '<td>' +
                                '<input type="checkbox" id="ispresentcb'+i+'" checked />' +
                                '<input type="hidden" id="ispresent'+i+'" name="ispresent[]" value="1" />' +
                                '<span>&nbsp;&nbsp;Check for present and uncheck for absent</span>'+
                                '</td>';
                        }
                        else{
                            html += '<td>' +
                                '<input type="checkbox" id="ispresentcb'+i+'" />' +
                                '<input type="hidden" id="ispresent'+i+'" name="ispresent[]" value="0" />' +
                                '<span>&nbsp;&nbsp;Check for present and uncheck for absent</span>'+
                                '</td>';
                        }
                        html += '</tr>';
                    }
                    $('#assign_attendance_table tbody').html(html);
                }
                document.getElementById('choose_attendance_div').style.display = "block";
            }
        })
    });
    $('#staffattendance-submit').submit(function(e){
        for(var i=0;i<staffcount;i++){
            if($('#ispresentcb'+i).prop("checked")){
                $('#ispresent'+i).val(1)
            }
            else {
                $('#ispresent'+i).val(0)
            }
        }
    });
</script>
</body>
</html>
