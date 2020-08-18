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
                <li><a href="{{route('visitorbook')}}"> Visitor Book</a></li>
                <li class="active">Edit Visitor</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Visitor</h3>
                        </div>
                        <form action="{{route('visitorbook.editvisitor')}}" method="post">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                <div class="form-group" hidden>
                                    <label for="id">ID</label><small class="req"> *</small>
                                    <input type="text" id="id" name="id" class="form-control" value="{{$visitor->id}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="visitpurpose">Visit purpose</label><small class="req"> *</small>
                                    <input type="text" id="visitpurpose" name="visitpurpose" class="form-control" value="{{$visitor->visitpurpose}}" required autofocus/>
                                </div>
                                <div class="form-group">
                                    <label for="visitorname">Visitor Name</label><small class="req"> *</small>
                                    <input type="text" id="visitorname" name="visitorname" class="form-control" value="{{$visitor->visitorname}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="visitorphone">Visitor Phone</label><small class="req"> *</small>
                                    <input type="number" id="visitorphone" name="visitorphone" class="form-control" value="{{$visitor->visitorphone}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="visitoridcard">Visitor ID card</label>
                                    <select id="visitoridcard" name="visitoridcard" class="form-control select2">
                                        <option value="">Select</option>
                                        <option value="AADHAR CARD" @if($visitor->visitoridcard == 'AADHAR CARD') selected @endif>AADHAR CARD</option>
                                        <option value="PAN CARD" @if($visitor->visitoridcard == 'PAN CARD') selected @endif>PAN CARD</option>
                                        <option value="DRIVING LICENSE" @if($visitor->visitoridcard == 'DRIVING LICENSE') selected @endif>DRIVING LICENSE</option>
                                        <option value="ELECTION CARD" @if($visitor->visitoridcard == 'ELECTION CARD') selected @endif>ELECTION CARD</option>
                                        <option value="PASSPORT" @if($visitor->visitoridcard == 'PASSPORT') selected @endif>PASSPORT</option>
                                        <option value="STUDENT PHOTO ID" @if($visitor->visitoridcard == 'STUDENT PHOTO ID') selected @endif>STUDENT PHOTO ID</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="visitoridcardnumber">Visitor ID card number</label>
                                    <input type="text" id="visitoridcardnumber" name="visitoridcardnumber" class="form-control" value="{{$visitor->visitoridcardnumber}}" />
                                </div>
                                <div class="form-group">
                                    <label for="visitdate">Visit date</label><small class="req"> *</small>
                                    <input type="text" id="visitdate" name="visitdate" class="form-control" value="{{$visitor->visitdate}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="intime">In time</label><small class="req"> *</small>
                                    <input type="text" id="intime" name="intime" class="form-control" value="{{$visitor->intime}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="outtime">Out time</label>
                                    <input type="text" id="outtime" name="outtime" class="form-control" value="{{$visitor->outtime}}" required/>
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
                            <h3 class="box-title">Visitor List</h3>
                        </div>
                        <div class="box-body">
                            <table id="visitor_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Purpose</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>In time</th>
                                    <th>Out time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $srno=1;?>
                                @if(isset($visitorlist))
                                    @foreach($visitorlist as $visitor)
                                        <tr>
                                            <td>{{$srno}}</td>
                                            <?php $srno++;?>
                                            <td>{{$visitor->visitpurpose}}</td>
                                            <td>{{$visitor->visitorname}}</td>
                                            <td>{{$visitor->visitorphone}}</td>
                                            <td>{{$visitor->visitdate}}</td>
                                            <td>{{$visitor->intime}}</td>
                                            <td>{{$visitor->outtime}}</td>
                                            <td>
                                                <a href="{{url('/visitorbook/edit/'.encrypt($visitor->id))}}"><button class=" btn btn-success" title="Edit visitor"><i class="fa fa-pencil"></i></button></a>
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
        $('#visitor_table').DataTable({
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
    $('#visitorphone').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });
    $(function () {
        $('#visitdate').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '0d',
            autoclose: true
        });
        $('#intime').timepicker({
            showInputs: false,
            showMeridian: false,
            minuteStep: 1,
        });
        $('#outtime').timepicker({
            showInputs: false,
            showMeridian: false,
            minuteStep: 1,
        });
    });
    function confirmDelete(){
        return confirm('Are you sure you want to delete?');
    }
</script>
</body>
</html>
