<?php

namespace App\Http\Controllers\Web\Admin;

use App\ClassLists;
use App\Http\Controllers\Controller;
use App\SchoolExamination;
use App\StudentDetails;
use App\StudentEducationalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExaminationController extends Controller
{
    public function examination()
    {
        return view(auth()->user()->role.'/examination')->with('classname','')->with('division','')
            ->with('semester','')->with('faculty','');
    }

    public function examination_post(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->where('hasaccess','1');
        if($request->faculty)
        {
            $studentlist = $studentlist->where('faculty',$request->faculty)->get();
        }
        else
        {
            $studentlist = $studentlist->get();
        }
        $classdivision = ClassLists::where('classname',$request->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examination')->with('studentlist',$studentlist)
            ->with('classname',$request->classname)->with('division',$request->division)
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester)->with('faculty',$request->faculty);
    }

    public function examinationmark(Request $request)
    {
        $student = StudentDetails::where('userid',$request->studentid)->first();
        $subjectlist = DB::table('class_subject_details')
            ->join('subject_lists','class_subject_details.subjectname','=','subject_lists.id')
            ->select('class_subject_details.classname','class_subject_details.division','subject_lists.subjectname',
                'class_subject_details.outofmarks','class_subject_details.subjectname as subjectid')
            ->where('class_subject_details.academicyear',Session::get('academicyear'))
            ->where('class_subject_details.classname',$student->classname)
            ->where('class_subject_details.division',$student->division)->get();

        return view(auth()->user()->role.'/examinationmark')->with('studentid',$request->studentid)
            ->with('semester',$request->semester)->with('subjectlist',$subjectlist);
    }

    public function examinationmark_submit(Request $request)
    {
        SchoolExamination::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname[0])->where('division',$request->division[0])
            ->where('semester',$request->semester[0])->where('studentid',$request->studentid[0])->delete();

        for($num=0; $num < count($request->studentid); $num++) {
            $data['academicyear'] = Session::get('academicyear');
            $data['classname'] = $request->classname[$num];
            $data['division'] = $request->division[$num];
            $data['semester'] = $request->semester[$num];
            $data['studentid'] = $request->studentid[$num];
            $data['subjectname'] = $request->subjectname[$num];
            $data['marks'] = $request->obtainedmarks[$num];
            SchoolExamination::create($data);
        }

        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname[0])->where('division',$request->division[0])->get();
        $classdivision = ClassLists::where('classname',$request->classname[0])->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examination')->with('studentlist',$studentlist)
            ->with('classname',$request->classname[0])->with('division',$request->division[0])
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester[0])->with('success','Mark assigned to student');
    }

    public function promotestudents()
    {
        return view(auth()->user()->role.'/promotestudents');
    }

    public function promotestudents_add(Request $request)
    {
        foreach($request->to as $userid)
        {
            $academicyear = (substr(Session::get('academicyear'), 0, 4) + 1) . '-' . (substr(Session::get('academicyear'), 5, 4) + 1);
            if(strlen(strlen($request->classtopromote) == 1)) {
                $classname = '0'.$request->classtopromote;
            }
            else{
                $classname = $request->classtopromote;
            }
            $updateData = [
                'academicyear' => $academicyear,
                'classname' => $classname,
            ];
            StudentDetails::where('userid',$userid)->update($updateData);

            StudentEducationalDetails::updateOrCreate(
                ['userid' => $userid, 'academicyear' => $academicyear],
                ['classname' => $classname]
            );
        }
        return back()->with('success','Students promoted successfully');
    }

    public function demotestudents()
    {
        return view(auth()->user()->role.'/demotestudents');
    }

    public function demotestudents_add(Request $request)
    {
        foreach($request->to as $userid)
        {
            $academicyear = (substr(Session::get('academicyear'), 0, 4) - 1) . '-' . (substr(Session::get('academicyear'), 5, 4) - 1);
            if(strlen(strlen($request->classtopromote) == 1)) {
                $classname = '0'.$request->classtopromote;
            }
            else{
                $classname = $request->classtopromote;
            }
            $updateData = [
                'academicyear' => $academicyear,
                'classname' => $classname,
            ];
            StudentDetails::where('userid',$userid)->update($updateData);

            StudentEducationalDetails::updateOrCreate(
                ['userid' => $userid, 'academicyear' => $academicyear],
                ['classname' => $classname]
            );
        }
        return back()->with('success','Students demoted successfully');
    }
}
