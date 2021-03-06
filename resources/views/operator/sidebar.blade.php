<aside class="main-sidebar">
    <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{''}}">
                    <i class="fa fa-ioxhost"></i> <span>School Setup</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('religion')}}"><i class="fa fa-angle-double-right"></i>Religion Information</a></li>
                    <li><a href="{{route('category')}}"><i class="fa fa-angle-double-right"></i>Caste Category</a></li>
                    <li><a href="{{route('castecategories')}}"><i class="fa fa-angle-double-right"></i>Add Caste & subcaste</a></li>
                    <li><a href="{{route('scholarship')}}"><i class="fa fa-angle-double-right"></i>Scholarships</a></li>
                    <li><a href="{{route('event')}}"><i class="fa fa-angle-double-right"></i>Events</a></li>
                    <li><a href="{{route('holiday')}}"><i class="fa fa-angle-double-right"></i>Holidays</a></li>
                    <li><a href="{{route('otherschools')}}"><i class="fa fa-angle-double-right"></i>Other schools</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{''}}">
                    <i class="fa fa-ioxhost"></i> <span>Front office</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('visitorbook')}}"><i class="fa fa-angle-double-right"></i>Visitor book</a></li>
                    <li><a href="{{route('inwards')}}"><i class="fa fa-angle-double-right"></i>Inwards</a></li>
                    <li><a href="{{route('outwards')}}"><i class="fa fa-angle-double-right"></i>Outwards</a></li>
                    <li><a href="{{route('complaints')}}"><i class="fa fa-angle-double-right"></i>Complaints</a></li>
                    <li><a href="{{route('circular')}}"><i class="fa fa-angle-double-right"></i>Circulars</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{''}}">
                    <i class="fa fa-user"></i> <span>Student Information</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('student.admission')}}"><i class="fa fa-angle-double-right"></i>Student admission</a></li>
                    <li><a href="{{route('student.search')}}"><i class="fa fa-angle-double-right"></i>Student details search</a></li>
                    <li><a href="{{route('studentidgenerate')}}"><i class="fa fa-angle-double-right"></i>Student ID Generate</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{''}}">
                    <i class="fa fa-sitemap"></i> <span>Human Resource</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('staffidgenerate')}}"><i class="fa fa-angle-double-right"></i>Staff ID Generate</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{''}}">
                    <i class="fa fa-download"></i> <span>Certificates</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('bonafide')}}"><i class="fa fa-angle-double-right"></i>Bonafide</a></li>
                    <li><a href="{{route('leavingcertificate')}}"><i class="fa fa-angle-double-right"></i>Leaving Certificate</a></li>
                    <li><a href="{{route('form17lc')}}"><i class="fa fa-angle-double-right"></i>Form 17 Leaving Certificate</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{''}}">
                    <i class="fa fa-download"></i> <span>Reports</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Certificate Report
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('studentbonafidereport')}}"><i class="fa fa-angle-double-right"></i>Bonafide Issue Report</a></li>
                            <li><a href="{{route('lcissuereport')}}"><i class="fa fa-angle-double-right"></i>LC Issue Report</a></li>
                            <li><a href="{{route('form17lcissuereport')}}"><i class="fa fa-angle-double-right"></i>Form 17 LC Issue Report</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Student Report
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('studentreport')}}"><i class="fa fa-angle-double-right"></i> <span> Student Detail Report</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Front Office Report
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('circularreport')}}"><i class="fa fa-angle-double-right"></i> <span> Circular Report</span></a></li>
                            <li><a href="{{route('inwardsreport')}}"><i class="fa fa-angle-double-right"></i> <span> Inwards Report</span></a></li>
                            <li><a href="{{route('outwardsreport')}}"><i class="fa fa-angle-double-right"></i> <span> Outwards Report</span></a></li>
                            <li><a href="{{route('visitorsreport')}}"><i class="fa fa-angle-double-right"></i> <span> Visitors Report</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Scholarship Report
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
{{--                            <li><a href="{{route('studentscholarshipreport')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Report</a></li>--}}
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Exam Report
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('examinationreport1to7')}}"><i class="fa fa-angle-double-right"></i>Exam Report 1 to 7</a></li>
                            <li><a href="{{route('examinationreport8to10')}}"><i class="fa fa-angle-double-right"></i>Exam Report 8 to 10</a></li>
                            <li><a href="{{route('examinationreport11to12')}}"><i class="fa fa-angle-double-right"></i>Exam Report 11 to 12</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Staff Report
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('castewisestaffreport')}}"><i class="fa fa-angle-double-right"></i>Caste wise staff Report</a></li>
                            <li><a href="{{route('genderwisestaffreport')}}"><i class="fa fa-angle-double-right"></i>Gender wise staff Report</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Catalogue Report
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('studentcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Student Catalogue Report</a></li>
                            <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            <li><a href="{{route('studentattendanceataloguereport')}}"><i class="fa fa-angle-double-right"></i>Student Attendance Catalogue</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> <span>Logout</span>
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
</aside>
