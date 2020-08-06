<aside class="main-sidebar">
    <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if(strtolower(Auth::user()->role) == 'admin')
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-ioxhost"></i> <span>School Setup</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('schoolinfo')}}"><i class="fa fa-angle-double-right"></i>School Information</a></li>
                        <li><a href="{{route('setmaxlc')}}"><i class="fa fa-angle-double-right"></i>Set Max LC prints</a></li>
                        <li><a href="{{route('academicyear')}}"><i class="fa fa-angle-double-right"></i>Academic Year List</a></li>
                        <li><a href="{{route('usertype')}}"><i class="fa fa-angle-double-right"></i>User roles/types</a></li>
                        <li><a href="{{route('religion')}}"><i class="fa fa-angle-double-right"></i>Religion Information</a></li>
                        <li><a href="{{route('category')}}"><i class="fa fa-angle-double-right"></i>Caste Category</a></li>
                        <li><a href="{{route('castecategories')}}"><i class="fa fa-angle-double-right"></i>Add Caste & subcaste</a></li>
                        <li><a href="{{route('designation')}}"><i class="fa fa-angle-double-right"></i>Staff Designation</a></li>
                        <li><a href="{{route('sections')}}"><i class="fa fa-angle-double-right"></i>Division Information</a></li>
                        <li><a href="{{route('classes')}}"><i class="fa fa-angle-double-right"></i>Class Information</a></li>
                        <li><a href="{{route('subjects')}}"><i class="fa fa-angle-double-right"></i>Subjects</a></li>
                        <li><a href="{{route('assignsubjects')}}"><i class="fa fa-angle-double-right"></i>Assign Subjects</a></li>
                        <li><a href="{{route('assignclassteacher')}}"><i class="fa fa-angle-double-right"></i>Assign Class Teacher</a></li>
                        <li><a href="{{route('classtimetable')}}"><i class="fa fa-angle-double-right"></i>Class Timetable</a></li>
                        <li><a href="{{route('scholarship')}}"><i class="fa fa-angle-double-right"></i>Scholarships</a></li>
                        <li><a href="{{route('holiday')}}"><i class="fa fa-angle-double-right"></i>Holidays</a></li>
                        <li><a href="{{route('event')}}"><i class="fa fa-angle-double-right"></i>Events</a></li>
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
                        <li><a href="{{route('postalreceive')}}"><i class="fa fa-angle-double-right"></i>Inwards</a></li>
                        <li><a href="{{route('postaldespatch')}}"><i class="fa fa-angle-double-right"></i>Outwards</a></li>
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
                        <li><a href="{{route('bulkdivisionassign')}}"><i class="fa fa-angle-double-right"></i>Bulk Division Assign</a></li>
                        <li><a href="{{route('studentidgenerate')}}"><i class="fa fa-angle-double-right"></i>Student ID Generate</a></li>
                        <li><a href="{{route('studentscholarshipapply')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Apply</a></li>
                        <li><a href="{{route('promotestudents')}}"><i class="fa fa-angle-double-right"></i>Promote Students</a></li>
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
                        <li><a href="{{route('staff.joining')}}"><i class="fa fa-angle-double-right"></i>Staff joining</a></li>
                        <li><a href="{{route('staff.search')}}"><i class="fa fa-angle-double-right"></i>Staff search</a></li>
                        <li><a href="{{route('staffidgenerate')}}"><i class="fa fa-angle-double-right"></i>Staff ID Generate</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-calendar"></i> <span>Attendance</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('classattendance')}}"><i class="fa fa-angle-double-right"></i>Class Attendance</a></li>
                        <li><a href="{{route('staffattendance')}}"><i class="fa fa-angle-double-right"></i>Staff Attendance</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-book"></i> <span>Examinations</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('examschedule')}}"><i class="fa fa-angle-double-right"></i>Exam Schedule</a></li>
                        <li><a href="{{route('registermarks')}}"><i class="fa fa-angle-double-right"></i>Register Marks</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-download"></i> <span>Download Center</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('contentupload')}}"><i class="fa fa-angle-double-right"></i>Content upload</a></li>
                        <li><a href="{{route('assignments')}}"><i class="fa fa-angle-double-right"></i>Assignments</a></li>
                        <li><a href="{{route('studymaterial')}}"><i class="fa fa-angle-double-right"></i>Study material</a></li>
                        <li><a href="{{route('syllabus')}}"><i class="fa fa-angle-double-right"></i>Syllabus</a></li>
                        {{--<li><a href="{{route('otherdownloads')}}"><i class="fa fa-angle-double-right"></i>Other downloads</a></li>--}}
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
                        <li><a href="{{route('form17leavingcertificate')}}"><i class="fa fa-angle-double-right"></i>Form 17 Leaving Certificate</a></li>
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
                                <li><a href="{{route('studentlcreport')}}"><i class="fa fa-angle-double-right"></i>LC Issue Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Student Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('castewisestudents')}}"><i class="fa fa-angle-double-right"></i>Caste wise Students Report</a></li>
                                <li><a href="{{route('genderwisestudents')}}"><i class="fa fa-angle-double-right"></i>Gender wise Students Report</a></li>
                                <li><a href="{{route('classwisestudentsreport')}}"><i class="fa fa-angle-double-right"></i>Class wise Students Report</a></li>
                                <li><a href="{{route('form17students')}}"><i class="fa fa-angle-double-right"></i>Form 17 Students Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Scholarship Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('studentscholarshipreport')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Exam Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('studentwiseexamreport')}}"><i class="fa fa-angle-double-right"></i>Student Exam Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Staff Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('castewisestaff')}}"><i class="fa fa-angle-double-right"></i>Caste wise staff Report</a></li>
                                <li><a href="{{route('genderwisestaff')}}"><i class="fa fa-angle-double-right"></i>Gender wise staff Report</a></li>
                                <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Attendance Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('classattendancereport')}}"><i class="fa fa-angle-double-right"></i>Student attendance Report</a></li>
                                <li><a href="{{route('classmonthlyattendancereport')}}"><i class="fa fa-angle-double-right"></i>Student monthly attendance Report</a></li>
                                <li><a href="{{route('staffattendancereport')}}"><i class="fa fa-angle-double-right"></i>Staff attendance Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Catalogue Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('registercataloguereport')}}"><i class="fa fa-angle-double-right"></i>Student Catalogue Report</a></li>
                                <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(strtolower(Auth::user()->role) == 'teacher')
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-ioxhost"></i> <span>School Setup</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('assignsubjects')}}"><i class="fa fa-angle-double-right"></i>Assign Subjects</a></li>
                        <li><a href="{{route('classtimetable')}}"><i class="fa fa-angle-double-right"></i>Class Timetable</a></li>
                        <li><a href="{{route('scholarship')}}"><i class="fa fa-angle-double-right"></i>Scholarships</a></li>
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
                        <li><a href="{{route('student.search')}}"><i class="fa fa-angle-double-right"></i>Student details search</a></li>
                        <li><a href="{{route('bulkdivisionassign')}}"><i class="fa fa-angle-double-right"></i>Bulk Division Assign</a></li>
                        <li><a href="{{route('studentscholarshipapply')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Apply</a></li>
                        <li><a href="{{route('promotestudents')}}"><i class="fa fa-angle-double-right"></i>Promote Students</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-calendar"></i> <span>Attendance</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('classattendance')}}"><i class="fa fa-angle-double-right"></i>Class Attendance</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-book"></i> <span>Examinations</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('examschedule')}}"><i class="fa fa-angle-double-right"></i>Exam Schedule</a></li>
                        <li><a href="{{route('registermarks')}}"><i class="fa fa-angle-double-right"></i>Register Marks</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-download"></i> <span>Download Center</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('contentupload')}}"><i class="fa fa-angle-double-right"></i>Content upload</a></li>
                        <li><a href="{{route('assignments')}}"><i class="fa fa-angle-double-right"></i>Assignments</a></li>
                        <li><a href="{{route('studymaterial')}}"><i class="fa fa-angle-double-right"></i>Study material</a></li>
                        <li><a href="{{route('syllabus')}}"><i class="fa fa-angle-double-right"></i>Syllabus</a></li>
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
                                <li><a href="{{route('studentlcreport')}}"><i class="fa fa-angle-double-right"></i>LC Issue Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Student Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('castewisestudents')}}"><i class="fa fa-angle-double-right"></i>Caste wise Students Report</a></li>
                                <li><a href="{{route('genderwisestudents')}}"><i class="fa fa-angle-double-right"></i>Gender wise Students Report</a></li>
                                <li><a href="{{route('classwisestudentsreport')}}"><i class="fa fa-angle-double-right"></i>Class wise Students Report</a></li>
                                <li><a href="{{route('form17students')}}"><i class="fa fa-angle-double-right"></i>Form 17 Students Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Scholarship Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('studentscholarshipreport')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Exam Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('studentwiseexamreport')}}"><i class="fa fa-angle-double-right"></i>Student Exam Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Staff Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('castewisestaff')}}"><i class="fa fa-angle-double-right"></i>Caste wise staff Report</a></li>
                                <li><a href="{{route('genderwisestaff')}}"><i class="fa fa-angle-double-right"></i>Gender wise staff Report</a></li>
                                <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Attendance Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('classattendancereport')}}"><i class="fa fa-angle-double-right"></i>Student attendance Report</a></li>
                                <li><a href="{{route('classmonthlyattendancereport')}}"><i class="fa fa-angle-double-right"></i>Student monthly attendance Report</a></li>
                                <li><a href="{{route('staffattendancereport')}}"><i class="fa fa-angle-double-right"></i>Staff attendance Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Catalogue Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('registercataloguereport')}}"><i class="fa fa-angle-double-right"></i>Student Catalogue Report</a></li>
                                <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(strtolower(Auth::user()->role) == 'operator')
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-ioxhost"></i> <span>School Setup</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('schoolinfo')}}"><i class="fa fa-angle-double-right"></i>School Information</a></li>
                        <li><a href="{{route('setmaxlc')}}"><i class="fa fa-angle-double-right"></i>Set Max LC prints</a></li>
                        <li><a href="{{route('academicyear')}}"><i class="fa fa-angle-double-right"></i>Academic Year List</a></li>
                        <li><a href="{{route('usertype')}}"><i class="fa fa-angle-double-right"></i>User roles/types</a></li>
                        <li><a href="{{route('religion')}}"><i class="fa fa-angle-double-right"></i>Religion Information</a></li>
                        <li><a href="{{route('category')}}"><i class="fa fa-angle-double-right"></i>Caste Category</a></li>
                        <li><a href="{{route('castecategories')}}"><i class="fa fa-angle-double-right"></i>Add Caste & subcaste</a></li>
                        <li><a href="{{route('designation')}}"><i class="fa fa-angle-double-right"></i>Staff Designation</a></li>
                        <li><a href="{{route('sections')}}"><i class="fa fa-angle-double-right"></i>Division Information</a></li>
                        <li><a href="{{route('classes')}}"><i class="fa fa-angle-double-right"></i>Class Information</a></li>
                        <li><a href="{{route('subjects')}}"><i class="fa fa-angle-double-right"></i>Subjects</a></li>
                        <li><a href="{{route('assignsubjects')}}"><i class="fa fa-angle-double-right"></i>Assign Subjects</a></li>
                        <li><a href="{{route('assignclassteacher')}}"><i class="fa fa-angle-double-right"></i>Assign Class Teacher</a></li>
                        <li><a href="{{route('classtimetable')}}"><i class="fa fa-angle-double-right"></i>Class Timetable</a></li>
                        <li><a href="{{route('scholarship')}}"><i class="fa fa-angle-double-right"></i>Scholarships</a></li>
                        <li><a href="{{route('holiday')}}"><i class="fa fa-angle-double-right"></i>Holidays</a></li>
                        <li><a href="{{route('event')}}"><i class="fa fa-angle-double-right"></i>Events</a></li>
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
                        <li><a href="{{route('postalreceive')}}"><i class="fa fa-angle-double-right"></i>Inwards</a></li>
                        <li><a href="{{route('postaldespatch')}}"><i class="fa fa-angle-double-right"></i>Outwards</a></li>
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
                        <li><a href="{{route('bulkdivisionassign')}}"><i class="fa fa-angle-double-right"></i>Bulk Division Assign</a></li>
                        <li><a href="{{route('studentidgenerate')}}"><i class="fa fa-angle-double-right"></i>Student ID Generate</a></li>
                        <li><a href="{{route('studentscholarshipapply')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Apply</a></li>
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
                        <li><a href="{{route('staff.joining')}}"><i class="fa fa-angle-double-right"></i>Staff joining</a></li>
                        <li><a href="{{route('staff.search')}}"><i class="fa fa-angle-double-right"></i>Staff search</a></li>
                        <li><a href="{{route('staffidgenerate')}}"><i class="fa fa-angle-double-right"></i>Staff ID Generate</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-calendar"></i> <span>Attendance</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('classattendance')}}"><i class="fa fa-angle-double-right"></i>Class Attendance</a></li>
                        <li><a href="{{route('staffattendance')}}"><i class="fa fa-angle-double-right"></i>Staff Attendance</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-book"></i> <span>Examinations</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('examschedule')}}"><i class="fa fa-angle-double-right"></i>Exam Schedule</a></li>
                        <li><a href="{{route('registermarks')}}"><i class="fa fa-angle-double-right"></i>Register Marks</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{''}}">
                        <i class="fa fa-download"></i> <span>Download Center</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('contentupload')}}"><i class="fa fa-angle-double-right"></i>Content upload</a></li>
                        <li><a href="{{route('assignments')}}"><i class="fa fa-angle-double-right"></i>Assignments</a></li>
                        <li><a href="{{route('studymaterial')}}"><i class="fa fa-angle-double-right"></i>Study material</a></li>
                        <li><a href="{{route('syllabus')}}"><i class="fa fa-angle-double-right"></i>Syllabus</a></li>
                        {{--<li><a href="{{route('otherdownloads')}}"><i class="fa fa-angle-double-right"></i>Other downloads</a></li>--}}
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
                        <li><a href="{{route('form17leavingcertificate')}}"><i class="fa fa-angle-double-right"></i>Form 17 Leaving Certificate</a></li>
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
                                <li><a href="{{route('studentlcreport')}}"><i class="fa fa-angle-double-right"></i>LC Issue Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Student Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('castewisestudents')}}"><i class="fa fa-angle-double-right"></i>Caste wise Students Report</a></li>
                                <li><a href="{{route('genderwisestudents')}}"><i class="fa fa-angle-double-right"></i>Gender wise Students Report</a></li>
                                <li><a href="{{route('classwisestudentsreport')}}"><i class="fa fa-angle-double-right"></i>Class wise Students Report</a></li>
                                <li><a href="{{route('form17students')}}"><i class="fa fa-angle-double-right"></i>Form 17 Students Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Scholarship Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('studentscholarshipreport')}}"><i class="fa fa-angle-double-right"></i>Student Scholarship Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Exam Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('studentwiseexamreport')}}"><i class="fa fa-angle-double-right"></i>Student Exam Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Staff Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('castewisestaff')}}"><i class="fa fa-angle-double-right"></i>Caste wise staff Report</a></li>
                                <li><a href="{{route('genderwisestaff')}}"><i class="fa fa-angle-double-right"></i>Gender wise staff Report</a></li>
                                <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Attendance Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('classattendancereport')}}"><i class="fa fa-angle-double-right"></i>Student attendance Report</a></li>
                                <li><a href="{{route('classmonthlyattendancereport')}}"><i class="fa fa-angle-double-right"></i>Student monthly attendance Report</a></li>
                                <li><a href="{{route('staffattendancereport')}}"><i class="fa fa-angle-double-right"></i>Staff attendance Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Catalogue Report
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('registercataloguereport')}}"><i class="fa fa-angle-double-right"></i>Student Catalogue Report</a></li>
                                <li><a href="{{route('staffcataloguereport')}}"><i class="fa fa-angle-double-right"></i>Staff Catalogue Report</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @elseif(Auth::user()->role == 'Student')
            @endif
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
