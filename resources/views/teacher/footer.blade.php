<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Infominds, Solapur, Mo. No. 7972781899
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a href="https://www.bodhitechnology.tech" target="_blank">Bodhi Technology</a>.</strong> All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-academicyear-tab" data-toggle="tab">Academic year</a></li>
        <li><a href="#control-sidebar-registerfor-tab" data-toggle="tab">Register for</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-academicyear-tab">
            <h3 class="control-sidebar-heading" style="margin-top: 0;padding-top: 0;">Academic year: <b>{{\Illuminate\Support\Facades\Session::get('academicyear')}}</b></h3>
            <ul class="control-sidebar-menu">
                <?php
                    $yearlist = \App\AcademicYearList::orderBy('academicyear','desc')->get();
                ?>
                @foreach($yearlist as $year)
                    <li>
                        <a href="{{route('changeacademicyear',$year->academicyear)}}">
                            <h4 class="control-sidebar-subheading" style="margin: 0;">
                                {{$year->academicyear}}
                                @if($year->academicyear == \Illuminate\Support\Facades\Session::get('academicyear'))
                                    <span class="label label-primary pull-right">
                                        Selected
                                    </span>
                                @endif
                            </h4>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-pane" id="control-sidebar-registerfor-tab">
            <h3 class="control-sidebar-heading" style="margin-top: 0;padding-top: 0;">Register For: <b>{{\Illuminate\Support\Facades\Session::get('registerfor')}}</b></h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="{{route('changeregisterfor','School')}}">
                        <h4 class="control-sidebar-subheading" style="margin: 0;">
                            School
                            @if('School' == \Illuminate\Support\Facades\Session::get('registerfor'))
                                <span class="label label-primary pull-right">
                                    Selected
                                </span>
                            @endif
                        </h4>
                    </a>
                </li>
                <li>
                    <a href="{{route('changeregisterfor','College')}}">
                        <h4 class="control-sidebar-subheading" style="margin: 0;">
                            College
                            @if('College' == \Illuminate\Support\Facades\Session::get('registerfor'))
                                <span class="label label-primary pull-right">
                                    Selected
                                </span>
                            @endif
                        </h4>
                    </a>
                </li>
                <li>
                    <a href="{{route('changeregisterfor','School Form 17')}}">
                        <h4 class="control-sidebar-subheading" style="margin: 0;">
                            School Form 17
                            @if('School Form 17' == \Illuminate\Support\Facades\Session::get('registerfor'))
                                <span class="label label-primary pull-right">
                                    Selected
                                </span>
                            @endif
                        </h4>
                    </a>
                </li>
                <li>
                    <a href="{{route('changeregisterfor','College Form 17')}}">
                        <h4 class="control-sidebar-subheading" style="margin: 0;">
                            College Form 17
                            @if('College Form 17' == \Illuminate\Support\Facades\Session::get('registerfor'))
                                <span class="label label-primary pull-right">
                                    Selected
                                </span>
                            @endif
                        </h4>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
