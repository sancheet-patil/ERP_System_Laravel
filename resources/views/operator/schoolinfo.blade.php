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
                <li class="active">School Information</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> School Information</h3>
                        </div>
                        <form action="{{route('schoolinfo.update')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                @if($message = Session::get('success'))
                                    <span id="result"><div class="alert alert-success">{{$message}}</div></span>
                                @endif
                                {!! Session::forget('success') !!}
                                <div class="form-group col-md-4" hidden>
                                    <label for="id">ID</label> <small class="req"> *</small>
                                    <input type="text" id="id" name="id" class="form-control" value="{{$school->id}}" required readonly autofocus/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="schoolname">School Name</label> <small class="req"> *</small>
                                    <input type="text" id="schoolname" name="schoolname" class="form-control" value="{{config('app.name')}}" required readonly autofocus/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" placeholder="Address" class="form-control" value="{{$school->address}}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="taluka">Taluka</label>
                                    <input type="text" id="taluka" name="taluka" placeholder="Taluka" class="form-control" value="{{$school->taluka}}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district">District</label>
                                    <input type="text" id="district" name="district" placeholder="District" class="form-control" value="{{$school->district}}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="{{$school->email}}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="faxnumber">Fax Number</label>
                                    <input type="number" id="faxnumber" name="faxnumber" placeholder="Fax number" class="form-control" value="{{$school->faxnumber}}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="website">Website</label>
                                    <input type="url" id="website" name="website" placeholder="Website" class="form-control" value="{{$school->website}}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="estbdate">Established date</label>
                                    <input type="text" id="estbdate" name="estbdate" placeholder="Established date" class="form-control" value="{{$school->estbdate}}" />
                                </div>
                            </div>
                            <div class="box-footer">
                                @csrf
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
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

</body>
</html>
