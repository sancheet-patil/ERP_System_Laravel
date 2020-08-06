<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\StaffAttendanceInfo;
use App\StaffDetails;
use App\StudentAttendanceInfo;
use App\StudentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function classattendance()
    {
        return view(auth()->user()->role.'/classattendance');
    }

    public function getclassattendancereport(Request $request)
    {
        $m= date("m");
        $de= date("d");
        $y= date("Y");
        $nowdate=date('d-m-Y');
        $lastdate='';
        for($i=0; $i<=7; $i++){
            $lastdate = date('d-m-Y',mktime(0,0,0,$m,($de-$i),$y));
        }

        $datelist = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->whereBetween('attendancedate', [$lastdate,$nowdate])
            ->select('attendancedate')->distinct()->orderBy('attendancedate','asc')
            ->get();

        $studentlist=[];
        foreach($datelist as $date)
        {
            $presentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date->attendancedate)->where('ispresent','1')->get()->count();
            $absentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date->attendancedate)->where('ispresent','0')->get()->count();

            $data['attendancedate'] = $date->attendancedate;
            $data['classname'] = $request->classname;
            $data['division'] = $request->division;
            $data['presentcount'] = $presentcount;
            $data['absentcount'] = $absentcount;
            $data['totalcount'] = $presentcount+$absentcount;
            array_push($studentlist,$data);
        }
        return $studentlist;
    }

    public function getcollegeclassattendancereport(Request $request)
    {
        $m= date("m");
        $de= date("d");
        $y= date("Y");
        $nowdate=date('d-m-Y');
        $lastdate='';
        for($i=0; $i<=7; $i++){
            $lastdate = date('d-m-Y',mktime(0,0,0,$m,($de-$i),$y));
        }

        $datelist = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->whereBetween('attendancedate', [$lastdate,$nowdate])
            ->select('attendancedate')->distinct()->orderBy('attendancedate','asc')
            ->get();

        $studentlist=[];
        foreach($datelist as $date)
        {
            $presentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date->attendancedate)->where('ispresent','1')->get()->count();
            $absentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date->attendancedate)->where('ispresent','0')->get()->count();

            $data['attendancedate'] = $date->attendancedate;
            $data['classname'] = $request->classname;
            $data['division'] = $request->division;
            $data['presentcount'] = $presentcount;
            $data['absentcount'] = $absentcount;
            $data['totalcount'] = $presentcount+$absentcount;
            array_push($studentlist,$data);
        }
        return $studentlist;
    }

    public function getclassattendance(Request $request)
    {
        $check = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
            ->where('division',$request->division)->where('attendancedate',$request->attendancedate)->first();
        if($check)
        {
            $data = DB::table('student_attendance_infos')
                ->join('student_details','student_attendance_infos.studentid','=','student_details.userid')
                ->where('student_attendance_infos.academicyear',Session::get('academicyear'))
                ->where('student_attendance_infos.classname',$request->classname)
                ->where('student_attendance_infos.division',$request->division)
                ->where('student_attendance_infos.attendancedate',$request->attendancedate)->get();
            return response()->json($data);
        }
        $data = [];
        $students = StudentDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
            ->where('division',$request->division)->get();
        foreach ($students as $student)
        {
            if($student->registerfor == 'School' || $student->registerfor == 'College') {
                $studentdata['academicyear'] = Session::get('academicyear');
                $studentdata['attendancedate'] = $request->attendancedate;
                $studentdata['classname'] = $student->classname;
                $studentdata['division'] = $student->division;
                $studentdata['studentid'] = $student->userid;
                $studentdata['roll_no'] = $student->roll_no;
                $studentdata['fname'] = $student->fname;
                $studentdata['mname'] = $student->mname;
                $studentdata['lname'] = $student->lname;
                array_push($data, $studentdata);
            }
        }
        return response()->json($data);
    }

    public function classattendance_submit(Request $request)
    {
        StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname[0])
            ->where('division',$request->division[0])->where('attendancedate',$request->attendancedate[0])->delete();
        for($num=0; $num < count($request->studentid); $num++)
        {
            $updateData = [
                'academicyear' => $request->academicyear[$num],
                'attendancedate' => $request->attendancedate[$num],
                'classname' => $request->classname[$num],
                'division' => $request->division[$num],
                'studentid' => $request->studentid[$num],
                'ispresent' => $request->ispresent[$num],
            ];
            StudentAttendanceInfo::insert($updateData);
        }
        return Redirect::route('classattendance')->with('success','Attendance submitted successfully');
    }

    public function staffattendance()
    {
        $m= date("m");
        $de= date("d");
        $y= date("Y");
        $nowdate=date('d-m-Y');
        $lastdate='';
        for($i=0; $i<=7; $i++){
            $lastdate = date('d-m-Y',mktime(0,0,0,$m,($de-$i),$y));
        }

        $datelist = StaffAttendanceInfo::whereBetween('attendancedate', [$lastdate,$nowdate])
            ->select('attendancedate')->distinct()->orderBy('attendancedate','desc')
            ->get();

        $stafflist=[];
        foreach($datelist as $date)
        {
            $presentcount = StaffAttendanceInfo::where('attendancedate',$date->attendancedate)->where('ispresent','1')->get()->count();
            $absentcount = StaffAttendanceInfo::where('attendancedate',$date->attendancedate)->where('ispresent','0')->get()->count();

            $data['attendancedate'] = $date->attendancedate;
            $data['presentcount'] = $presentcount;
            $data['absentcount'] = $absentcount;
            $data['totalcount'] = $presentcount+$absentcount;
            array_push($stafflist,$data);
        }

        return view(auth()->user()->role.'/staffattendance')->with('stafflist',$stafflist);
    }

    public function getstaffattendance(Request $request)
    {
        $check = StaffAttendanceInfo::where('attendancedate',$request->attendancedate)->first();
        if($check)
        {
            $data = DB::table('staff_attendance_infos')
                ->join('staff_details','staff_attendance_infos.staffid','=','staff_details.userid')
                ->join('designation_lists','designation_lists.id','=','staff_details.designation')
                ->where('staff_attendance_infos.attendancedate',$request->attendancedate)
                ->select('staff_attendance_infos.academicyear','staff_attendance_infos.attendancedate',
                    'staff_attendance_infos.staffid','staff_attendance_infos.ispresent','staff_details.staffrole',
                    'designation_lists.designation','staff_details.fname','staff_details.mname','staff_details.lname')
                ->get();
            return response()->json($data);
        }
        $data = [];
        $staffs = DB::table('staff_details')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->get();
        foreach ($staffs as $staff)
        {
            $staffdata['academicyear'] = Session::get('academicyear');
            $staffdata['attendancedate'] = $request->attendancedate;
            $staffdata['staffid'] = $staff->userid;
            $staffdata['staffrole'] = $staff->staffrole;
            $staffdata['designation'] = $staff->designation;
            $staffdata['fname'] = $staff->fname;
            $staffdata['mname'] = $staff->mname;
            $staffdata['lname'] = $staff->lname;
            array_push($data,$staffdata);
        }
        return response()->json($data);
    }

    public function staffattendance_submit(Request $request)
    {
        StaffAttendanceInfo::where('attendancedate',$request->attendancedate[0])->delete();
        for($num=0; $num < count($request->staffid); $num++)
        {
            $updateData = [
                'academicyear' => $request->academicyear[$num],
                'attendancedate' => $request->attendancedate[$num],
                'staffid' => $request->staffid[$num],
                'ispresent' => $request->ispresent[$num],
            ];
            StaffAttendanceInfo::insert($updateData);
        }
        return Redirect::route('staffattendance')->with('success','Attendance submitted successfully');
    }
}
